<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils;


use yii\validators\Validator;

class LoanCustomerValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!isset($model->$attribute) ||$model->$attribute == null||  $model->$attribute == 0) {
            return;
        }
        if ($model->customer_id == $model->$attribute) {
            $this->addError($model, $attribute, $model->attributeLabels()[$attribute] . ' cannot be same as the applicant.');
            return;
        }

        if ($attribute == 'guarantor_2' && $model->guarantor_1 == $model->guarantor_2) {
            $this->addError($model, $attribute, 'Same guarantor cannot be appear twice.');
            return;
        }

        if ($attribute == 'guarantor_3' && ($model->guarantor_1 == $model->guarantor_3 || $model->guarantor_2 == $model->guarantor_3)) {
            $this->addError($model, $attribute, 'Same guarantor cannot be appear twice.');
            return;
        }
    }
}