<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property string $type
 * @property double $balance
 * @property string $protection
 */
class Account extends \yii\db\ActiveRecord
{
    const TYPE_SAVING = 'SAVING';
    const TYPE_LOAN = 'LOAN';
    const TYPE_SUPPLIER = 'SUPPLIER';
    const TYPE_CANVASSER = 'CANVASSER';
    const TYPE_GENERAL = 'GENERAL';
    const TYPE_IDS = [
        Account::TYPE_SAVING => '1',
        Account::TYPE_LOAN => '2',
        Account::TYPE_SUPPLIER => '3',
        Account::TYPE_CANVASSER => '4',
        Account::TYPE_GENERAL => '9',
    ];

    const PROTECTION_NONE = 'NONE';
    const PROTECTION_PLUS = 'PLUS';
    const PROTECTION_MINUS = 'MINUS';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'balance', 'protection'], 'required'],
            [['type', 'protection'], 'string'],
            [['balance'], 'number'],
            [['id'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Acocunt ID',
            'type' => 'Type',
            'balance' => 'Balance',
            'protection' => 'Protection',
        ];
    }

    /**
     * @inheritdoc
     * @return AccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountQuery(get_called_class());
    }

    /**
     * Creates the account id
     * @param $type integer
     * @param $id integer
     * @return string
     */
    public static function createAccountId($type, $id)
    {
        return Account::TYPE_IDS[$type] . str_pad($id, 9, '0', STR_PAD_LEFT);
    }
}
