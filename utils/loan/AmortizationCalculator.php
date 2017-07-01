<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 4:14 PM
 */

namespace app\utils\loan;


class AmortizationCalculator
{
    public $amount;
    public $interest;
    public $terms;
    public $interest_terms = 12;

    public function calculate()
    {
        $rate = $this->interest/ 100.0 / $this->interest_terms;
        $part1 = pow((1 + $rate), $this->terms);
        $part2 = $this->amount * $rate * $part1;
        $part3 = $part1 - 1;
        $payment = round(floor(100 * ($part2 / $part3)) / 100, 2, PHP_ROUND_HALF_UP);

        $schedule = new AmortizationSchedule();
        $schedule->payment = $payment;

        $balance = $this->amount;

        for ($x = 0; $x < $this->terms; $x++) {
            if ($x == $this->terms - 1) {
                $capital = $balance;
                $interest = $payment - $capital;
                array_push($schedule->schedule, ['amount' => $interest + $balance, 'interest' => $interest, 'principal' => $capital, 'balance'=> 0.0]);
            } else {
                $interest = round($balance * $rate, 2, PHP_ROUND_HALF_UP);
                $capital = $payment - $interest;
                $balance = $balance - $capital;
                array_push($schedule->schedule, ['amount' => $payment, 'interest' => $interest, 'principal' => $capital, 'balance'=> $balance]);
            }
        }
        $schedule->amount = $this->amount;
        $schedule->interest = $this->interest;
        $schedule->terms = $this->terms;
        $schedule->interest_terms = $this->interest_terms;
        $schedule->totalPayment = $payment * $this->terms;
        $schedule->totalInterest = $schedule->totalPayment - $this->amount;
        return $schedule;
    }
}