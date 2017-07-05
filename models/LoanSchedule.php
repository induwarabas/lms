<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loan_schedule".
 *
 * @property integer $loan_id
 * @property integer $installment_id
 * @property string $status
 * @property string $demand_date
 * @property string $principal
 * @property string $interest
 * @property string $charges
 * @property integer $arrears
 * @property number $penalty
 * @property string $paid
 * @property number $due
 * @property string $balance
 */
class LoanSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_id', 'installment_id', 'status', 'demand_date', 'principal', 'interest', 'charges', 'arrears', 'penalty', 'paid', 'due', 'balance'], 'required'],
            [['loan_id', 'installment_id', 'arrears'], 'integer'],
            [['status'], 'string'],
            [['demand_date'], 'safe'],
            [['principal', 'interest', 'charges', 'penalty', 'paid', 'due', 'balance'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'loan_id' => 'Loan ID',
            'installment_id' => 'Installment ID',
            'status' => 'Status',
            'demand_date' => 'Demand Date',
            'principal' => 'Principal',
            'interest' => 'Interest',
            'charges' => 'Charges',
            'arrears' => 'Arrears',
            'penalty' => 'Penalty',
            'paid' => 'Paid',
            'due' => 'Due',
            'balance' => 'Balance',
        ];
    }

    /**
     * @inheritdoc
     * @return LoanScheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoanScheduleQuery(get_called_class());
    }
}
