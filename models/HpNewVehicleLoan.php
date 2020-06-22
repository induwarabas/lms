<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hp_new_vehicle_loan".
 *
 * @property int $id Loan ID
 * @property int $vehicle_type Vehicle Type
 * @property string $vehicle_no Vehicle Number
 * @property string $engine_no Engine Number
 * @property string $chasis_no Chasis Number
 * @property string $model Model
 * @property int $make Make/Brand
 * @property int $supplier Supplier
 * @property string $down_payment Down Payment
 * @property string $price Selling Price
 * @property string $loan_amount Loan Amount
 * @property string $charges Charges
 * @property string $sales_commision_type Sales Commission Type
 * @property string $sales_commision Sales Commision
 * @property int $canvassed Canvassed By
 * @property string $canvassing_commision_type Canvassing Commission Type
 * @property string $canvassing_commision Canvassing Commision
 * @property string $insurance Insurance Premium
 * @property string $rmv_charges RMV Charges
 * @property string $rmv_sent_date RMV Sent Date
 * @property string $rmv_sent_agent RMV Sent Agent
 * @property string $rmv_sent_by RMV Sent By
 * @property string $rmv_recv_date RMV Received Date
 * @property string $rmv_recv_agent RMV Received Agent
 * @property string $rmv_recv_by RMV Received By
 * @property string $seize_panelty
 * @property int $seized
 */
class HpNewVehicleLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hp_new_vehicle_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vehicle_type', 'engine_no', 'chasis_no', 'model', 'make', 'price', 'loan_amount', 'sales_commision_type', 'canvassing_commision_type'], 'required'],
            [['id', 'vehicle_type', 'make', 'supplier', 'canvassed', 'seized'], 'integer'],
            [['down_payment', 'price', 'loan_amount', 'charges', 'sales_commision', 'canvassing_commision', 'insurance', 'rmv_charges', 'seize_panelty'], 'number'],
            [['sales_commision_type', 'canvassing_commision_type'], 'string'],
            [['rmv_sent_date', 'rmv_recv_date'], 'safe'],
            [['vehicle_no'], 'string', 'max' => 10],
            [['engine_no', 'chasis_no', 'model'], 'string', 'max' => 128],
            [['rmv_sent_agent', 'rmv_sent_by', 'rmv_recv_agent', 'rmv_recv_by'], 'string', 'max' => 64],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vehicle_type' => 'Vehicle Type',
            'vehicle_no' => 'Vehicle No',
            'engine_no' => 'Engine No',
            'chasis_no' => 'Chasis No',
            'model' => 'Model',
            'make' => 'Make',
            'supplier' => 'Supplier',
            'down_payment' => 'Down Payment',
            'price' => 'Price',
            'loan_amount' => 'Loan Amount',
            'charges' => 'Charges',
            'sales_commision_type' => 'Sales Commision Type',
            'sales_commision' => 'Sales Commision',
            'canvassed' => 'Canvassed',
            'canvassing_commision_type' => 'Canvassing Commision Type',
            'canvassing_commision' => 'Canvassing Commision',
            'insurance' => 'Insurance',
            'rmv_charges' => 'Rmv Charges',
            'rmv_sent_date' => 'Rmv Sent Date',
            'rmv_sent_agent' => 'Rmv Sent Agent',
            'rmv_sent_by' => 'Rmv Sent By',
            'rmv_recv_date' => 'Rmv Recv Date',
            'rmv_recv_agent' => 'Rmv Recv Agent',
            'rmv_recv_by' => 'Rmv Recv By',
            'seize_panelty' => 'Seize Panelty',
            'seized' => 'Seized',
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

    /**
     * Gets the sales commission
     * @return number the active query used by this AR class.
     */
    public function getSalesCommission()
    {
        if (isset($this->supplier) && $this->supplier != 0 && isset($this->sales_commision) && $this->sales_commision > 0.0) {
            if ($this->sales_commision_type == 'Percentage') {
                return round($this->loan_amount * $this->sales_commision / 100, 2);
            }
            return $this->sales_commision;
        }
        return 0.0;
    }

    /**
     * Gets the canvassing commission
     * @return number the active query used by this AR class.
     */
    public function getCanvassingCommission()
    {
        if (isset($this->canvassed) && $this->canvassed != 0 && isset($this->canvassing_commision) && $this->canvassing_commision > 0.0) {
            if ($this->canvassing_commision_type == 'Percentage') {
                return round($this->loan_amount * $this->canvassing_commision / 100, 2);
            }
            return $this->canvassing_commision;
        }
        return 0.0;
    }
}
