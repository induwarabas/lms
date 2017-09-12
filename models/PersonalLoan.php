<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_loan".
 *
 * @property integer $id
 * @property string $notes
 */
class PersonalLoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notes'], 'required'],
            [['id'], 'integer'],
            [['notes'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Loan ID',
            'notes' => 'Notes',
        ];
    }

    /**
     * @inheritdoc
     * @return PersonalLoanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonalLoanQuery(get_called_class());
    }
}
