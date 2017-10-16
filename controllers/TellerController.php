<?php

namespace app\controllers;

use app\models\Account;
use app\models\BankAccount;
use app\models\Canvasser;
use app\models\CanvassingCommisionPayment;
use app\models\Collection;
use app\models\Customer;
use app\models\ExpenditurePayment;
use app\models\GeneralAccount;
use app\models\HpNewVehicleLoan;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\LoanType;
use app\models\OtherChargesPayment;
use app\models\SalesCommisionPayment;
use app\models\Setting;
use app\models\Supplier;
use app\models\TellerGeneralExpence;
use app\models\TellerPayment;
use app\models\TellerReceipt;
use app\models\Transaction;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\enums\PaymentType;
use app\utils\enums\TxType;
use app\utils\GeneralAccounts;
use app\utils\loan\LoanRecovery;
use app\utils\TxHandler;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use Yii;
use yii\data\ArrayDataProvider;

/**
 * TellerController
 */
class TellerController extends LmsController
{
    /**
     * @return string
     */
    public function actionReceipt()
    {
        $model = new TellerReceipt();
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['loanId'])) {
            $error = null;
            $loan = Loan::findOne($model->loanId);
            if ($loan == null) {
                $model->addError('loanId', "Invalid loan id.");
                return $this->render('receipt-account', [
                    'model' => $model,
                ]);
            }

            if ($model->description == null || $model->description == '') {
                $model->description = 'Loan receipt #' . $loan->id;
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && ($model->cheque == null || $model->cheque == '')) {
                    $model->addError('cheque', 'Reference number required for '.$model->payment.' transactions');
                } else {
                    $currentTx = Transaction::findOne(['txlink' => $model->link]);
                    if ($currentTx != null) {
                        $error = "Transaction is already done.";
                        $model->txid = $currentTx->txid;
                        $model->user = $currentTx->user;
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        if ($txHnd->createTransaction($teller->id, $loan->saving_account, $model->amount, TxType::RECEIPT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            $model->txid = $txHnd->txid;
                            $model->user = Yii::$app->getUser()->getIdentity()->username;
                            $date = Setting::findOne(1)->value;
                            $col = Collection::findOne(['loan_id' => $loan->id, 'date' => $date]);
                            if ($col != null) {
                                $col->amount = $col->amount + $model->amount;
                                $col->status = 'COLLECTED';
                                $col->save();
                            }
//                            $rec = new LoanRecovery();
//                            $rec->recover($loan->id);
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }


            $customer = Customer::findOne($loan->customer_id);
            $details = "#" . $loan->id . " / " . LoanType::findOne($loan->type)->name;
            $due = Yii::$app->getDb()->createCommand("SELECT SUM(due) FROM loan_schedule where loan_id = :id", [':id' => $loan->id])->queryScalar();
            $savingAccount = Account::findOne($loan->saving_account);
            $balance = $savingAccount->balance - $due;

            $schedules = LoanSchedule::find()->where(['loan_id' => $loan->id])->andWhere(['status' => ['ARREARS', 'DEMANDED']])->orderBy(['installment_id' => SORT_ASC])->all();

            /** @var LoanSchedule $scheduleData */
            $scheduleData = null;

            foreach ($schedules as $schedule) {
                if ($scheduleData == null) {
                    $scheduleData = $schedule;
                    $scheduleData->installment_id = 1;
                } else {
                    $scheduleData->principal += $schedule->principal;
                    $scheduleData->interest += $schedule->interest;
                    $scheduleData->charges += $schedule->charges;
                    $scheduleData->penalty += $schedule->penalty;
                    $scheduleData->paid += $schedule->paid;
                    $scheduleData->due += $schedule->due;
                    $scheduleData->installment_id += 1;
                }
            }

            if ($scheduleData == null) {
                $scheduleData = new LoanSchedule(['installment_id' => 0, 'status' => 'PAYED']);
            }

            if (LoanTypes::isVehicleLoan($loan->type)) {
                $loanex = HpNewVehicleLoan::findOne($loan->id);
                if ($loanex->vehicle_no != null && $loanex->vehicle_no != '') {
                    $details .= " / " . $loanex->vehicle_no;
                } else {
                    if ($loanex->engine_no != null && $loanex->engine_no != '') {
                        $details .= " / " . $loanex->engine_no;
                    }
                    if ($loanex->chasis_no != null && $loanex->chasis_no != '') {
                        $details .= " / " . $loanex->chasis_no;
                    }
                }
            }

            return $this->render('receipt', [
                'model' => $model,
                'details' => $details,
                'loan' => $loan,
                'customer' => $customer,
                'balance' => $balance,
                'schedule' => $scheduleData,
                'error' => $error
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('receipt-account', [
                'model' => $model,
            ]);
        }
    }

    public function actionPayment()
    {
        $model = new TellerPayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['loanId'])) {
            $error = null;
            $loan = Loan::findOne($model->loanId);
            if ($loan == null) {
                $model->addError('loanId', "Invalid loan id.");
                return $this->render('payment-account', [
                    'model' => $model,
                    'error' => null
                ]);
            }

            if ($loan->status != LoanStatus::ACTIVE) {
                $model->addError('loanId', "Loan is not active.");
                return $this->render('payment-account', [
                    'model' => $model,
                    'error' => null
                ]);
            }

            if ($loan->paid != 0) {
                $error = "Payment already done for this loan with the transaction #" . $loan->paid;
                return $this->render('payment-account', [
                    'model' => $model,
                    'error' => $error
                ]);
            }

            if ($model->description == null || $model->description == '') {
                $model->description = 'Loan payment #' . $loan->id;
            }

            $model->amount = $loan->amount;
            $loanex = HpNewVehicleLoan::findOne($loan->id);
            if ($loanex != null) {
                $model->amount = $loanex->loan_amount + $loanex->down_payment;
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        $model->crAccount = $teller->id;
                        if (PaymentType::needReference($model->payment)) {
                            $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                        }
                        if ($txHnd->createTransaction($model->drAccount, $model->crAccount, $model->amount, TxType::PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $loan->paid = $txHnd->txid;
                            if ($loan->save()) {
                                $tx->commit();
                                $model->stage = 3;
                            } else {
                                $tx->rollBack();
                                $error = "Service error.";
                            }
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }


            $customer = Customer::findOne($loan->customer_id);
            $details = "#" . $loan->id . " / " . LoanType::findOne($loan->type)->name;
            $due = Yii::$app->getDb()->createCommand("SELECT SUM(due) FROM loan_schedule where loan_id = :id", [':id' => $loan->id])->queryScalar();
            $savingAccount = Account::findOne($loan->saving_account);
            $balance = $savingAccount->balance - $due;
            $model->drAccount = GeneralAccounts::PAYABLE;
            $chequeWriteTo = "Cheques should be written directly to the customer " . CustomerView::widget(['customer' => $customer]);
            if ($loanex != null) {
                if ($loanex->vehicle_no != null && $loanex->vehicle_no != '') {
                    $details .= " / " . $loanex->vehicle_no;
                } else {
                    if ($loanex->engine_no != null && $loanex->engine_no != '') {
                        $details .= " / " . $loanex->engine_no;
                    }
                    if ($loanex->chasis_no != null && $loanex->chasis_no != '') {
                        $details .= " / " . $loanex->chasis_no;
                    }
                }
                if ($loanex->supplier != null && $loanex->supplier != 0) {
                    $supplier = Supplier::findOne($loanex->supplier);
                    //$model->drAccount = $supplier->account;
                    //$model->amount = $loan->amount;
                    $chequeWriteTo = "Cheques should be written to the supplier " . SupplierView::widget(['supplier' => $supplier]);
                }
            }

            return $this->render('payment', [
                'model' => $model,
                'details' => $details,
                'loan' => $loan,
                'loanex' => $loanex,
                'customer' => $customer,
                'balance' => $balance,
                'error' => $error,
                'chequeWriteTo' => $chequeWriteTo
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('payment-account', [
                'model' => $model,
                'error' => null
            ]);
        }
    }

    public function actionScPayment()
    {
        $model = new SalesCommisionPayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['supplier'])) {
            $error = null;
            $supplier = Supplier::findOne($model->supplier);
            if ($supplier == null) {
                $model->addError('supplier', "Invalid supplier id.");
                return $this->render('sc-payment-supplier', [
                    'model' => $model,
                    'error' => null
                ]);
            }

            if ($model->description == null || $model->description == '') {
                $model->description = 'Sales commission payment';
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    $model->crAccount = $teller->id;
                    if (PaymentType::needReference($model->payment)) {
                        $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                    }
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();

                        if ($txHnd->createTransaction($supplier->account, $model->crAccount, $model->amount, TxType::PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }

            return $this->render('sc-payment', [
                'model' => $model,
                'error' => $error,
                'supplier' => $supplier
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('sc-payment-supplier', [
                'model' => $model,
                'error' => null
            ]);
        }
    }

    public function actionCcPayment()
    {
        $model = new CanvassingCommisionPayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['supplier'])) {
            $error = null;
            $canvasser = Canvasser::findOne($model->canvasser);
            if ($canvasser == null) {
                $model->addError('canvasser', "Invalid canvasser id.");
                return $this->render('cc-payment-canvasser', [
                    'model' => $model,
                    'error' => null
                ]);
            }

            if ($model->description == null || $model->description == '') {
                $model->description = 'Canvassing commission payment';
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    $model->crAccount = $teller->id;
                    if (PaymentType::needReference($model->payment)) {
                        $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                    }
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();

                        if ($txHnd->createTransaction($canvasser->account, $model->crAccount, $model->amount, TxType::PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }

            return $this->render('cc-payment', [
                'model' => $model,
                'error' => $error,
                'canvasser' => $canvasser
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('cc-payment-canvasser', [
                'model' => $model,
                'error' => null
            ]);
        }
    }

    public function actionOcPayment()
    {
        $model = new OtherChargesPayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post())) {
            $error = null;

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    $model->crAccount = $teller->id;
                    if (PaymentType::needReference($model->payment)) {
                        $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                    }
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();

                        if ($txHnd->createTransaction(GeneralAccounts::CHARGES, $model->crAccount, $model->amount, TxType::PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }

            return $this->render('oc-payment', [
                'model' => $model,
                'error' => $error,
            ]);
        } else {
            $model->stage = 2;
            $model->link = uniqid();
            return $this->render('oc-payment', [
                'model' => $model,
                'error' => null,
            ]);
        }
    }

    public function actionRmvcPayment()
    {
        $model = new OtherChargesPayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post())) {
            $error = null;

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    $model->crAccount = $teller->id;
                    if (PaymentType::needReference($model->payment)) {
                        $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                    }
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();

                        if ($txHnd->createTransaction(GeneralAccounts::RMV_CHARGES, $model->crAccount, $model->amount, TxType::PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }

            return $this->render('rmv-payment', [
                'model' => $model,
                'error' => $error,
            ]);
        } else {
            $model->stage = 2;
            $model->link = uniqid();
            return $this->render('rmv-payment', [
                'model' => $model,
                'error' => null,
            ]);
        }
    }

    public function actionExpenditurePayment()
    {
        $model = new ExpenditurePayment();
        $model->payment = PaymentType::CHEQUE;
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['drAccount'])) {
            $error = null;
            $generalAccount = GeneralAccount::findOne(['account_id' => $model->drAccount]);
            if ($generalAccount == null) {
                $model->addError('drAccount', "Invalid account id.");
                return $this->render('ex-payment-account', [
                    'model' => $model,
                    'error' => null
                ]);
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && $model->cheque == '') {
                    $model->addError('cheque', 'Reference number cannot be blank for '.$model->payment.' payments');
                } else if (PaymentType::needReference($model->payment) && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for '.$model->payment.' payments');
                } else {
                    $model->crAccount = $teller->id;
                    if (PaymentType::needReference($model->payment)) {
                        $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                    }
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();

                        if ($txHnd->createTransaction($model->drAccount, $model->crAccount, $model->amount, TxType::EXPENSE, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $tx->commit();
                            $model->stage = 3;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }

            return $this->render('ex-payment', [
                'model' => $model,
                'error' => $error,
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('ex-payment-account', [
                'model' => $model,
                'error' => null
            ]);
        }
    }

    public function actionExpensePayment()
    {
        $model = new TellerGeneralExpence();
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $error = null;

            if ($model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else {
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 0;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        if ($txHnd->createTransaction(GeneralAccounts::EXPENSES, $teller->id, $model->amount, TxType::EXPENSE, PaymentType::CASH, $model->description, $model->link)) {
                            $tx->commit();
                            $model->stage = 1;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 0;
            }

            return $this->render('expense', [
                'model' => $model,
                'error' => $error,
                'title' => "Expense Payment"
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('expense', [
                'model' => $model,
                'error' => null,
                'title' => "Expense Payment"
            ]);
        }
    }

    public function actionExpenseReceipt()
    {
        $model = new TellerGeneralExpence();
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $error = null;

            if ($model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else {
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 0;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        if ($txHnd->createTransaction($teller->id, GeneralAccounts::EXPENSES, $model->amount, TxType::EXPENSE, PaymentType::CASH, $model->description, $model->link)) {
                            $tx->commit();
                            $model->stage = 1;
                            //return $this->redirect(['teller/view-payment', 'id' => $txHnd->txid]);
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 0;
            }

            return $this->render('expense', [
                'model' => $model,
                'error' => $error,
                'title' => "Expense Receipt"
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('expense', [
                'model' => $model,
                'error' => null,
                'title' => "Expense Receipt"
            ]);
        }
    }

    public function actionDownPaymentReceipt()
    {
        $model = new TellerReceipt();
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['loanId'])) {
            $error = null;
            $loan = Loan::findOne($model->loanId);
            if ($loan == null) {
                $model->addError('loanId', "Invalid loan id.");
                return $this->render('dp-receipt-account', [
                    'model' => $model,
                ]);
            }

            if ($loan->paid != 0) {
                $model->addError('loanId', "The loan is already paid");
                return $this->render('dp-receipt-account', [
                    'model' => $model,
                ]);
            }

            if (!LoanTypes::isVehicleLoan($loan->type)) {
                $model->addError('loanId', "This is not a vehicle loan.");
                return $this->render('dp-receipt-account', [
                    'model' => $model,
                ]);
            }

            $loanex = HpNewVehicleLoan::findOne($loan->id);
            if ($loanex == null) {
                $model->addError('loanId', "This is not a vehicle loan.");
                return $this->render('dp-receipt-account', [
                    'model' => $model,
                ]);
            }

            if ($model->description == null || $model->description == '') {
                $model->description = 'Loan down payment receipt #' . $loan->id;
            }

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if (PaymentType::needReference($model->payment) && ($model->cheque == null || $model->cheque == '')) {
                    $model->addError('cheque', 'Reference number required for '.$model->payment.' transactions');
                } else {
                    $currentTx = Transaction::findOne(['txlink' => $model->link]);
                    if ($currentTx != null) {
                        $error = "Transaction is already done.";
                        $model->txid = $currentTx->txid;
                        $model->user = $currentTx->user;
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        if ($txHnd->createTransaction($teller->id, GeneralAccounts::PAYABLE, $model->amount, TxType::DOWN_PAYMENT, $model->payment, $model->description, $model->link, $model->cheque)) {
                            $loanex->down_payment = $loanex->down_payment + $model->amount;
                            if ($loanex->save()) {
                                $tx->commit();
                                $model->stage = 3;
                                $model->txid = $txHnd->txid;
                                $model->user = Yii::$app->getUser()->getIdentity()->username;
                            } else {
                                $tx->rollBack();
                                $error = "Failed to save loan down payment";
                            }
                        } else {
                            $tx->rollBack();
                            $error = $txHnd->error;
                        }
                    }
                }
            } else {
                $model->stage = 2;
            }


            $customer = Customer::findOne($loan->customer_id);
            $details = "#" . $loan->id . " / " . LoanType::findOne($loan->type)->name;
            $due = Yii::$app->getDb()->createCommand("SELECT SUM(due) FROM loan_schedule where loan_id = :id", [':id' => $loan->id])->queryScalar();
            $savingAccount = Account::findOne($loan->saving_account);
            $balance = $savingAccount->balance - $due;
            if (LoanTypes::isVehicleLoan($loan->type)) {
                $loanex = HpNewVehicleLoan::findOne($loan->id);
                if ($loanex->vehicle_no != null && $loanex->vehicle_no != '') {
                    $details .= " / " . $loanex->vehicle_no;
                } else {
                    if ($loanex->engine_no != null && $loanex->engine_no != '') {
                        $details .= " / " . $loanex->engine_no;
                    }
                    if ($loanex->chasis_no != null && $loanex->chasis_no != '') {
                        $details .= " / " . $loanex->chasis_no;
                    }
                }
            }

            return $this->render('dp-receipt', [
                'model' => $model,
                'details' => $details,
                'loan' => $loan,
                'customer' => $customer,
                'balance' => $balance,
                'error' => $error,
                'loanx' => $loanex
            ]);
        } else {
            $model->stage = 0;
            $model->link = uniqid();
            return $this->render('dp-receipt-account', [
                'model' => $model,
            ]);
        }
    }

//    public function actionView() {
//        $accounts = Account::findAll(['type' => Account::TYPE_TELLER]);
//        $dataProvider = new ArrayDataProvider(['allModels' => $accounts, 'pagination' => 0]);
//        return $this->render('view', [
//            'dataProvider' => $dataProvider,
//        ]);
//    }
}
