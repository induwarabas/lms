<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/20/2017
 * Time: 10:20 PM
 */

namespace app\models;


use yii\base\Model;

class CollectorAssignmentModel extends Model
{
    public $collector;

    public $loans;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collector', 'loans'], 'required'],
            [['loans'], 'string'],
            [['collector'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collector' => 'Collector',
            'loans' => 'Loans',
        ];
    }
}