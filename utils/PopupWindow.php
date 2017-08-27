<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/27/2017
 * Time: 9:12 AM
 */

namespace app\utils;


class PopupWindow
{
    public static function show($url) {
        return "MyWindow=window.open('".$url."','MyWindow',width=1024,height=300); return false;";
    }
}