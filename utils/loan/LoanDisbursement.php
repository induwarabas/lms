<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 10:18 PM
 */

namespace app\utils\loan;

use app\models\Canvasser;
use app\models\HpNewVehicleLoan;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\Supplier;
use app\utils\enums\LoanScheduleStatus;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\enums\PaymentType;
use app\utils\enums\TxType;
use app\utils\GeneralAccounts;
use app\utils\TxHandler;

class LoanDisbursement
{
    public $error;

    public function disburse($loanId, $date)
    {
        $loan = Loan::findOne(['id' => $loanId]);
        if ($loan === null) {
            $this->error = "The loan not found for #" . $loanId;
            return false;
        }

        if ($loan->status !== LoanStatus::PENDING) {
            $this->error = "The loan is already disbursed.";
            return false;
        }

        $amortization = new AmortizationCalculator();
        $interestTerms = 12;
        $timeAdd = "+1 month";
        if ($loan->collection_method === 2) //Weekly
        {
            $interestTerms = 52;
            $timeAdd = "+1 week";
        } else if ($loan->collection_method == 3) //Daily
        {
            $interestTerms = 365;
            $timeAdd = "+1 day";
        }

        $schedule = $amortization->calculate($loan->amount, $loan->interest, $loan->period, $interestTerms, $loan->charges);

        $loan->disbursed_date = $date;

        $dt = $loan->disbursed_date;

        $loan->installment = $schedule->payment;
        $loan->total_interest = $schedule->totalInterest;
        $loan->total_payment = $schedule->totalPayment;
        $loan->status = LoanStatus::ACTIVE;
        if(!$loan->save()) {
            $this->error = $loan->errors[0];
            return false;
        }

        for ($x = 1; $x <= $loan->period; $x++) {
            $dt = date('Y-m-d', strtotime($timeAdd, strtotime($dt)));
            $installment = $schedule->schedule[$x - 1];
            $s = new LoanSchedule();
            $s->loan_id = $loan->id;
            $s->installment_id = $x;
            $s->status = LoanScheduleStatus::PENDING;
            $s->demand_date = $dt;
            $s->principal = $installment['principal'];
            $s->interest = $installment['interest'];
            $s->charges = $installment['charges'];
            $s->balance = $installment['balance'];
            $s->penalty = 0.0;
            $s->paid = 0.0;
            $s->due = 0.0;
            $s->arrears = 0;
            $s->balance = $installment['balance'];
            if(!$s->save()) {
                $this->error = $s->errors[0];
                return false;
            }
        }

        $txHnd = new TxHandler();
        $link = $txHnd->createLink();
        if (!$txHnd->createTransaction($loan->loan_account,
            GeneralAccounts::PARK,
            $loan->amount + $loan->charges,
            TxType::DISBURSE,
            PaymentType::INTERNAL,
            "Disbursement of the loan #" . $loan->id,
            $link)) {
            $this->error = $txHnd->error;
            return false;
        }

        if (!$txHnd->createTransaction(GeneralAccounts::PARK,
            GeneralAccounts::PAYABLE,
            $loan->amount,
            TxType::DISBURSE,
            PaymentType::INTERNAL,
            "Disbursement of the loan #" . $loan->id,
            $link)) {
            $this->error = $txHnd->error;
            return false;
        }

        if (LoanTypes::isVehicleLoan($loan->type)) {
            $loanex = HpNewVehicleLoan::findOne($loan->id);
            $total = 0.0;
            if (isset($loanex->supplier) && $loanex->supplier != 0){
                $salesCommission = $loanex->getSalesCommission();
                $supplier = Supplier::findOne($loanex->supplier);
                if ($supplier != null) {
                    $total += $salesCommission;
                    if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                        $supplier->account,
                        $salesCommission,
                        TxType::DISBURSE,
                        PaymentType::INTERNAL,
                        "Sales commission of the loan #" . $loan->id,
                        $link)) {
                        $this->error = $txHnd->error;
                        return false;
                    }
                }
            }

            if (isset($loanex->canvassed) && $loanex->canvassed != 0){
                $canvassingCommission = $loanex->getCanvassingCommission();
                $canvasser = Canvasser::findOne($loanex->canvassed);
                if ($canvasser != null) {
                    $total += $canvassingCommission;
                    if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                        $canvasser->account,
                        $canvassingCommission,
                        TxType::DISBURSE,
                        PaymentType::INTERNAL,
                        "Canvassing commission of the loan #" . $loan->id,
                        $link)) {
                        $this->error = $txHnd->error;
                        return false;
                    }
                }
            }

            if ($total != $loan->charges) {
                $this->error = "Charges not matching";
                return false;
            }

        } else {
            if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                GeneralAccounts::PAYABLE,
                $loan->charges,
                TxType::DISBURSE,
                PaymentType::INTERNAL,
                "Disbursement charges of the loan #" . $loan->id,
                $link)) {
                $this->error = $txHnd->error;
                return false;
            }
        }

        return true;
    }
}