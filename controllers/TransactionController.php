<?php

namespace app\controllers;

use app\models\Account;
use app\models\BankAccount;
use app\models\BankTransaction;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\ManualTransaction;
use app\models\Transaction;
use app\utils\enums\PaymentType;
use app\utils\enums\TxType;
use app\utils\GeneralAccounts;
use app\utils\TxHandler;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

/**
 * TellerController
 */
class TransactionController extends LmsController
{
    public function actionManual()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::MANUAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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

    public function actionView($id)
    {
        $tx = Transaction::findOne($id);
        if ($tx == null) {
            return $this->render('error', ['error' => 'The requested transaction does not exist.']);
        }

        return $this->render('view', [
            'model' => $tx,
        ]);
    }

    public function actionRevert($id) {
        $tx = Transaction::findOne($id);
        if ($tx == null) {
            return $this->render('error', ['error' => 'The requested transaction #'.$id.' does not exist.']);
        }

        if ($tx->reverted != 0) {
            return $this->render('error', ['error' => 'The transaction already reverted by '.Html::a("#".$tx->reverted, ['transaction/view', 'id'=>$tx->reverted])."."]);
        }

        $txs = Transaction::find()->where(['txlink' => $tx->txlink])->orderBy(['txid' =>SORT_DESC])->all();

        $txHnd = new TxHandler();
        $dbtx = Yii::$app->getDb()->beginTransaction();

        foreach ($txs as $txx) {
            $txHnd->createTransaction($txx->cr_account,
                $txx->dr_account,
                $txx->amount,
                TxType::REVERT,
                PaymentType::INTERNAL,
                "Revert of #" . $txx->txid,
                'REV-' . $txx->txlink,
                null,
                $txx->txid);
            if ($txHnd->error != null) {
                $dbtx->rollBack();
                return $this->render('error', ['error' => $txHnd->error]);
            }

            if ($txx->type == TxType::RECOVERY) {
                $newTx = Transaction::find()
                    ->where([
                        'dr_account' => $txx->dr_account,
                        'type' => [TxType::RECOVERY, TxType::PENALTY],
                        'reverted' => 0
                    ])
                    ->orderBy(['txid' => SORT_DESC])->one();
                if ($newTx != null && $newTx->txlink != $txx->txlink) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])
                        .". Need to revert the transaction "
                        .Html::a("#".$newTx->txid, ['transaction/view', 'id'=>$newTx->txid]). " before."]);
                }
                $parts = explode(" ", $txx->description);
                if (count($parts) != 8) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $status = $parts[0];
                $date = $parts[7];
                $loan = Loan::findOne(['saving_account' => $txx->dr_account]);
                if ($loan == null) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $schedule = LoanSchedule::findOne(['loan_id' => $loan->id, 'demand_date' => $date]);
                if ($schedule == null) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $schedule->status = $status;
                $schedule->due = $schedule->due + $txx->amount;
                $schedule->paid = $schedule->paid - $txx->amount;
                if (!$schedule->save()) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
            }

            if ($txx->type == TxType::PENALTY) {
                $newTx = Transaction::find()
                    ->where([
                        'dr_account' => $txx->dr_account,
                        'type' => [TxType::RECOVERY, TxType::PENALTY],
                        'reverted' => 0
                    ])
                    ->orderBy(['txid' => SORT_DESC])->one();
                if ($newTx != null && $newTx->txlink != $txx->txlink) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])
                        .". Need to revert the transaction "
                        .Html::a("#".$newTx->txid, ['transaction/view', 'id'=>$newTx->txid]). " before."]);
                }
                $parts = explode(" ", $txx->description);
                if (count($parts) != 7) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $date = $parts[6];
                $loan = Loan::findOne(['saving_account' => $txx->dr_account]);
                if ($loan == null) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $schedule = LoanSchedule::findOne(['loan_id' => $loan->id, 'demand_date' => $date]);
                if ($schedule == null) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
                $schedule->due = $schedule->due + $txx->amount;
                $schedule->paid = $schedule->paid - $txx->amount;
                if (!$schedule->save()) {
                    $dbtx->rollBack();
                    return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
                }
            }
            $txx->reverted = $txHnd->txid;
            $txx->description = "[Reverted] ".$txx->description;
            if (!$txx->save()) {
                $dbtx->rollBack();
                return $this->render('error', ['error' => 'Failed to revert '.Html::a("#".$txx->txid, ['transaction/view', 'id'=>$txx->txid])."."]);
            }
        }

        $dbtx->commit();

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionInvestment()
    {
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INVESTMENT, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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
        $userQuery = User::find();
        if (!Yii::$app->user->isSuperadmin) {
            $userQuery->where(['superadmin' => 0]);
        }
        $users = $userQuery->all();
        $userItems = [];
        foreach ($users as $user) {
            $userItems[$user->getId()] = $user->username;
        }
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $crAcc = Account::getTellerAccountById($model->cr_account);
                if ($crAcc == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else if ($crAcc->type != Account::TYPE_TELLER) {
                    $model->error = $model->cr_account . " is not a teller account";
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INTERNAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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
            'userItems' => $userItems
        ]);
    }

    public function actionSafeToTeller()
    {
        $userQuery = User::find();
        if (!Yii::$app->user->isSuperadmin) {
            $userQuery->where(['superadmin' => 0]);
        }
        $users = $userQuery->all();
        $userItems = [];
        foreach ($users as $user) {
            $userItems[$user->getId()] = $user->username;
        }
        $model = new ManualTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $drAcc = Account::getTellerAccountById($model->dr_account);
                if ($drAcc == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else if ($drAcc->type != Account::TYPE_TELLER) {
                    $model->error = $model->dr_account . " is not a teller account";
                } else if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::INTERNAL, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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
            'userItems' => $userItems
        ]);
    }

    public function actionSafeToBank()
    {
        $model = new BankTransaction();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->dr_account = BankAccount::findOne($model->bank_account)->account_id;
                $drAcc = Account::findOne($model->dr_account);
                if ($drAcc == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else if ($drAcc->type != Account::TYPE_BANK) {
                    $model->error = $model->dr_account . " is not a bank account";
                } else if (Account::findOne($model->cr_account) == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::BANK, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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
            if ($model->validate()) {
                $model->cr_account = BankAccount::findOne($model->bank_account)->account_id;
                $crAcc = Account::findOne($model->cr_account);
                if ($crAcc == null) {
                    $model->error = "Invalid account id " . $model->cr_account;
                } else if ($crAcc->type != Account::TYPE_BANK) {
                    $model->error = $model->cr_account . " is not a bank account";
                } else if (Account::findOne($model->dr_account) == null) {
                    $model->error = "Invalid account id " . $model->dr_account;
                } else {
                    if ($model->stage == 1) {
                        $txHnd = new TxHandler();
                        $tx = Yii::$app->getDb()->beginTransaction();
                        if ($txHnd->createTransaction($model->dr_account, $model->cr_account, $model->amount, TxType::BANK, $model->payment, $model->description)) {
                            $tx->commit();
                            return $this->redirect(['transaction/view', 'id' => $txHnd->txid]);
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

    public function actionPrintReceipt($id) {
        $transaction = Transaction::findOne($id);
        if ($transaction == null) {
            return "Invalid receipt";
        }

        if ($transaction->type !== TxType::RECEIPT && $transaction->type !== TxType::DOWN_PAYMENT ) {
            return "Invalid receipt";
        }

        if (substr($transaction->cr_account, 0, 1) != Account::getTypeId(Account::TYPE_SAVING)) {
            return "Invalid receipt";
        }
        return $this->redirect(['/hp-new-vehicle-loan/print-receipt', 'id' => $id]);
    }
}
