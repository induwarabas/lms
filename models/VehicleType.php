<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicle_type".
 *
 * @property integer $id
 * @property string $name
 */
class VehicleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicle_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
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
     * @return VehicleTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VehicleTypeQuery(get_called_class());
    }
}
