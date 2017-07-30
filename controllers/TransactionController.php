<?php

namespace app\controllers;

use app\models\Account;
use app\models\Customer;
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
                        if ($txHnd->createTransaction($model->cr_account, $model->dr_account, $model->amount, TxType::MANUAL, $model->payment, $model->description)) {
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
}
