<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 2/26/2018
 * Time: 10:23 PM
 */

namespace app\utils;


use app\models\Account;
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

        $report = new MonthlyReport();
        $report->year = $year;
        $report->month = $month;
        $loans = Yii::$app->getDb()->createCommand("SELECT count(*) as loan_count, sum(`amount`) as loan_amount FROM `loan` WHERE disbursed_date >= :start_date and disbursed_date < :end_date",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $report->loan_count = self::getRsVal($loans["loan_count"], 0);
        $report->loan_value = self::getRsVal($loans["loan_amount"], 0.0);

        $expected = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE `status` != 'PENDING' and demand_date >= :start_date and demand_date < :end_date and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $report->exp_principal = self::getRsVal($expected["principal"], 0.0);
        $report->exp_charges = self::getRsVal($expected["charges"], 0.0);
        $report->exp_interest = self::getRsVal($expected["interest"], 0.0);
        $report->exp_penalty = self::getRsVal($expected["penalty"], 0.0);
        $report->exp_total = $report->exp_principal + $report->exp_charges + $report->exp_interest + $report->exp_penalty;

        $expectedArr = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE `status` != 'PENDING' and demand_date < :start_date and (pay_date >= :p_date or pay_date is NULL) and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':p_date' => self::getStartOfMonth($year, $month)])->queryOne();

        $report->exp_arr_principal = self::getRsVal($expectedArr["principal"], 0.0);
        $report->exp_arr_charges = self::getRsVal($expectedArr["charges"], 0.0);
        $report->exp_arr_interest = self::getRsVal($expectedArr["interest"], 0.0);
        $report->exp_arr_penalty = self::getRsVal($expectedArr["penalty"], 0.0);
        $report->exp_arr_total = $report->exp_arr_principal + $report->exp_arr_charges + $report->exp_arr_interest + $report->exp_arr_penalty;
        $report->receivable = $report->exp_total + $report->exp_arr_total;

        $report->receivable = $report->exp_total + $report->exp_arr_total;
        $received = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE `status` = 'PAYED' and pay_date >= :start_date and pay_date < :end_date and demand_date >= :start_ddate and demand_date < :end_ddate and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth), ':start_ddate' =>self::getStartOfMonth($year, $month), ':end_ddate' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $report->recv_principal = self::getRsVal($received["principal"], 0.0);
        $report->recv_charges = self::getRsVal($received["charges"], 0.0);
        $report->recv_interest = self::getRsVal($received["interest"], 0.0);
        $report->recv_penalty = self::getRsVal($received["penalty"], 0.0);
        $report->recv_total = $report->recv_principal + $report->recv_charges + $report->recv_interest + $report->recv_penalty;

        $receivedArr = Yii::$app->getDb()->createCommand("SELECT sum(principal) as principal, sum(interest) as interest, sum(charges) as charges, sum(penalty) as penalty FROM `loan_schedule` WHERE `status` = 'PAYED' and pay_date >= :start_date and pay_date < :end_date and demand_date < :start_ddate and (settled = 0 or arrears > 0)",
            [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth), ':start_ddate' =>self::getStartOfMonth($year, $month)])->queryOne();

        $report->recv_arr_principal = self::getRsVal($receivedArr["principal"], 0.0);
        $report->recv_arr_charges = self::getRsVal($receivedArr["charges"], 0.0);
        $report->recv_arr_interest = self::getRsVal($receivedArr["interest"], 0.0);
        $report->recv_arr_penalty = self::getRsVal($receivedArr["penalty"], 0.0);
        $report->recv_arr_total = $report->recv_arr_principal + $report->recv_arr_charges + $report->recv_arr_interest + $report->recv_arr_penalty;
        $report->received = $report->recv_total + $report->recv_arr_total;

        $savingBalance2=0.0;

        echo date("Y")."-".date("m");

        if ($year == date("Y") && $month == date("m")) {
            $savingBalance2 = Yii::$app->getDb()->createCommand("select sum(account.balance) as balance from loan, account where account.id = loan.saving_account and loan.id in (SELECT DISTINCT(loan_id) FROM `loan_schedule` WHERE (`status` in ('DEMANDED', 'ARREARS')) and (settled = 0 or arrears > 0))",
                [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne()["balance"];
        } else {
            $savingAccounts = Yii::$app->getDb()->createCommand("select loan.saving_account as saving_account from loan where loan.id in (SELECT DISTINCT(loan_id) FROM `loan_schedule` WHERE (`status` in ('DEMANDED', 'ARREARS')) and (settled = 0 or arrears > 0))",
                [':start_date' =>self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryAll();

            foreach ($savingAccounts as $saving) {
                $bal = Account::getBalanceAsAt($saving["saving_account"], self::getStartOfMonth($nextYear, $nextMonth));
                $savingBalance2 += $bal;
                //echo $saving["saving_account"]."\t".$bal."\t".$savingBalance2."<br/>";
            }
        }



        $halfPaid = Yii::$app->getDb()->createCommand("SELECT sum(paid) as paid FROM `loan_schedule` WHERE `status` != 'PAYED' and demand_date < :end_date and (settled = 0 or arrears > 0)",
            [ ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();

        $paidValue = self::getRsVal($halfPaid["paid"], 0.0);
        $report->savingBalance = $savingBalance2;
        $report->partialPay = $paidValue;
        $report->arrears = $report->receivable - $report->received - $paidValue - $savingBalance2;

        $settlements = Yii::$app->getDb()->createCommand("SELECT count(*) as settle_count, sum(amount) settle_amount FROM `transaction` WHERE cr_account = '9000000005' and type ='SETTLEMENT' and `timestamp` >= :start_date and `timestamp` < :end_date", [':start_date' => self::getStartOfMonth($year, $month), ':end_date' => self::getStartOfMonth($nextYear, $nextMonth)])->queryOne();
        $report->settlment_count = self::getRsVal($settlements["settle_count"], 0);
        $report->settlment_amount = self::getRsVal($settlements["settle_amount"], 0.0);

        return $report;
    }
}