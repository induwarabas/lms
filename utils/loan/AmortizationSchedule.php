<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 4:10 PM
 */

namespace app\utils\loan;


class AmortizationSchedule
{
    public $payment = 0.0;
    public $totalInterest = 0.0;
    public $totalPayment = 0.0;
    public $amount = 0.0;
    public $interest = 0.0;
    public $terms = 0;
    public $interest_terms = 12;
    public $schedule = array();
}