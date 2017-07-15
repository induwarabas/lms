<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 9:41 PM
 */

namespace app\utils\enums;


use Zelenin\yii\SemanticUI\Elements;

class LoanStatus
{
    const PENDING = "PENDING";
    const ACTIVE = "ACTIVE";
    const COMPLETED = "COMPLETED";
    const CLOSED = "CLOSED";
    const colors  = [LoanStatus::PENDING => 'blue', LoanStatus::ACTIVE => 'green', LoanStatus::COMPLETED => 'orange', LoanStatus::CLOSED => 'gray'];

    public static function label($status) {

        return Elements::label($status, ['class' => LoanStatus::colors[$status]]);
    }
}