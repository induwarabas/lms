<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property integer $loanId
 * @property double $principal
 * @property double $charges
 * @property double $interest
 * @property double $penalty
 * @property integer $stage
 */
class LoanSettlement extends \yii\base\Model
{
    public $loanId;
    public $principal;
    public $charges;
    public $interest;
    public $penalty;
    public $stage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanId', 'principal', 'charges', 'interest', 'penalty', 'stage'], 'required'],
            [['principal', 'charges', 'interest', 'penalty', 'stage'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loanId' => 'Loan ID',
            'principal' => 'Principal',
            'interest' => 'Interest',
            'charges' => 'Charges',
            'penalty' => 'Penalty',
            'stage' => 'Stage',
        ];
    }
}
