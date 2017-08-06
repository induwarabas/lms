<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils;


use yii\validators\Validator;

class NICValidator extends Validator
{
    public function getDetails($nicNo)
    {
        if (!preg_match("/(^[0-9]{9}(V|X)|^[0-9]{12})$/", $nicNo)) {
            return null;
        }

        $length = strlen($nicNo);

        $daysForMonths = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        if ($length == 10) {
            $year = "19" . substr($nicNo, 0, 2);
            $days = substr($nicNo, 2, 3);
        } else {
            $year = substr($nicNo, 0, 4);
            $days = substr($nicNo, 4, 3);
        }

        $gender = "Male";
        if ($days > 500) {
            $gender = "Female";
            $days = $days - 500;
        }

        if ($days > 366) {
            return null;
        }
        $month = "1";
        $day = "1";
        for ($i = 0; $i < 13; ++$i) {
            if ($days <= $daysForMonths[$i]) {
                $month = $i + 1;
                $day = number_format($days, 0);
                break;
            } else {
                $days = $days - $daysForMonths[$i];
            }
        }
        return ["gender" => $gender, "dob" => $year . "-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT)];
    }

    public function validateAttribute($model, $attribute)
    {
        $model->$attribute = strtoupper($model->$attribute);
        if ($this->getDetails($model->$attribute) == null) {
            $this->addError($model, $attribute, 'Invalid NIC number');
        }
    }

    public static function getOldNic($nic) {
        if (strlen($nic) == 12 && substr($nic, 0, 2) == "19") {
            return substr($nic, 2, 5).substr($nic, 8, 4).'V';
        }
        return $nic;
    }

    public static function getNewNic($nic) {
        if (strlen($nic) == 10) {
            return "19".substr($nic, 0, 5)."0".substr($nic, 5, 4);
        }
        return $nic;
    }

    public static function formatNicNo($nic) {
        if (strlen($nic) == 10) {
            return $nic." / 19".substr($nic, 0, 5)."0".substr($nic, 5, 4);
        } else if (strlen($nic) == 12 && substr($nic, 0, 2) == "19") {
            return $nic." / ".substr($nic, 2, 5).substr($nic, 8, 4).'V';
        }
        return $nic;
    }
}