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
    const EXPENSE = "EXPENSE";
    const MANUAL = "MANUAL";

    public static function items() {
        return [
            TxType::DISBURSE => TxType::DISBURSE,
            TxType::CHARGES => TxType::CHARGES,
            TxType::PAYMENT => TxType::PAYMENT,
            TxType::RECEIPT => TxType::RECEIPT,
            TxType::PENALTY => TxType::PENALTY,
            TxType::RECOVERY => TxType::RECOVERY,
            TxType::CAPITAL_RECOVERY => TxType::CAPITAL_RECOVERY,
            TxType::INTEREST_RECOVERY => TxType::INTEREST_RECOVERY,
            TxType::CHARGES_RECOVERY => TxType::CHARGES_RECOVERY,
            TxType::EXPENSE => TxType::EXPENSE,
            TxType::MANUAL => TxType::MANUAL,
        ];
    }
}