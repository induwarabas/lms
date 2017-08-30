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
use app\utils\Doubles;
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

        if (LoanTypes::isVehicleLoan($loan->type)) {
            $amortization = new AmortizationCalculator();
            $schedule = $amortization->calculate($loan->amount, $loan->interest, $loan->period, $interestTerms, $loan->charges);
        } else {
            $amortization = new DailyScheduleCalculator();
            $schedule = $amortization->calculate($loan->amount, $loan->interest, $loan->period);
        }

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

        $countx = count($schedule->schedule);
        for ($x = 1; $x <= $countx; $x++) {
            $dt = date('Y-m-d', strtotime($timeAdd, strtotime($dt)));
            $installment = $schedule->schedule[$x - 1];
            $s = new LoanSchedule();
            $s->loan_id = $loan->id;
            $s->installment_id = $x;
            $s->status = LoanScheduleStatus::PENDING;
            if ($loan->type == LoanTypes::DAILY_COLLECTION) {
                $s->demand_date = '9999-12-31';
            } else {
                $s->demand_date = $dt;
            }
            $s->principal = $installment['principal'];
            $s->interest = $installment['interest'];
            $s->charges = $installment['charges'];
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




        if (LoanTypes::isVehicleLoan($loan->type)) {
            $loanex = HpNewVehicleLoan::findOne($loan->id);
            $total = $loanex->charges + $loanex->rmv_charges;

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

            if ($loanex->charges != null && $loanex->charges != 0) {
                if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                    GeneralAccounts::CHARGES,
                    $loanex->charges,
                    TxType::DISBURSE,
                    PaymentType::INTERNAL,
                    "Disbursement other charges of the loan #" . $loan->id,
                    $link)) {
                    $this->error = $txHnd->error;
                    return false;
                }
            }

            if ($loanex->rmv_charges != null && $loanex->rmv_charges != 0) {
                if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                    GeneralAccounts::RMV_CHARGES,
                    $loanex->rmv_charges,
                    TxType::DISBURSE,
                    PaymentType::INTERNAL,
                    "Disbursement rmv charges of the loan #" . $loan->id,
                    $link)) {
                    $this->error = $txHnd->error;
                    return false;
                }
            }

            if (isset($loanex->supplier) && $loanex->supplier != 0){
                $supplier = Supplier::findOne($loanex->supplier);
//                if (!$txHnd->createTransaction(GeneralAccounts::PARK,
//                    $supplier->account,
//                    $loan->amount,
//                    TxType::DISBURSE,
//                    PaymentType::INTERNAL,
//                    "Disbursement of the loan #" . $loan->id,
//                    $link)) {
//                    $this->error = $txHnd->error;
//                    return false;
//                }

                $salesCommission = $loanex->getSalesCommission();

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
                $loan->amount,
                TxType::DISBURSE,
                PaymentType::INTERNAL,
                "Disbursement of the loan #" . $loan->id,
                $link)) {
                $this->error = $txHnd->error;
                return false;
            }

            if (Doubles::compare($loan->charges, 0.0) > 0) {
                if (!$txHnd->createTransaction(GeneralAccounts::PARK,
                    GeneralAccounts::CHARGES,
                    $loan->charges,
                    TxType::DISBURSE,
                    PaymentType::INTERNAL,
                    "Disbursement charges of the loan #" . $loan->id,
                    $link)) {
                    $this->error = $txHnd->error;
                    return false;
                }
            }
        }

        return true;
    }
}