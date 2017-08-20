<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "collection".
 *
 * @property integer $collector_id
 * @property integer $loan_id
 * @property string $date
 * @property string $status
 * @property integer $installments
 * @property double $amount
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collector_id', 'loan_id', 'date', 'installments', 'status', 'amount'], 'required'],
            [['collector_id', 'loan_id', 'installments'], 'integer'],
            [['date'], 'safe'],
            [['status'], 'string'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collector_id' => 'Collector',
            'loan_id' => 'Loan',
            'date' => 'Date',
            'installments' => 'Installments',
            'status' => 'Status',
            'amount' => 'amount',
        ];
    }

    /**
     * @inheritdoc
     * @return CollectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionQuery(get_called_class());
    }
}
