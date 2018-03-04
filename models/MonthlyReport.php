<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monthly_report".
 *
 * @property integer $year
 * @property integer $month
 * @property string $principal_exp
 * @property string $interest_exp
 * @property string $charges_exp
 * @property string $penalty_exp
 * @property string $arrears_exp
 * @property string $total_exp
 * @property string $profit_exp
 * @property string $principal_recv
 * @property string $interest_recv
 * @property string $charges_recv
 * @property string $penalty_recv
 * @property string $arrears_recv
 * @property string $total_recv
 * @property string $profit_recv
 * @property string $arrears
 * @property integer $loan_count
 * @property string $loan_value
 */
class MonthlyReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monthly_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'month', 'principal_exp', 'interest_exp', 'charges_exp', 'penalty_exp', 'arrears_exp', 'total_exp', 'profit_exp', 'principal_recv', 'interest_recv', 'charges_recv', 'penalty_recv', 'arrears_recv', 'total_recv', 'profit_recv', 'arrears', 'loan_count', 'loan_value'], 'required'],
            [['year', 'month', 'loan_count'], 'integer'],
            [['principal_exp', 'interest_exp', 'charges_exp', 'penalty_exp', 'arrears_exp', 'total_exp', 'profit_exp', 'principal_recv', 'interest_recv', 'charges_recv', 'penalty_recv', 'arrears_recv', 'total_recv', 'profit_recv', 'arrears', 'loan_value'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year' => 'Year',
            'month' => 'Month',
            'principal_exp' => 'Expected Principal',
            'interest_exp' => 'Expected Interest',
            'charges_exp' => 'Expected Charges',
            'penalty_exp' => 'Expected Penalty',
            'arrears_exp' => 'Expected Arrears',
            'total_exp' => 'Expected Total',
            'profit_exp' => 'Expected Profit',
            'principal_recv' => 'Received Principal',
            'interest_recv' => 'Received Interest',
            'charges_recv' => 'Received Charges',
            'penalty_recv' => 'Received Penalty',
            'arrears_recv' => 'Received Arrears',
            'total_recv' => 'Received Total',
            'profit_recv' => 'Received Profit',
            'arrears' => 'Arrears',
            'loan_count' => 'Loan Count',
            'loan_value' => 'Loan Value',
        ];
    }

    /**
     * @inheritdoc
     * @return MonthlyReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MonthlyReportQuery(get_called_class());
    }
}
