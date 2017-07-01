<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 10:18 PM
 */

namespace app\utils\loan;


class LoanDisbursement
{
    private $loanId;

    public function __construct($loanId)
    {
        $this->loanId = $loanId;
    }

    public function disburse()
    {

    }
}