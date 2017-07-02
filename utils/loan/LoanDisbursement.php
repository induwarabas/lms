<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 10:18 PM
 */

namespace app\utils\loan;

use app\models\Loan;
use app\models\LoanSchedule;
use app\utils\GeneralAccounts;
use app\utils\TxHandler;

class LoanDisbursement
{
    public $error;

    public function disburse($loanId)
    {
        $loan = Loan::findOne(['id' => $loanId]);
        if ($loan === null) {
            $this->error = "The loan not found for #" . $loanId;
            return false;
        }

        if ($loan->status !== 'PENDING') {
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

        $loan->disbursed_date = date("Y-m-d");

        $dt = $loan->disbursed_date;

        $loan->installment = $schedule->payment;
        $loan->total_interest = $schedule->totalInterest;
        $loan->total_payment = $schedule->totalPayment;
        $loan->status = 'ACTIVE';
        $loan->save();

        for ($x = 1; $x <= $loan->period; $x++) {
            $dt = date('Y-m-d', strtotime($timeAdd, strtotime($dt)));
            $installment = $schedule->schedule[$x - 1];
            $s = new LoanSchedule();
            $s->loan_id = $loan->id;
            $s->installment_id = $x;
            $s->status = 'PENDING';
            $s->demand_date = $dt;
            $s->principal = $installment['principal'];
            $s->interest = $installment['interest'];
            $s->charges = $installment['charges'];
            $s->balance = $installment['balance'];
            $s->penalty = 0.0;
            $s->paid = 0.0;
            $s->due = 0.0;
            $s->balance = $installment['balance'];
            $s->save();
        }

        $txHnd = new TxHandler();
        if (!$txHnd->createTransaction($loan->loan_account, GeneralAccounts::PAYABLE, $loan->amount, 'DISBURSE', "Disbursement of the loan #" . $loan->id)) {
            $this->error = $txHnd->error;
            return false;
        }

        if (!$txHnd->createTransaction(GeneralAccounts::COMMISSION, GeneralAccounts::PAYABLE, $loan->charges, 'CHARGES', "Disbursement charges of the loan #" . $loan->id)) {
            $this->error = $txHnd->error;
            return false;
        }
        return true;
    }
}