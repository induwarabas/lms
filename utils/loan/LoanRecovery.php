<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/2/2017
 * Time: 7:16 PM
 */

namespace app\utils\loan;


use app\models\Account;
use app\models\Collection;
use app\models\CollectionMethod;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\Setting;
use app\models\HpNewVehicleLoan;
use app\utils\Doubles;
use app\utils\enums\LoanPaymentStatus;
use app\utils\enums\LoanScheduleStatus;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\enums\PaymentType;
use app\utils\enums\TxType;
use app\utils\GeneralAccounts;
use app\utils\TxHandler;
use DateTime;
use Yii;

class LoanRecovery
{
    public $error = null;

    public $linkId = "";

    private function getAmountToPay($schedule) {

        return $schedule->principal + $schedule->interest + $schedule->charges;
    }

    public function updateSchedule($loanId, $date, $demandDaily)
    {
        $tx = Yii::$app->getDb()->beginTransaction();
        if ($date === null) {
            $date = Setting::getDay();
        }
        $loan = Loan::findOne(['id' => $loanId]);
        if ($loan === null) {
            $this->error = "The loan #" . $loanId . " not found.";
            $tx->rollBack();
            return false;
        }

        if ($loan->status !== LoanStatus::ACTIVE) {
            $this->error = "The loan #" . $loanId . " is not active.";
            $tx->rollBack();
            return false;
        }

        $collectionMethod = CollectionMethod::findOne(['id' => $loan->collection_method]);
        $recoveryDate = date('Y-m-d', strtotime("-" . $collectionMethod->penal_after . " " . $collectionMethod->penal_after_unit, strtotime($date)));

        $schedules = LoanSchedule::find()->where(["loan_id" => $loanId])
            ->andWhere("status in ('".LoanScheduleStatus::DEMANDED."', '".LoanScheduleStatus::ARREARS."', '".LoanScheduleStatus::PENDING."')")
            ->andWhere("demand_date <= '" . $date . "'")
            ->orderBy(['installment_id' => SORT_ASC])
            ->all();

        $savingBalance = Account::findOne($loan->saving_account)->balance;
        $paymentStatus = LoanPaymentStatus::DONE;
        foreach ($schedules as $schedule) {
            $diff = date_diff(new DateTime($schedule->demand_date), new DateTime($recoveryDate));

            if ($collectionMethod->id == 1) {
                $interval = $diff->format("%y") * 12 + $diff->format("%m");
            } else if ($collectionMethod->id == 2) {
                $interval = floor($diff->format("%a") / 7);
            } else {
                $interval = $diff->format("%a");
            }

            $interval++;

            if ($schedule->status == LoanScheduleStatus::PENDING && $schedule->demand_date <= $date) {
                $schedule->status = LoanScheduleStatus::DEMANDED;
                $schedule->due = $this->getAmountToPay($schedule);
                $paymentStatus = LoanPaymentStatus::DEMANDED;
                $schedule->save();
            }

            if ($diff->invert == 1) {
                continue;
            }

            $amountToPay = $this->getAmountToPay($schedule) - $schedule->paid + $schedule->penalty;
            if (Doubles::compare($savingBalance, 0.0) > 0) {
                $amountToReduce = min($amountToPay, $savingBalance);
                $amountToPay -= $amountToReduce;
                $savingBalance -= $amountToReduce;
            }

            if ($schedule->arrears < $interval) {
                $schedule->status = LoanScheduleStatus::ARREARS;
                $paymentStatus = LoanPaymentStatus::ARREARS;
                for ($i = $schedule->arrears; $i < $interval; ++$i) {
                    $penalty = round($amountToPay * $loan->penalty / 100.0, 2);
                    $schedule->penalty = $schedule->penalty + $penalty;
                    $schedule->arrears = $schedule->arrears + 1;
                    $schedule->due = $this->getAmountToPay($schedule) - $schedule->paid + $schedule->penalty;
                }
                $schedule->save();
            }
        }

        if ($demandDaily && $loan->type == LoanTypes::DAILY_COLLECTION && $loan->disbursed_date < $date) {
            $sch = LoanSchedule::findOne(['loan_id' => $loanId, 'demand_date' => $date]);
            if ($sch == null) {
                $schedule = LoanSchedule::find()->where(['loan_id' => $loanId, 'status' => LoanStatus::PENDING])->orderBy(['installment_id' => SORT_ASC])->one();
                if ($schedule != null) {
                    if ($paymentStatus == LoanPaymentStatus::DONE) {
                        $paymentStatus = LoanPaymentStatus::DEMANDED;
                    }
                    $schedule->status = LoanScheduleStatus::DEMANDED;
                    $schedule->demand_date = $date;
                    $schedule->due = $this->getAmountToPay($schedule);
                    $schedule->save();
                }
            }
        }
        $loan->payment_status = $paymentStatus;
        $loan->save();
        $tx->commit();
        return true;
    }

    public function recoverPenalty($loanId)
    {
        $tx = Yii::$app->getDb()->beginTransaction();
        $loan = Loan::findOne(['id' => $loanId]);
        if ($loan === null) {
            $this->error = "The loan #" . $loanId . " not found.";
            $tx->rollBack();
            return false;
        }

        $savingAccount = Account::findOne(['id' => $loan->saving_account]);
        $remain = $savingAccount->balance;

        if ($remain > 0) {
            $schedules = LoanSchedule::find()
                ->where(["loan_id" => $loanId])
                ->andWhere(['status' => LoanScheduleStatus::ARREARS])
                ->andWhere("penalty > 0")
                ->orderBy("installment_id")
                ->all();
            //$amount = 0.0;

            foreach ($schedules as $schedule) {
                $duePenalty = $schedule->penalty - $schedule->paid;
                if ($duePenalty > 0) {
                    $chargeAmount = $duePenalty;
                    if ($duePenalty > $remain) {
                        $chargeAmount = $remain;
                    }

                    //$amount += $chargeAmount;
                    $remain -= $chargeAmount;
                    $schedule->paid += $chargeAmount;
                    $schedule->due -= $chargeAmount;
                    $schedule->save();
                    if($chargeAmount > 0 && $remain >= 0) {
                        $txHnd = new TxHandler();
                        if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $chargeAmount, TxType::PENALTY, PaymentType::INTERNAL, "Penalty charge of loan #" . $loanId." for ".$schedule->demand_date, $this->linkId)) {
                            $tx->rollBack();
                            $this->error = $txHnd->error;
                            return false;
                        }
                    }
                }
            }

//            if ($amount > 0) {
//                $txHnd = new TxHandler();
//                if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $amount, TxType::PENALTY, PaymentType::INTERNAL, "Penalty charge for loan #" . $loanId, $this->linkId)) {
//                    $tx->rollBack();
//                    $this->error = $txHnd->error;
//                    return false;
//                }
//            }
        }
        $tx->commit();
        return true;
    }
    public function recoverSeizePanalty($loanId){
        $tx = Yii::$app->getDb()->beginTransaction();
        $loan = Loan::findOne(['id'=>$loanId]);

        if($loan === null){
            $this->error="The loan #" . $loanId . " not found.";
            $tx->rollBack();
            return false;
        }
        $vehicle = HpNewVehicleLoan::findOne(['id' => $loanId]);
        $seizePanelty = $vehicle->seize_panelty;
        $savingAccount = Account::findOne(['id' => $loan->saving_account]);
        $remain = $savingAccount->balance;
        $txhand= new TxHandler();

        if($remain >= $seizePanelty){
            if(!$txhand->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $seizePanelty, TxType::SEIZE, PaymentType::INTERNAL, "Seize Panelty recovery of loan #" . $loanId)){
                $tx->rollBack();
                $this->error = $txhand->error;
                return false;
            }
            $vehicle->seize_panelty = 0.00;
            $tx->commit();
            $vehicle->save();
            return true;
        }
        if($remain < $seizePanelty){
            if(!$txhand->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $remain, TxType::SEIZE, PaymentType::INTERNAL, "Seize Panelty recovery of loan #" . $loanId )){
                $tx->rollBack();
                $this->error = $txhand->error;
                return false;
            }
            $vehicle->seize_panelty = $seizePanelty - $remain;
            $tx->commit();
            $vehicle->save();
            return true;
        }

    }
    public function recoverInstallments($loanId, $date)
    {
        $tx = Yii::$app->getDb()->beginTransaction();
        $loan = Loan::findOne(['id' => $loanId]);
        if ($loan === null) {
            $this->error = "The loan #" . $loanId . " not found.";
            $tx->rollBack();
            return false;
        }

        $savingAccount = Account::findOne(['id' => $loan->saving_account]);
        $remain = $savingAccount->balance;

        $schedules = LoanSchedule::find()
            ->where(["loan_id" => $loanId])
            ->andWhere("status in ('".LoanScheduleStatus::ARREARS."', '".LoanScheduleStatus::DEMANDED."')")
            ->orderBy("installment_id")
            ->all();
        $recoveredCount = 0;
        foreach ($schedules as $schedule) {

            if ($remain < $schedule->due) {
                break;
            }
            $schedule->paid += $schedule->due;
            $remain -= $schedule->due;
            $txHnd = new TxHandler();

            if (Doubles::compare($schedule->due, $schedule->principal + $schedule->charges + $schedule->interest) != 0) {
                $tx->rollBack();
                $this->error = "Fail to reconcile";
                return false;
            }

            if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PARK, $schedule->due, TxType::RECOVERY, PaymentType::INTERNAL, $schedule->status." Installment recovery of loan #" . $loanId . " for " . $schedule->demand_date, $this->linkId)) {
                $tx->rollBack();
                $this->error = $txHnd->error;
                return false;
            }

            if (!$txHnd->createTransaction(GeneralAccounts::PARK, $loan->loan_account, $schedule->principal + $schedule->charges, TxType::CAPITAL_RECOVERY, PaymentType::INTERNAL, "Capital recovery of loan #" . $loanId . " for " . $schedule->demand_date, $this->linkId)) {
                $tx->rollBack();
                $this->error = $txHnd->error;
                return false;
            }

            if (!$txHnd->createTransaction(GeneralAccounts::PARK, GeneralAccounts::INTEREST, $schedule->interest, TxType::INTEREST_RECOVERY, PaymentType::INTERNAL, "Interest recovery of loan #" . $loanId . " for " . $schedule->demand_date, $this->linkId)) {
                $tx->rollBack();
                $this->error = $txHnd->error;
                return false;
            }

//            if (!$txHnd->createTransaction(GeneralAccounts::PARK, GeneralAccounts::COMMISSION, $schedule->interest, TxType::CHARGES_RECOVERY, PaymentType::INTERNAL, "Charges recovery of loan #" . $loanId . " for " . $schedule->demand_date, $this->linkId)) {
//                $tx->rollBack();
//                $this->error = $txHnd->error;
//                return false;
//            }
            $schedule->due = 0.0;
            $schedule->status = LoanScheduleStatus::PAYED;
            $schedule->pay_date = date('Y-m-d');
            $schedule->save();
            ++$recoveredCount;
        }
        $col = Collection::findOne(['loan_id' => $loanId, 'date' => $date]);
        if ($col != null) {
            $col->installments = $col->installments + $recoveredCount;
            $col->save();
        }

        $notPayedCount = LoanSchedule::find()->where(['loan_id' => $loan->id])->andWhere(array("<>", "status", LoanScheduleStatus::PAYED))->count();
        if ($notPayedCount == 0) {
            $loan->status = LoanStatus::COMPLETED;
            $loan->payment_status = LoanPaymentStatus::DONE;
            if (!$loan->save()) {
                $tx->rollBack();
                $this->error = "Failed to complete the loan";
                return false;
            }
        } else {
            $schedule = LoanSchedule::find()->where(['loan_id' => $loan->id])->andWhere(['IN', 'status', [LoanScheduleStatus::DEMANDED, LoanScheduleStatus::ARREARS]])->orderBy('installment_id')->one();
            if ($schedule == null) {
                $loan->payment_status = LoanPaymentStatus::DONE;
                if (!$loan->save()) {
                    $tx->rollBack();
                    $this->error = "Failed to complete the loan";
                    return false;
                }
            } else {
                $loan->payment_status = $schedule->status;
                if (!$loan->save()) {
                    $tx->rollBack();
                    $this->error = "Failed to complete the loan";
                    return false;
                }
            }
        }
        $tx->commit();
        return true;
    }

    public function recover($loanId, $date = null, $demandDaily = false)
    {
        $loan = Loan::findOne($loanId);
        $vehicle=HpNewVehicleLoan::findOne($loanId);
        if ($loan == null) {
            $this->error = "Loan ".$loanId." not found";
            return false;
        }

        if ($loan->status != LoanStatus::ACTIVE || $loan->paid == 0) {
            return true;
        }

        if ($date == null) {
            $date = Setting::getDay();
        }

        $this->linkId = uniqid();
        if (!$this->updateSchedule($loanId, $date, $demandDaily)) {
            return false;
        }
        if($loan->type == 1 || $loan->type == 2 || $loan->type == 3){
            if(!$this->recoverSeizePanalty($loanId) ){
                return false;
            }
        }
        if (!$this->recoverPenalty($loanId)) {
            return false;
        }

        if (!$this->recoverInstallments($loanId, $date)) {
            return false;
        }

        return true;
    }
}