<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hp_new_vehicle_loan".
 *
 * @property integer $id
 * @property integer $vehicle_type
 * @property string $vehicle_no
 * @property string $engine_no
 * @property string $chasis_no
 * @property string $model
 * @property integer $make
 * @property integer $supplier
 * @property string $price
 * @property string $loan_amount
 * @property string $sales_commision
 * @property integer $canvassed
 * @property string $canvassing_commision
 * @property string $insurance
 */
class HpNewVehicleLoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hp_new_vehicle_loan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vehicle_type', 'engine_no', 'chasis_no', 'model', 'make'], 'required'],
            [['id', 'vehicle_type', 'supplier', 'canvassed', 'make'], 'integer'],
            [['price', 'loan_amount', 'sales_commision', 'canvassing_commision', 'insurance'], 'number'],
            [['vehicle_no'], 'string', 'max' => 10],
            [['engine_no', 'chasis_no', 'model'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Loan ID',
            'vehicle_type' => 'Vehicle Type',
            'vehicle_no' => 'Vehicle Number',
            'engine_no' => 'Engine Number',
            'chasis_no' => 'Chasis Number',
            'model' => 'Model',
            'make' => 'Make/Brand',
            'supplier' => 'Supplier',
            'price' => 'Selling Price',
            'loan_amount' => 'Loan Amount',
            'sales_commision' => 'Sales Commision',
            'canvassed' => 'Canvassed By',
            'canvassing_commision' => 'Canvassing Commision',
            'insurance' => 'Insurance Premium',
        ];
    }

    /**
     * @inheritdoc
     * @return HpNewVehicleLoanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HpNewVehicleLoanQuery(get_called_class());
    }
}
