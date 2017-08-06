<?php

namespace app\models;

/**
 * This is the model class for table "bank_account".
 *
 * @property integer $id
 * @property integer $bank
 * @property string $bank_account_id
 * @property string $account_id
 * @property string $description
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank', 'bank_account_id', 'description'], 'required'],
            [['bank'], 'integer'],
            [['description'], 'string'],
            [['bank_account_id'], 'string', 'max' => 24],
            [['account_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bank' => 'Bank',
            'bank_account_id' => 'Bank Account ID',
            'account_id' => 'Account ID',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return BankAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BankAccountQuery(get_called_class());
    }

    public static function getBankAccItems()
    {
        $items = [];
        $accounts = BankAccount::find()->all();
        foreach ($accounts as $account) {
            $items[$account->id] = Bank::findOne($account->bank)->name . " - " . $account->bank_account_id;
            //array_push($items, ]);
        }
        return $items;
    }
}
