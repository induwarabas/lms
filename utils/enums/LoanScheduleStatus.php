<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 9:41 PM
 */

namespace app\utils\enums;


use Zelenin\yii\SemanticUI\Elements;

class LoanScheduleStatus
{
    const PENDING = "PENDING";
    const DEMANDED = "DEMANDED";
    const ARREARS = "ARREARS";
    const PAYED = "PAYED";

    const colors  = [LoanScheduleStatus::PENDING => 'blue', LoanScheduleStatus::PAYED => 'green', LoanScheduleStatus::DEMANDED => 'yellow', LoanScheduleStatus::ARREARS => 'red'];

    public static function label($status) {

        return Elements::label($status, ['class' => LoanScheduleStatus::colors[$status]]);
    }
}