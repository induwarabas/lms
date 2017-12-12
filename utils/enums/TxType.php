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
    const DOWN_PAYMENT = "DOWN_PAY";
    const PENALTY = "PENALTY";
    const RECOVERY = "RECOVERY";
    const CAPITAL_RECOVERY = "CAPITAL";
    const INTEREST_RECOVERY = "INTEREST";
    const CHARGES_RECOVERY = "CHARGES";
    const EXPENSE = "EXPENSE";
    const MANUAL = "MANUAL";
    const INVESTMENT = "INVESTMENT";
    const INTERNAL = "INTERNAL";
    const BANK = "BANK";
    const REVERT = "REVERT";
    const CLOSE_ACCOUNT = "CLOSE_ACC";
    const SETTLEMENT = "SETTLEMENT";

    public static function items() {
        return [
            TxType::DISBURSE => TxType::DISBURSE,
            TxType::CHARGES => TxType::CHARGES,
            TxType::PAYMENT => TxType::PAYMENT,
            TxType::RECEIPT => TxType::RECEIPT,
            TxType::PENALTY => TxType::PENALTY,
            TxType::DOWN_PAYMENT => TxType::DOWN_PAYMENT,
            TxType::RECOVERY => TxType::RECOVERY,
            TxType::CAPITAL_RECOVERY => TxType::CAPITAL_RECOVERY,
            TxType::INTEREST_RECOVERY => TxType::INTEREST_RECOVERY,
            TxType::CHARGES_RECOVERY => TxType::CHARGES_RECOVERY,
            TxType::EXPENSE => TxType::EXPENSE,
            TxType::MANUAL => TxType::MANUAL,
            TxType::INVESTMENT => TxType::INVESTMENT,
            TxType::INTERNAL => TxType::INTERNAL,
            TxType::BANK => TxType::BANK,
            TxType::REVERT => TxType::REVERT,
            TxType::CLOSE_ACCOUNT => TxType::CLOSE_ACCOUNT,
        ];
    }
}