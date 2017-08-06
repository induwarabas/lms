<?php

namespace app\controllers;

use app\models\Account;
use app\models\BankAccount;
use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\Loan;
use app\models\LoanType;
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

/**
 * TellerController
 */
class TellerController extends LmsController
{
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
                } else if ($model->payment == PaymentType::CHEQUE && ($model->cheque == null || $model->cheque == '')) {
                    $model->addError('cheque', 'Cheque number required for cheque transactions');
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
                            $rec = new LoanRecovery();
                            $rec->recover($loan->id);
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
        $model->payment = 'CHEQUE';
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

            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount == 0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else if ($model->payment == 'CHEQUE' && $model->cheque == '') {
                    $model->addError('cheque', 'Cheque number cannot be blank for cheque payments');
                } else if ($model->payment == 'CHEQUE' && ($model->bankAccount == null || $model->bankAccount == 0)) {
                    $model->addError('bankAccount', 'Bank Account cannot be blank for cheque payments');
                } else {
                    if (Transaction::findOne(['txlink' => $model->link]) != null) {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        $model->crAccount = $teller->id;
                        if ($model->payment == 'CHEQUE') {
                            $model->crAccount = BankAccount::findOne($model->bankAccount)->account_id;
                        }
                        if ($txHnd->createTransaction($model->drAccount, $model->crAccount, $model->amount, TxType::PAYMENT, PaymentType::CASH, $model->description, $model->link)) {
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
                if ($loanex->supplier != null && $loanex->supplier != 0) {
                    $supplier = Supplier::findOne($loanex->supplier);
                    $model->drAccount = $supplier->account;
                    $model->amount = $loan->amount + $loanex->getSalesCommission();
                    $chequeWriteTo = "Cheques should be written to the supplier " . SupplierView::widget(['supplier' => $supplier]);
                }
            }

            return $this->render('payment', [
                'model' => $model,
                'details' => $details,
                'loan' => $loan,
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
}
