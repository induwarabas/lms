<?php

namespace app\models;

use yii\base\Model;

/**
 * This is the model class for table "transaction".
 *
 * @property string $cr_account
 * @property string $dr_account
 * @property integer $bank_account
 * @property number $amount
 * @property string $payment
 * @property string $cheque
 * @property string $link
 * @property string $description
 * @property integer $stage
 * @property integer $error
 */
class BankTransaction extends Model
{
    public $cr_account;
    public $dr_account;
    public $bank_account;
    public $amount;
    public $payment;
    public $cheque;
    public $link;
    public $description;
    public $stage;
    public $error = null;


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
            [['bank_account', 'amount', 'link', 'description', 'payment', 'stage'], 'required'],
            [['cr_account', 'dr_account'], 'string', 'max' => 12],
            [['payment'], 'string', 'max' => 10],
            [['error'], 'string'],
            [['cheque'], 'string', 'max' => 32],
            [['link'], 'string', 'max' => 20],
            [['stage'], 'number'],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cr_account' => 'Credit Account',
            'dr_account' => 'Debit Account',
            'bank_account' => 'Bank Account',
            'amount' => 'Amount',
            'payment' => 'Payment Type',
            'cheque' => 'Cheque Number',
            'link' => 'Link',
            'description' => 'Description',
            'stage' => 'Stage',
            'error' => 'Error',
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
