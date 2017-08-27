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
 * ArrearsSearch.
 *
 * @property integer $area
 * @property integer $arrears
 * @property integer $type
 */

class ArrearsSearch extends Model
{
    public $area;

    public $arrears;

    public $type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area', 'arrears', 'type'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area' => 'Area',
            'arrears' => 'Arrears more than',
            'type' => 'Loan Type',
        ];
    }
}