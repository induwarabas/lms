<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 2/26/2018
 * Time: 10:23 PM
 */

namespace app\utils;


use app\models\LoanSchedule;
use app\models\MonthlyReport;
use Yii;

class MonthlyReportGenerator
{
    private  static function getStartOfMonth($year, $month) {
        return $year."-".str_pad($month, 2, "0", STR_PAD_LEFT)."-01";

    }

    private static function getRsVal($val, $default) {
        if ($val == null) {
            return $default;
        }
        return $val;
    }

    public static function generate($year, $month) {
        $prevMonth = $month - 1;
        $prevYear = $year;
        if($prevMonth == 0) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        }

        $nextYear = $year;
        $nextMonth = $month + 1;
        if ($nextMonth == 13) {
            $nextMonth = 1;
            $nextYear = $year + 1;
        }

        $expected = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE demand_date >= :start_date and demand_date < :end_date and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $expectedArr = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE demand_date < :start_date and (pay_date >= :p_date or pay_date is NULL) and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':p_date' => self::getStartOfMonth($year, $month)])->queryOne();

        $expArrPrincipal = self::getRsVal($expectedArr["principal"], 0.0);
        $expArrInterest = self::getRsVal($expectedArr["interest"], 0.0);
        $expArrCharges = self::getRsVal($expectedArr["charges"], 0.0);
        $expArrPenalty = self::getRsVal($expectedArr["penalty"], 0.0);

        $report = new MonthlyReport();
        $report->year = $year;
        $report->month = $month;
        $report->principal_exp = self::getRsVal($expected["principal"], 0.0);
        $report->interest_exp = self::getRsVal($expected["interest"], 0.0);
        $report->charges_exp = self::getRsVal($expected["charges"], 0.0);
        $report->penalty_exp = self::getRsVal($expected["penalty"], 0.0);
        $report->arrears_exp = $expArrPrincipal + $expArrInterest + $expArrCharges + $expArrPenalty;
        $report->total_exp =  $report->principal_exp + $report->interest_exp + $report->charges_exp + $report->penalty_exp + $report->arrears_exp;
        $report->profit_exp = $report->total_exp - $report->principal_exp - $report->charges_exp;

        $received = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE pay_date >= :start_date and pay_date < :end_date and demand_date >= :start_ddate and demand_date < :end_ddate and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth), ':start_ddate' =>self::getStartOfMonth($year, $month), ':end_ddate' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $receivedArr = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE pay_date >= :start_date and pay_date < :end_date and demand_date < :start_ddate and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth), ':start_ddate' =>self::getStartOfMonth($year, $month)])->queryOne();

        $report->principal_recv = self::getRsVal($received["principal"], 0.0);
        $report->interest_recv = self::getRsVal($received["interest"], 0.0);
        $report->charges_recv = self::getRsVal($received["charges"], 0.0);
        $report->penalty_recv = self::getRsVal($received["penalty"], 0.0);

        $recvArrPrincipal = self::getRsVal($receivedArr["principal"], 0.0);
        $recvArrInterest = self::getRsVal($receivedArr["interest"], 0.0);
        $recvArrCharges = self::getRsVal($receivedArr["charges"], 0.0);
        $recvArrPenalty = self::getRsVal($receivedArr["penalty"], 0.0);

        $report->arrears_recv =$recvArrPrincipal + $recvArrInterest + $recvArrCharges + $recvArrPenalty;
        $report->total_recv = $report->principal_recv + $report->interest_recv + $report->charges_recv + $report->penalty_recv + $report->arrears_recv;
        $report->profit_recv = $report->total_recv - $report->principal_recv - $report->charges_recv;

        $report->arrears = $report->total_exp - $report->total_recv;

        $loans = Yii::$app->getDb()->createCommand("SELECT count(*) as loan_count, sum(`amount`) as loan_amount FROM `loan` WHERE disbursed_date >= :start_date and disbursed_date < :end_date",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $report->loan_count = self::getRsVal($loans["loan_count"], 0);
        $report->loan_value = self::getRsVal($loans["loan_amount"], 0.0);
        return $report;
    }
}