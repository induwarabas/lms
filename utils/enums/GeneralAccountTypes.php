<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 8/7/2017
 * Time: 3:37 PM
 */

namespace app\utils\enums;


use app\models\Account;

class GeneralAccountTypes
{
    const NON_CURRENT_ASSET = "NON_CURRENT_ASSET";
    const CURRENT_ASSET = "CURRENT_ASSET";
    const NON_CURRENT_LIABILITY = "NON_CURRENT_LIABILITY";
    const CURRENT_LIABILITY = "CURRENT_LIABILITY";
    const CAPITAL = "CAPITAL";
    const INCOME = "INCOME";
    const EXPENDITURE = "EXPENDITURE";

    public static function getAll() {
        return [
            GeneralAccountTypes::NON_CURRENT_ASSET => GeneralAccountTypes::NON_CURRENT_ASSET,
            GeneralAccountTypes::CURRENT_ASSET => GeneralAccountTypes::CURRENT_ASSET,
            GeneralAccountTypes::NON_CURRENT_LIABILITY => GeneralAccountTypes::NON_CURRENT_LIABILITY,
            GeneralAccountTypes::CURRENT_LIABILITY => GeneralAccountTypes::CURRENT_LIABILITY,
            GeneralAccountTypes::CAPITAL => GeneralAccountTypes::CAPITAL,
            GeneralAccountTypes::INCOME => GeneralAccountTypes::INCOME,
            GeneralAccountTypes::EXPENDITURE => GeneralAccountTypes::EXPENDITURE,
        ];
    }

    public static function getProtection($type) {
        switch ($type) {
            case GeneralAccountTypes::NON_CURRENT_ASSET:
                return Account::PROTECTION_MINUS;
            case GeneralAccountTypes::CURRENT_ASSET:
                return Account::PROTECTION_MINUS;
            case GeneralAccountTypes::NON_CURRENT_LIABILITY:
                return Account::PROTECTION_PLUS;
            case GeneralAccountTypes::CURRENT_LIABILITY:
                return Account::PROTECTION_PLUS;
            case GeneralAccountTypes::CAPITAL:
                return Account::PROTECTION_PLUS;
            case GeneralAccountTypes::INCOME:
                return Account::PROTECTION_PLUS;
            case GeneralAccountTypes::EXPENDITURE:
                return Account::PROTECTION_MINUS;
            default:
                return Account::PROTECTION_NONE;
        }
    }
}