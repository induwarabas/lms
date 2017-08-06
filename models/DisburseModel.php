<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property string $date
 * @property integer $loan
 */
class DisburseModel extends \yii\base\Model
{
    public $date;
    public $loan;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'loan'], 'required'],
            [['date'], 'string'],
            [['loan'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'loan' => 'Loan',
        ];
    }
}
