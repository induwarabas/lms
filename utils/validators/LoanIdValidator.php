<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/7/2017
 * Time: 10:08 AM
 */

namespace app\utils\validators;


use app\models\Account;
use app\models\Loan;
use yii\validators\Validator;

class LoanIdValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!isset($model->$attribute) ||$model->$attribute == null||  $model->$attribute == 0) {
            return;
        }

        $account = Loan::findOne($model->$attribute);
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