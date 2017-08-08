<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property integer $txid
 * @property integer $drAccount
 * @property integer $crAccount
 * @property string $loanId
 * @property double $amount
 * @property string $payment
 * @property string $description
 * @property integer $bankAccount
 * @property integer $cheque
 * @property integer $stage
 * @property string $link
 * @property string $user
 */
class TellerPayment extends \yii\base\Model
{
    public $txid;
    public $drAccount;
    public $crAccount;
    public $loanId;
    public $amount;
    public $payment;
    public $bankAccount;
    public $cheque;
    public $description;
    public $stage;
    public $link;
    public $user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loanId', 'amount', 'description', 'stage', 'link', 'drAccount'], 'required'],
            [['loanId', 'description', 'link', 'payment', 'drAccount', 'crAccount'], 'string'],
            [['amount', 'stage', 'txid', 'bankAccount'], 'number', 'min' => 0],
            [['loanId'], 'string', 'max' => 10],
            [['cheque'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'txid' => 'Transaction ID',
            'loanId' => 'Loan ID',
            'drAccount' => 'Debit Account',
            'amount' => 'Amount',
            'payment' => 'Payment',
            'bankAccount' => 'Bank Account',
            'cheque' => 'Reference Number',
            'description' => 'Description',
            'stage' => 'Stage',
            'link' => 'Link',
            'user' => 'User',
        ];
    }
}
