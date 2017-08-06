<?php

namespace app\models;

/**
 * This is the model class for table "vehicle_brand".
 *
 * @property integer $id
 * @property string $name
 */
class VehicleBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @inheritdoc
     * @return VehicleBrandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehicleBrandQuery(get_called_class());
    }
}
