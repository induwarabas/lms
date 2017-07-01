<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loan_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Loan[] $loans
 */
class LoanType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loan_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
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
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LoanTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoanTypeQuery(get_called_class());
    }
}
