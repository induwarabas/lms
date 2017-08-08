<?php

namespace app\models;

/**
 * This is the model class for table "general_account".
 *
 * @property integer $id
 * @property string $account_id
 * @property string $name
 * @property string $type
 * @property string $description
 */
class GeneralAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'general_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'description'], 'required'],
            [['account_id'], 'string', 'max' => 10],
            [['name', 'type'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }

    /**
     * @inheritdoc
     * @return GeneralAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneralAccountQuery(get_called_class());
    }
}
