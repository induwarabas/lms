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
 * SeizeSearch.
 *
 * @property integer $area
 * @property integer $arrears
 * @property integer $type
 * @property integer $seize_panelty
 */

class SeizeSearch extends Model
{
    public $area;

    public $arrears;

    public $seize_panelty;

    public $type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area', 'arrears', 'seize_panelty', 'type'], 'number', 'min' => 0],
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
            'seize_panelty'=> 'seize_panelty',
            'type' => 'Loan Type',
        ];
    }
}