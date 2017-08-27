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
 * @property string $from
 * @property string $to
 * @property string $teller
 * @property integer $type
 */

class ReceiptSearch extends Model
{
    public $area;

    public $from;
    public $to;

    public $type;

    public $teller;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to', 'teller'], 'string'],
            [['area', 'type'], 'number', 'min' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area' => 'Area',
            'from' => 'Date',
            'to' => 'To',
            'type' => 'Loan Type',
            'teller' => 'Teller',
        ];
    }
}