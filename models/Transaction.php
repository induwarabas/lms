<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $txid
 * @property string $timestamp
 * @property string $cr_account
 * @property string $dr_account
 * @property number $cr_balance
 * @property number $dr_balance
 * @property number $amount
 * @property string $type
 * @property string $payment
 * @property string $cheque
 * @property string $txlink
 * @property string $description
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
            [['cr_account', 'dr_account', 'cr_balance', 'dr_balance', 'amount', 'type', 'txlink', 'description','payment'], 'required'],
            [['cr_balance', 'dr_balance', 'amount'], 'number'],
            [['cr_account', 'dr_account'], 'string', 'max' => 12],
            [['type','payment'], 'string', 'max' => 10],
            [['cheque'], 'string', 'max' => 32],
            [['txlink'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'txid' => 'Transaction ID',
            'timestamp' => 'Transaction Time',
            'cr_account' => 'Credit Account',
            'dr_account' => 'Debit Account',
            'cr_balance' => 'Credit Balance',
            'dr_balance' => 'Debit Balance',
            'amount' => 'Amount',
            'type' => 'Transaction Type',
            'payment' => 'Payment Type',
            'cheque' => 'Cheque Number',
            'txlink' => 'Link',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return TransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionQuery(get_called_class());
    }
}
