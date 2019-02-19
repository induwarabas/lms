<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 9:41 PM
 */

namespace app\utils\enums;


use Zelenin\yii\SemanticUI\Elements;

class LoanPaymentStatus
{
    const DONE = "DONE";
    const DEMANDED = "DEMANDED";
    const ARREARS = "ARREARS";
    const SEIZED = "SEIZED";
    const colors  = [LoanPaymentStatus::DONE => 'green', LoanPaymentStatus::DEMANDED => 'orange', LoanPaymentStatus::ARREARS => 'red', LoanPaymentStatus::SEIZED => 'red'];

    public static function label($status) {

        return Elements::label($status, ['class' => LoanPaymentStatus::colors[$status]]);
    }
}