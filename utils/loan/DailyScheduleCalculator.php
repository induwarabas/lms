<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/20/2017
 * Time: 11:21 AM
 */

namespace app\utils\loan;


class DailyScheduleCalculator
{

    public function getDays($months) {
        return floor($months / 2) * 44 + ($months % 2) * 21;
    }

    /**
     * Calculates the daily schedule
     * @param double $amount
     * @param double $interest
     * @param integer $months
     * @return double
     */
    public function calculateInstallment($amount, $interest, $months) {
        $days = $this->getDays($months);
        $totalInterest = floor($amount * $interest * $months) / 100;
        $installment = ceil(($amount + $totalInterest) / $days);
        return $installment;
    }

    /**
     * Calculates the daily schedule
     * @param double $amount
     * @param double $interest
     * @param integer $months
     * @return AmortizationSchedule
     */
    public function calculate($amount, $interest, $months)
    {
        $payment = $this->calculateInstallment($amount, $interest, $months);
        $days = $this->getDays($months);

        $schedule = new AmortizationSchedule();
        $schedule->payment = $payment;

        $balance = $amount;
        $principal = floor(100 * $amount / $days) / 100;
        $interestAmount = $payment - $principal;

        for ($x = 0; $x < $days; $x++) {
            if ($x == $days - 1) {
                $interestAmount = $schedule->payment - $balance;
                array_push($schedule->schedule, ['amount'=> $schedule->payment,'interest' => $interestAmount, 'principal' => $balance, 'balance' => 0.0, 'charges' => 0.0]);
            } else {
                $balance = $balance - $principal;
                array_push($schedule->schedule, ['amount'=> $schedule->payment, 'interest' => $interestAmount, 'principal' => $principal, 'balance' => $balance, 'charges' => 0.0]);
            }
        }
        $schedule->amount = $amount;
        $schedule->interest = $interest;
        $schedule->terms = $days;
        $schedule->totalPayment = $payment * $days;
        $schedule->totalInterest = $schedule->totalPayment - $amount;
        return $schedule;
    }
}