<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/27/2017
 * Time: 8:26 PM
 */

namespace app\models;


use yii\base\Model;


/**
 * MonthlySummarySearch.
 *
 * @property integer $year
 * @property integer $month
 */

class MonthlySummarySearch extends Model
{
    public $year;

    public $month;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year'], 'number', 'min' => 2017],
            [['month'], 'number', 'min' => 1, 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year' => 'Year',
            'month' => 'Months'
        ];
    }
}