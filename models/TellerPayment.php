<?php

namespace app\models;
use app\utils\validators\SavingAccountValidator;

/**
 * This is the model class for table "account".
 *
 * @property string $loanId
 * @property double $amount
 * @property string $description
 * @property integer $stage
 */
class TellerPayment extends \yii\base\Model
{
    public $loanId;
    public $amount;
    public $description;
    public $stage;
    public $link;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanId', 'amount', 'description', 'stage', 'link'], 'required'],
            [['loanId', 'description', 'link'], 'string'],
            [['amount', 'stage'], 'number', 'min' => 0],
            [['loanId'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loanId' => 'Loan ID',
            'amount' => 'Amount',
            'description' => 'Description',
            'stage' => 'Stage',
            'link' => 'Link',
        ];
    }
}
