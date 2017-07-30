<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 9:41 PM
 */

namespace app\utils\enums;


class LoanTypes
{
    const HP_NEW_VEHICLE = 1;
    const HP_REG_VEHICLE_REFINANCE = 2;
    const HP_REG_VEHICLE_OTHER = 3;
    const PERSONAL = 4;

    public static function isVehicleLoan($type) {
        return $type == LoanTypes::HP_NEW_VEHICLE || $type == LoanTypes::HP_REG_VEHICLE_OTHER || $type == LoanTypes::HP_REG_VEHICLE_REFINANCE;
    }
}