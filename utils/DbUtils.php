<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/9/2017
 * Time: 2:21 PM
 */

namespace app\utils;


use app\models\Customer;

class DbUtils
{
    public static function getCustomerNameAndNicById($customerId)
    {
        if ($customerId == null) {
            return null;
        }

        $customer = Customer::findOne(['id' => $customerId]);
        if ($customer == null) {
            return null;
        }

        return $customer->name . " (" . $customer->nic . ")";
    }
}