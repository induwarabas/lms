<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 11:35 AM
 */

namespace app\utils\loan;


use app\models\Account;
use app\models\Loan;

class LoanCreator
{
    private $loanId = 0;
    private $savingAccountId = "";
    private $loanAccountId = "";

    public function getLoanId() {
        return $this->loanId;
    }

    public function createLoan($customer_id, $type, $amount, $interest, $penalty, $charges, $collection_method, $period) {
        $loan = new Loan;
        $loan->customer_id = $customer_id;
        $loan->amount = $amount;
        $loan->interest = $interest;
        $loan->charges = $charges;
        $loan->penalty = $penalty;
        $loan->type = $type;
        $loan->collection_method = $collection_method;
        $loan->period = $period;
        if (!$loan->save()) {
            return false;
        }

        $this->loanId = $loan->getPrimaryKey();
        $accIdPostfix = str_pad($this->loanId, 9, '0', STR_PAD_LEFT);

        $this->savingAccountId = '1'.$accIdPostfix;
        $this->loanAccountId = '2'.$accIdPostfix;

        $loan->saving_account = $this->savingAccountId;
        $loan->loan_account = $this->loanAccountId;
        $loan->save();

        $savingAccount = new Account;
        $savingAccount->id = $this->savingAccountId;
        $savingAccount->type = 'SAVING';
        $savingAccount->balance = 0.0;
        $savingAccount->protection = 'PLUS';
        $savingAccount->save();

        $loanAccount = new Account;
        $loanAccount->id = $this->loanAccountId;
        $loanAccount->type = 'LOAN';
        $loanAccount->balance = 0.0;
        $loanAccount->protection = 'MINUS';
        $loanAccount->save();

        return true;
    }
}