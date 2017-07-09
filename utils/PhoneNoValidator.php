<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils;


use yii\validators\Validator;

class PhoneNoValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $phone = $model->$attribute;
        $length = strlen($phone);
        if ($length < 9) {
            $this->addError($model, $attribute, $model->attributeLabels()[$attribute] . ' is not a valid phone number');
            return;
        }

        if (substr($phone, 0, 1) == "+" && substr($phone, 0, 3) != "+94") {
            return;
        }

        if ($length == 9) {
            $phone = "+94" . $phone;
        }

        if ($length == 10) {
            if (substr($phone, 0, 1) == '0') {
                $phone = "+94" . substr($phone, 1);
            } else {
                $this->addError($model, $attribute, $model->attributeLabels()[$attribute] . ' is not a valid phone number');
                return;
            }
        }

        if (!preg_match("/^\\+94[1-9][0-9]{8}$/", $phone)) {
            $this->addError($model, $attribute, $model->attributeLabels()[$attribute] . ' is not a valid phone number');
            return;
        }
        $model->$attribute = $phone;
    }
}