<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property int $txid
 */
class Receipt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['txid'], 'required'],
            [['txid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'txid' => 'Txid',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ReceiptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReceiptQuery(get_called_class());
    }
}
