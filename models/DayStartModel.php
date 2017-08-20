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
    public $daily;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'daily'], 'required'],
            [['date'], 'string'],
            [['daily'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'daily' => 'Daily Collection',
        ];
    }
}
