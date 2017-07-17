<?php

namespace app\models;

use app\utils\PhoneNoValidator;
use Yii;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $name
 * @property string $account
 * @property string $status
 * @property string $contact
 * @property string $address
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property integer $bank
 * @property string $bank_account
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'address', 'phone'], 'required'],
            [['status', 'address'], 'string'],
            [['bank'], 'integer'],
            [['name', 'contact'], 'string', 'max' => 128],
            [['account'], 'string', 'max' => 12],
            [['phone', 'mobile'], 'string', 'max' => 16],
            [['email'], 'string', 'max' => 64],
            [['email'], EmailValidator::class],
            [['bank_account'], 'string', 'max' => 20],
            [['phone', 'mobile'], PhoneNoValidator::class],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'account' => 'Account',
            'status' => 'Status',
            'contact' => 'Contact Person',
            'address' => 'Address',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'bank' => 'Bank',
            'bank_account' => 'Bank Account',
        ];
    }

    /**
     * @inheritdoc
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }
}
