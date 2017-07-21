<?php

namespace app\controllers;

use app\models\Account;
use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\LoanType;
use app\models\TellerPayment;
use app\models\Transaction;
use app\models\User;
use app\utils\enums\LoanTypes;
use app\utils\enums\TxType;
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
class TellerController extends LmsController
{
    public function actionViewPayment($id) {

    }
    public function actionPayment()
    {
        $model = new TellerPayment();
        $teller = Account::getTellerAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate(['loanId'])) {
            $error = null;
            $loan = Loan::findOne($model->loanId);
            if ($loan == null) {
                $model->addError('loanId', "Invalid loan id.");
                return $this->render('payment-account', [
                    'model' => $model,
                ]);
            }


            if ($model->stage == 2 && $model->validate()) {
                if ($model->amount ==0) {
                    $model->addError('amount', 'Amount should be greater than 0');
                } else {
                    if (Transaction::findOne(['txlink' => $model->link]) != null)
                    {
                        $error = "Transaction is already done.";
                        $model->stage = 3;
                    } else {
                        $tx = Yii::$app->getDb()->beginTransaction();
                        $txHnd = new TxHandler();
                        if ($txHnd->createTransaction($teller->id, $loan->saving_account, $model->amount, TxType::PAYMENT, $model->description, $model->link)) {
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



            $customer = Customer::findOne($loan->customer_id);
            $details = "#" . $loan->id . " / " . LoanType::findOne($loan->type)->name;
            $due = Yii::$app->getDb()->createCommand("SELECT SUM(due) FROM loan_schedule where loan_id = :id", [':id' => $loan->id])->queryScalar();
            $savingAccount = Account::findOne($loan->saving_account);
            $balance = $savingAccount->balance - $due;
            if ($loan->type == LoanTypes::HP_NEW_VEHICLE) {
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

            return $this->render('payment', [
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
            return $this->render('payment-account', [
                'model' => $model,
            ]);
        }
    }
}
