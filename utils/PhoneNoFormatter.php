<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/9/2017
 * Time: 1:37 PM
 */

namespace app\utils;


class PhoneNoFormatter
{
    public static function format($phone) {
        if (strlen($phone) != 12) {
            return $phone;
        } else {
            return substr($phone, 0, 3)." (".substr($phone, 3, 2).") ".substr($phone, 5, 3)." ".substr($phone, 8);
        }
    }
}