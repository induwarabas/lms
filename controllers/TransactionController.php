<?php

namespace app\controllers;

use app\models\Account;
use app\models\BankAccount;
use app\models\BankTransaction;
use app\models\Customer;
use app\models\GeneralAccount;
use app\models\HpNewVehicleLoan;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\LoanType;
use app\models\ManualTransaction;
use app\models\TellerGeneralExpence;
use app\models\TellerPayment;
use app\models\TellerReceipt;
use app\models\Transaction;
use app\models\User;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\enums\PaymentType;
use app\utils\enums\TxType;
use app\utils\GeneralAccounts;
use app\utils\loan\LoanRecovery;
use app\utils\TxHandler;
use Yii;
use app\models\VehicleType;
use app\models\VehicleTypeSearch;
use app\controllers\LmsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TellerController
 */
class TransactionController extends LmsController
{
    public function actionManual()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                if (Account::findOne($model->cr_account) == null){
                    $model->error = "Invalid account id ".$model->cr_account;
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id ".$model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::MANUAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->stage = 0;
        }
        return $this->render('manual', [
            'model' => $model,
        ]);
    }

    public function actionView($id) {
        $tx = Transaction::findOne($id);
        return $this->render('view', [
            'model' => $tx,
        ]);
    }

    public function actionInvestment()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                if (Account::findOne($model->cr_account) == null){
                    $model->error = "Invalid account id ".$model->cr_account;
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id ".$model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INVESTMENT, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->dr_account = GeneralAccounts::SAFE;
            $model->cr_account = GeneralAccounts::INVESTMENT;
            $model->payment = PaymentType::INTERNAL;
            $model->stage = 0;
        }
        return $this->render('investment', [
            'model' => $model,
        ]);
    }

    public function actionTellerToSafe()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                $crAcc = Account::findOne($model->cr_account);
                if ($crAcc == null){
                    $model->error = "Invalid account id ".$model->cr_account;
                } else if ($crAcc->type != Account::TYPE_TELLER) {
                    $model->error = $model->cr_account." is not a teller account";
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id ".$model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INTENAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->dr_account = GeneralAccounts::SAFE;
            $model->payment = PaymentType::INTERNAL;
            $model->stage = 0;
        }
        return $this->render('teller-to-safe', [
            'model' => $model,
        ]);
    }

    public function actionSafeToTeller()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                $drAcc = Account::findOne($model->dr_account);
                if ($drAcc == null){
                    $model->error = "Invalid account id ".$model->dr_account;
                } else if ($drAcc->type != Account::TYPE_TELLER) {
                    $model->error = $model->dr_account." is not a teller account";
                } else if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id ".$model->cr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INTENAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->cr_account = GeneralAccounts::SAFE;
            $model->payment = PaymentType::INTERNAL;
            $model->stage = 0;
        }
        return $this->render('safe-to-teller', [
            'model' => $model,
        ]);
    }

    public function actionSafeToBank()
    {
        $model = new BankTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                $model->dr_account = BankAccount::findOne($model->bank_account)->account_id;
                $drAcc = Account::findOne($model->dr_account);
                if ($drAcc == null){
                    $model->error = "Invalid account id ".$model->dr_account;
                } else if ($drAcc->type != Account::TYPE_BANK) {
                    $model->error = $model->dr_account." is not a bank account";
                } else if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id ".$model->cr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::BANK, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->cr_account = GeneralAccounts::SAFE;
            $model->payment = PaymentType::INTERNAL;
            $model->stage = 0;
        }
        return $this->render('safe-to-bank', [
            'model' => $model,
        ]);
    }

    public function actionBankToSafe()
    {
        $model = new BankTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()) {
                $model->cr_account = BankAccount::findOne($model->bank_account)->account_id;
                $crAcc = Account::findOne($model->cr_account);
                if ($crAcc == null){
                    $model->error = "Invalid account id ".$model->cr_account;
                } else if ($crAcc->type != Account::TYPE_BANK) {
                    $model->error = $model->cr_account." is not a bank account";
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id ".$model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::BANK, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id'=>$txHnd->txid]);
                        }
                        $model->error = $txHnd->error;
                        $tx->rollBack();
                    } else if ($model->stage == 0) {
                        $model->stage = 1;
                    } else {
                        $model->stage = 0;
                    }
                }
            } else {
                $model->stage = 0;
            }
        } else {
            $model->link = uniqid();
            $model->dr_account = GeneralAccounts::SAFE;
            $model->payment = PaymentType::INTERNAL;
            $model->stage = 0;
        }
        return $this->render('bank-to-safe', [
            'model' => $model,
        ]);
    }
}
