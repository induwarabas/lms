<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property string $date
 */
class DayStartModel extends \yii\base\Model
{
    public $date;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
        ];
    }
}
