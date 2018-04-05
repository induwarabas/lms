<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/1/2017
 * Time: 4:14 PM
 */

namespace app\utils\loan;


use app\utils\Doubles;

class AmortizationCalculator
{
    public function calculateInstallment($amount, $interest_percentage, $terms, $interest_terms) {
        if (Doubles::compare($interest_percentage, 0.0) == 0) {
            return round($amount / $terms, 2, PHP_ROUND_HALF_UP);
        }
        $rate = $interest_percentage / 100.0 / $interest_terms;
        $part1 = pow((1 + $rate), $terms);
        $part2 = $amount * $rate * $part1;
        $part3 = $part1 - 1;
        return round(floor(100 * ($part2 / $part3)) / 100, 2, PHP_ROUND_HALF_UP);
    }
    public function calculate($amount, $interest_percentage, $terms, $interest_terms, $charges)
    {
        $rate = $interest_percentage / 100.0 / $interest_terms;
        $chargePerTerm = floor(100 * $charges / $terms) / 100;
        $payment = $this->calculateInstallment($amount, $interest_percentage, $terms, $interest_terms);

        $schedule = new AmortizationSchedule();
        $schedule->payment = $payment + $chargePerTerm;

        $balance = $amount;
        $chargesBalance = $charges;

        for ($x = 0; $x < $terms; $x++) {
            if ($x == $terms - 1) {
                $interest = $schedule->payment - $balance - $chargesBalance;
                array_push($schedule->schedule, ['amount'=> $schedule->payment,'interest' => $interest, 'principal' => $balance, 'balance' => 0.0, 'charges' => $chargesBalance]);
            } else {
                $interest = round($balance * $rate, 2, PHP_ROUND_HALF_UP);
                $capital = $payment - $interest;
                $balance = $balance - $capital;
                $chargesBalance = $chargesBalance - $chargePerTerm;
                array_push($schedule->schedule, ['amount'=> $schedule->payment, 'interest' => $interest, 'principal' => $capital, 'balance' => $balance, 'charges' => $chargePerTerm]);
            }
        }
        $schedule->amount = $amount;
        $schedule->interest = $interest_percentage;
        $schedule->charges = $charges;
        $schedule->terms = $terms;
        $schedule->interest_terms = $interest_terms;
        $schedule->totalPayment = $payment * $terms + $charges;
        $schedule->totalInterest = $schedule->totalPayment - $amount - $schedule->charges;
        return $schedule;
    }
}