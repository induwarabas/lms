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
use app\utils\enums\LoanStatus;

class LoanCreator
{
    private $loanId = 0;
    private $savingAccountId = "";
    private $loanAccountId = "";

    public function getLoanId() {
        return $this->loanId;
    }

    /**
     * Create loan
     * @param Loan $loan
     * @return integer instance matching the condition, or `null` if nothing matches.
     */
    public function createLoan($loan) {
//        $loan = new Loan;
//        $loan->customer_id = $customer_id;
//        $loan->amount = $amount;
//        $loan->interest = $interest;
//        $loan->charges = $charges;
//        $loan->penalty = $penalty;
//        $loan->type = $type;
        unset($loan->id);
        $loan->status = LoanStatus::PENDING;
        //$loan->collection_method = $collection_method;
        //$loan->period = $period;
        if (!$loan->save()) {
            return -1;
        }

        $this->loanId = $loan->getPrimaryKey();
        $accIdPostfix = str_pad($this->loanId, 9, '0', STR_PAD_LEFT);

        $this->savingAccountId = Account::createAccountId(Account::TYPE_SAVING, $this->loanId);
        $this->loanAccountId = Account::createAccountId(Account::TYPE_LOAN, $this->loanId);

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

        return $loan->getPrimaryKey();
    }
}