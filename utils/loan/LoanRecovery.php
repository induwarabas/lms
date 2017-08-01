<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/2/2017
 * Time: 7:16 PM
 */

namespace app\utils\loan;


use app\models\Account;
use app\models\CollectionMethod;
use app\models\Loan;
use app\models\LoanSchedule;
use app\utils\Doubles;
use app\utils\enums\LoanScheduleStatus;
use app\utils\enums\LoanStatus;
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

    public function updateSchedule($loanId, $date)
    {
        $tx = Yii::$app->getDb()->beginTransaction();
        if ($date === null) {
            $date = date('Y-m-d');
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

                $schedule->save();
            }

            if ($diff->invert == 1) {
                continue;
            }

            if ($schedule->arrears < $interval) {
                $schedule->status = LoanScheduleStatus::ARREARS;
                for ($i = $schedule->arrears; $i < $interval; ++$i) {
                    $amountToPay = $this->getAmountToPay($schedule);
                    $arrears = $amountToPay + $schedule->penalty - $schedule->paid;
                    $penalty = round($arrears * $collectionMethod->penal / 100.0, 2);
                    $schedule->penalty = $schedule->penalty + $penalty;
                    $schedule->arrears = $schedule->arrears + 1;
                    $schedule->due = $schedule->penalty + $amountToPay - $schedule->paid;
                }
                $schedule->save();
            }
        }
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
            $schedules = LoanSchedule::find()->where(["loan_id" => $loanId])->where(['status' => LoanScheduleStatus::ARREARS])->andWhere("penalty > 0")->orderBy("installment_id")->all();
            $amount = 0.0;

            foreach ($schedules as $schedule) {
                $duePenalty = $schedule->penalty - $schedule->paid;
                if ($duePenalty > 0) {
                    $chargeAmount = $duePenalty;
                    if ($duePenalty > $remain) {
                        $chargeAmount = $remain;
                    }

                    $amount += $chargeAmount;
                    $remain -= $chargeAmount;
                    $schedule->paid += $chargeAmount;
                    $schedule->due -= $chargeAmount;
                    $schedule->save();
                }
            }

            if ($amount > 0) {
                $txHnd = new TxHandler();
                if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $amount, TxType::PENALTY, PaymentType::INTERNAL, "Penalty charge for loan #" . $loanId, $this->linkId)) {
                    $tx->rollBack();
                    $this->error = $txHnd->error;
                    return false;
                }
            }
        }
        $tx->commit();
        return true;
    }

    public function recoverInstallments($loanId)
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

        $schedules = LoanSchedule::find()->where(["loan_id" => $loanId])->where("status in ('".LoanScheduleStatus::ARREARS."', '".LoanScheduleStatus::DEMANDED."')")->orderBy("installment_id")->all();

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

            if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PARK, $schedule->due, TxType::RECOVERY, PaymentType::INTERNAL, "Installment recovery of loan #" . $loanId . " for " . $schedule->demand_date, $this->linkId)) {
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
            $schedule->save();
        }
        $tx->commit();
        return true;
    }

    public function recover($loanId, $date = null)
    {
        if ($date == null) {
            $date = date('Y-m-d');
        }
        $this->linkId = uniqid();
        if (!$this->updateSchedule($loanId, $date)) {
            return false;
        }

        if (!$this->recoverPenalty($loanId)) {
            return false;
        }

        if (!$this->recoverInstallments($loanId)) {
            return false;
        }

        return true;
    }
}