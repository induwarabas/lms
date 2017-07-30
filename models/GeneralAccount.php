<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_account".
 *
 * @property string $id
 * @property string $name
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
            [['id', 'name', 'description'], 'required'],
            [['id'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Account ID',
            'name' => 'Name',
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
