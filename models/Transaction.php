<?php

namespace app\models;

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
 * @property integer $reverted
 * @property string $user
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
            [['cr_account', 'dr_account', 'cr_balance', 'dr_balance', 'amount', 'type', 'txlink', 'description', 'payment', 'user'], 'required'],
            [['cr_balance', 'dr_balance', 'amount'], 'number'],
            [['reverted'], 'integer'],
            [['cr_account', 'dr_account'], 'string', 'max' => 12],
            [['type', 'payment'], 'string', 'max' => 10],
            [['cheque', 'user'], 'string', 'max' => 32],
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
            'txid' => 'ID',
            'timestamp' => 'Transaction Time',
            'cr_account' => 'Credit Account',
            'dr_account' => 'Debit Account',
            'cr_balance' => 'Credit Balance',
            'dr_balance' => 'Debit Balance',
            'amount' => 'Amount',
            'type' => 'Transaction Type',
            'payment' => 'Payment Type',
            'cheque' => 'Reference Number',
            'txlink' => 'Link',
            'reverted' => 'Reverted',
            'user' => 'User',
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
