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
            return ucwords($fm->asSpellout($val));
        };
    }
}