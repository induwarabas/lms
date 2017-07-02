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
use app\utils\GeneralAccounts;
use app\utils\TxHandler;
use DateTime;
use Yii;

class LoanRecovery
{
    public $error = null;

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

        if ($loan->status !== 'ACTIVE') {
            $this->error = "The loan #" . $loanId . " is not active.";
            $tx->rollBack();
            return false;
        }

        $collectionMethod = CollectionMethod::findOne(['id' => $loan->collection_method]);
        $recoveryDate = date('Y-m-d', strtotime("-" . $collectionMethod->penal_after . " " . $collectionMethod->penal_after_unit, strtotime($date)));

        $schedules = LoanSchedule::find()->where(["loan_id" => $loanId])
            ->andWhere("status in ('DEMANDED', 'ARREARS', 'PENDING')")
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

            if ($schedule->status == 'PENDING' && $schedule->demand_date <= $date) {
                $schedule->status = 'DEMANDED';
                $schedule->due = $loan->installment;
                $schedule->save();
            }

            if ($diff->invert == 1) {
                continue;
            }

            if ($schedule->arrears < $interval) {
                $schedule->status = 'ARREARS';
                for ($i = $schedule->arrears; $i < $interval; ++$i) {
                    $arrears = $loan->installment + $schedule->penalty;
                    $penalty = round($arrears * $loan->penalty / 100.0, 2);
                    $schedule->penalty = $schedule->penalty + $penalty;
                    $schedule->arrears = $schedule->arrears + 1;
                    $schedule->due = $schedule->penalty + $loan->installment - $schedule->paid;
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
            $schedules = LoanSchedule::find()->where(['status' => 'ARREARS'])->andWhere("penalty > 0")->orderBy("installment_id")->all();
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
                if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PENALTY, $amount, "PENALTY","Penalty charge for loan #".$loanId)){
                    $tx->rollBack();
                    $this->error = $txHnd->error;
                    return false;
                }
            }
        }
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

        if ($remain >= $loan->installment) {
            $schedules = LoanSchedule::find()->where("status in ('ARREARS', 'DEMANDED')")->orderBy("installment_id")->all();

            foreach ($schedules as $schedule) {
                if ($remain < $loan->installment){
                    break;
                }
                $schedule->paid += Grrrrrrrrrrr
                $remain -= $loan->installment;
                $txHnd = new TxHandler();
                if (!$txHnd->createTransaction($loan->saving_account, GeneralAccounts::PARK, $schedule->charges, "CHARGES","Penalty charge for loan #".$loanId)){
                    $tx->rollBack();
                    $this->error = $txHnd->error;
                    return false;
                }

            }
        }
        return true;
    }

    public function recover($loanId, $date)
    {
        if (!$this->updateSchedule($loanId, $date)) {
            return false;
        }

        if (!$this->recoverPenalty($loanId)) {
            return false;
        }


    }
}