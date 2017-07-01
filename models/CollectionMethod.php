<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "collection_method".
 *
 * @property integer $id
 * @property string $name
 * @property integer $penal_after
 * @property string $penal_after_unit
 *
 * @property Loan[] $loans
 */
class CollectionMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collection_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'penal_after', 'penal_after_unit'], 'required'],
            [['penal_after'], 'integer'],
            [['penal_after_unit'], 'string'],
            [['name'], 'string', 'max' => 12],
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
            'penal_after' => 'Penal After',
            'penal_after_unit' => 'Penal After Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['collection_method' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CollectionMethodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CollectionMethodQuery(get_called_class());
    }
}
