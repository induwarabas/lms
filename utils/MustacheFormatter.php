<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/13/2017
 * Time: 11:34 AM
 */

namespace app\utils;


class MustacheFormatter
{
    public function number()
    {
        return function ($block, $render) {
            $val = $render($block);
            return number_format($val, 2);
        };
    }

    public function spell()
    {
        return function ($block, $render) {
            $val = $render($block);
            $fm = new \yii\i18n\Formatter();
            $num = str_replace(",", "", number_format($val, 2));
            $parts = explode(".", $num);
            if ($parts[1] == "00") {
                return ucwords($fm->asSpellout($parts[0]). " Rupees");
            } else {
                return ucwords($fm->asSpellout($parts[0]). " Rupees")." and ".ucwords($fm->asSpellout($parts[1])." Cents");
            }

        };
    }

    public function newline()
    {
        return function ($block, $render) {
            $val = $render($block);
            return str_replace("\n", "<br/>", $val);
        };
    }
}