<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loan".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $customer_id
 * @property string $saving_account
 * @property string $loan_account
 * @property string $amount
 * @property string $interest
 * @property string $penalty
 * @property string $charges
 * @property integer $collection_method
 * @property integer $period
 * @property string $status
 * @property string $disbursed_date
 * @property string $closed_date
 * @property number $installment
 * @property string $total_interest
 * @property string $total_payment
 *
 * @property CollectionMethod $collectionMethod
 * @property LoanType $type0
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'customer_id', 'amount', 'interest', 'penalty', 'charges', 'collection_method', 'period'], 'required'],
            [['type', 'customer_id', 'collection_method', 'period'], 'integer'],
            [['amount', 'interest', 'penalty', 'charges', 'installment', 'total_interest', 'total_payment'], 'number'],
            [['status'], 'string'],
            [['disbursed_date', 'closed_date'], 'safe'],
            [['saving_account', 'loan_account'], 'string', 'max' => 12],
            [['collection_method'], 'exist', 'skipOnError' => true, 'targetClass' => CollectionMethod::className(), 'targetAttribute' => ['collection_method' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => LoanType::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Loan ID',
            'type' => 'Loan Type',
            'customer_id' => 'Customer ID',
            'saving_account' => 'Saving Account',
            'loan_account' => 'Loan Account',
            'amount' => 'Amount',
            'interest' => 'Interest',
            'penalty' => 'Penalty',
            'charges' => 'Charges',
            'collection_method' => 'Collection Method',
            'period' => 'Period',
            'status' => 'Status',
            'disbursed_date' => 'Disbursed Date',
            'closed_date' => 'Closed Date',
            'installment' => 'Installment',
            'total_interest' => 'Total Interest',
            'total_payment' => 'Total Payment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollectionMethod()
    {
        return $this->hasOne(CollectionMethod::className(), ['id' => 'collection_method']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(LoanType::className(), ['id' => 'type']);
    }

    /**
     * @inheritdoc
     * @return LoanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoanQuery(get_called_class());
    }
}