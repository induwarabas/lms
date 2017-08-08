<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 11:24 PM
 */

namespace app\utils\enums;


class PaymentType
{
    const CASH = "CASH";
    const CHEQUE = "CHEQUE";
    const TRANSFER = "TRANSFER";
    const INTERNAL = "INTERNAL";

    public static function needReference($type)
    {
        return $type == PaymentType::CHEQUE || $type == PaymentType::TRANSFER;
    }

    public static function getTellerItems()
    {
        return [
            PaymentType::CASH => PaymentType::CASH,
            PaymentType::CHEQUE => PaymentType::CHEQUE
        ];
    }

    public static function getItems()
    {
        return [
            PaymentType::CASH => PaymentType::CASH,
            PaymentType::CHEQUE => PaymentType::CHEQUE,
            PaymentType::TRANSFER => PaymentType::TRANSFER,
        ];
    }
}