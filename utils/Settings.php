<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/27/2017
 * Time: 9:20 AM
 */

namespace app\utils;


use app\models\Setting;

class Settings
{
    public static function brandLabel() {
        return Setting::findOne(3)->value;
    }

    public static function companyName() {
        return Setting::findOne(2)->value;
    }

    public static function date() {
        return Setting::findOne(1)->value;
    }
}