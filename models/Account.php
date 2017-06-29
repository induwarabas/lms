<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property string $type
 * @property string $balance
 */
class Account extends \yii\db\ActiveRecord
{
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
            [['id', 'type', 'balance'], 'required'],
            [['type'], 'string'],
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
}
