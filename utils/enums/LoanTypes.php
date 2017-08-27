<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 9:41 PM
 */

namespace app\utils\enums;


use app\models\LoanType;
use yii\helpers\ArrayHelper;

class LoanTypes
{
    const HP_NEW_VEHICLE = 1;
    const HP_REG_VEHICLE_REFINANCE = 2;
    const HP_REG_VEHICLE_OTHER = 3;
    const PERSONAL = 4;
    const DAILY_COLLECTION = 5;

    public static function isVehicleLoan($type) {
        return $type == LoanTypes::HP_NEW_VEHICLE || $type == LoanTypes::HP_REG_VEHICLE_OTHER || $type == LoanTypes::HP_REG_VEHICLE_REFINANCE;
    }

    public static function getArrearsItem() {
        $arr['0'] = 'All';
        $arr['100'] = 'Vehicle loans';
        return ['' => 'All', '100' => 'Vehicle loans'] + ArrayHelper::map(LoanType::find()->all(), 'id', 'name');
     }
}