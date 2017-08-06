<?php

namespace app\models;

use app\utils\PhoneNoValidator;
use yii\validators\EmailValidator;

/**
 * This is the model class for table "canvasser".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $address
 * @property string $status
 * @property string $account
 */
class Canvasser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'canvasser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'status'], 'required'],
            [['address', 'status'], 'string'],
            [['bank'], 'integer'],
            [['name', 'bank_account_name'], 'string', 'max' => 128],
            [['phone', 'mobile'], 'string', 'max' => 16],
            [['account'], 'string', 'max' => 12],
            [['phone', 'mobile'], PhoneNoValidator::class],
            [['email'], 'string', 'max' => 64],
            [['email'], EmailValidator::class],
            [['bank_account'], 'string', 'max' => 20],

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
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'address' => 'Address',
            'status' => 'Status',
            'account' => 'Account No.',
            'bank' => 'Bank',
            'bank_account_name' => 'Bank Account Name',
            'bank_account' => 'Bank Account No.',
        ];
    }

    /**
     * @inheritdoc
     * @return CanvasserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CanvasserQuery(get_called_class());
    }
}
