<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils;


use yii\validators\Validator;

class NICValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
       // preg_match("")
        if (strlen($model->$attribute) != 10 && strlen($model->$attribute) != 12){
            $this->addError($model, $attribute, 'The '.$model->attributeLabels()[$attribute].' should be 10 or 12');
        }
    }
}