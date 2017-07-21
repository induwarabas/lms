<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils\validators;


use app\models\Account;
use yii\validators\Validator;

class SavingAccountValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!isset($model->$attribute) ||$model->$attribute == null||  $model->$attribute == 0) {
            return;
        }
        if (strlen($model->$attribute) != 10) {
            $this->addError($model, $attribute, $model->attributeLabels()[$attribute] . ' length should be 10.');
            return;
        }

        $account = Account::findOne($model->$attribute);
        if ($account == null) {
            $this->addError($model, $attribute, "Invalid ".$model->attributeLabels()[$attribute]);
            return;
        }

        if ($account->type != Account::TYPE_SAVING) {
            $this->addError($model, $attribute, $model->attributeLabels()[$attribute]. " is not a saving account.");
            return;
        }
    }
}