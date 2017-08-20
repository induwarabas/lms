<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/16/2017
 * Time: 7:40 PM
 */

namespace app\utils\enums;


use Zelenin\yii\SemanticUI\Elements;

class CollectorStatus
{
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';

    const colors  = [CollectorStatus::ACTIVE => 'green', CollectorStatus::INACTIVE => 'gray'];

    public static function label($status) {

        return Elements::label($status, ['class' => CollectorStatus::colors[$status]]);
    }
}