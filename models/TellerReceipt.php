<?php

namespace app\models;
use app\utils\validators\SavingAccountValidator;

/**
 * This is the model class for table "account".
 *
 * @property string $txid
 * @property string $loanId
 * @property double $amount
 * @property string $payment
 * @property double $cheque
 * @property string $description
 * @property integer $stage
 * @property string $link
 * @property string $user
 */
class TellerReceipt extends \yii\base\Model
{
    public $txid;
    public $loanId;
    public $amount;
    public $payment;
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
            [['loanId', 'amount', 'description', 'stage', 'link', 'payment'], 'required'],
            [['loanId', 'description', 'link','payment', 'user'], 'string'],
            [['amount', 'stage','txid'], 'number', 'min' => 0],
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
            'loanId' => 'Loan ID',
            'amount' => 'Amount',
            'payment' => 'Payment',
            'cheque' => 'Cheque',
            'description' => 'Description',
            'stage' => 'Stage',
            'link' => 'Link',
            'txid' => 'Transaction ID',
            'user' => 'User',
        ];
    }
}
