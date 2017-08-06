<?php

namespace app\models;

/**
 * This is the model class for table "account".
 *
 * @property double $amount
 * @property string $description
 * @property integer $stage
 * @property string $link
 */
class TellerGeneralExpence extends \yii\base\Model
{
    public $amount;
    public $description;
    public $stage;
    public $link;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'description', 'stage', 'link'], 'required'],
            [['description', 'link'], 'string'],
            [['amount', 'stage'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'amount' => 'Amount',
            'description' => 'Description',
            'stage' => 'Stage',
            'link' => 'Link',
        ];
    }
}
