<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/3/2017
 * Time: 11:24 PM
 */

namespace app\utils\enums;


class TxType
{
    const DISBURSE = "DISBURSE";
    const CHARGES = "CHARGES";
    const PAYMENT = "PAYMENT";
    const RECEIPT = "RECEIPT";
    const PENALTY = "PENALTY";
    const RECOVERY = "RECOVERY";
    const CAPITAL_RECOVERY = "CAPITAL";
    const INTEREST_RECOVERY = "INTEREST";
    const CHARGES_RECOVERY = "CHARGES";
}