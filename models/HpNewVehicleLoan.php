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
 * @property number $price
 * @property number $loan_amount
 * @property number $sales_commision
 * @property integer $canvassed
 * @property number $canvassing_commision
 * @property number $insurance
 * @property string $rmv_sent_date
 * @property string $rmv_sent_agent
 * @property string $rmv_sent_by
 * @property string $rmv_recv_date
 * @property string $rmv_recv_agent
 * @property string $rmv_recv_by
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
            [['id', 'vehicle_type', 'engine_no', 'chasis_no', 'model', 'make', 'price', 'loan_amount', 'insurance'], 'required'],
            [['id', 'vehicle_type', 'supplier', 'canvassed', 'make'], 'integer'],
            [['price', 'loan_amount', 'sales_commision', 'canvassing_commision', 'insurance'], 'number'],
            [['vehicle_no', 'rmv_sent_date', 'rmv_recv_date'], 'string', 'max' => 10],
            [['engine_no', 'chasis_no', 'model'], 'string', 'max' => 128],
            [['rmv_sent_agent', 'rmv_sent_by', 'rmv_recv_agent', 'rmv_recv_by'], 'string', 'max' => 64],
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
            'sales_commision' => 'Sales Commission',
            'canvassed' => 'Canvassed By',
            'canvassing_commision' => 'Canvassing Commission',
            'insurance' => 'Insurance Premium',
            'rmv_sent_date' => 'RMV Sent Date',
            'rmv_sent_agent' => 'RMV Sent Agent',
            'rmv_sent_by' => 'RMV Sent By',
            'rmv_recv_date' => 'RMV Received Date',
            'rmv_recv_agent' => 'RMV Received Agent',
            'rmv_recv_by' => 'RMV Received By',
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
