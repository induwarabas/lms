<?php

namespace app\models;

use app\utils\NICValidator;
use app\utils\PhoneNoValidator;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $nic
 * @property string $full_name
 * @property string $name
 * @property string $gender
 * @property string $dob
 * @property string $area
 * @property string $residential_address
 * @property string $billing_address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $occupation
 * @property string $work_address
 * @property string $work_phone
 * @property string $work_email
 * @property string $fixed_salary
 * @property string $other_incomes
 * @property integer $spouse_id
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nic', 'full_name', 'name', 'gender', 'dob', 'area', 'residential_address', 'phone'], 'required'],
            [['dob'], 'safe'],
            [['nic'], NICValidator::class],
            [['residential_address', 'billing_address', 'work_address'], 'string'],
            [['fixed_salary', 'other_incomes'], 'number'],
            [['spouse_id', 'area'], 'integer'],
            [['nic', 'phone', 'mobile', 'work_phone'], 'string', 'max' => 12],
            [['phone', 'mobile', 'work_phone'], PhoneNoValidator::class],
            [['full_name'], 'string', 'max' => 256],
            [['name', 'email', 'occupation', 'work_email'], 'string', 'max' => 64],
            [['email', 'work_email'], EmailValidator::class],
            [['nic'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Client ID',
            'nic' => 'NIC number',
            'full_name' => 'Name in full',
            'name' => 'Name with initials',
            'gender' => 'Gender',
            'dob' => 'Date of birth',
            'area' => 'Area',
            'residential_address' => 'Residential Address',
            'billing_address' => 'Billing Address',
            'phone' => 'Phone',
            'mobile' => 'Mobile Phone',
            'email' => 'Email',
            'occupation' => 'Occupation',
            'work_address' => 'Work Address',
            'work_phone' => 'Work Phone',
            'work_email' => 'Work Email',
            'fixed_salary' => 'Fixed Salary',
            'other_incomes' => 'Other Incomes',
            'spouse_id' => 'Spouse',
        ];
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
