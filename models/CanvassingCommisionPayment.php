<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property integer $txid
 * @property integer $canvasser
 * @property integer $crAccount
 * @property double $amount
 * @property string $payment
 * @property string $description
 * @property integer $bankAccount
 * @property integer $cheque
 * @property integer $stage
 * @property string $link
 * @property string $user
 */
class CanvassingCommisionPayment extends \yii\base\Model
{
    public $txid;
    public $canvasser;
    public $crAccount;
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
            [['amount', 'description', 'stage', 'link', 'canvasser'], 'required'],
            [['description', 'link', 'payment', 'crAccount'], 'string'],
            [['canvasser'], 'integer'],
            [['amount', 'stage', 'txid', 'bankAccount'], 'number', 'min' => 0],
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
            'canvasser' => 'Canvasser',
            'crAccount' => 'Credit Account',
            'amount' => 'Amount',
            'payment' => 'Payment',
            'bankAccount' => 'Bank Account',
            'cheque' => 'Cheque Number',
            'description' => 'Description',
            'stage' => 'Stage',
            'link' => 'Link',
            'user' => 'User',
        ];
    }
}
