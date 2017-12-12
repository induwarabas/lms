<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/2/2017
 * Time: 5:49 PM
 */

namespace app\utils;


class GeneralAccounts
{
    const PAYABLE = '9000000001';
    const SAFE = '9000000002';
    const INTEREST = '9000000003';
    const PENALTY = '9000000004';
    const PARK = '9000000005';
    const EXPENSES = '9000000006';
    const INVESTMENT = '9000000007';
    const SALARY = '9000000008';
    const CHARGES = '9000000009';
    const RMV_CHARGES = '9000000010';
    const CLOSE_BALANCE = '9000000011';
    const PRINCIPAL_LOSS = '9000000012';

    const names = [
        GeneralAccounts::PAYABLE => 'PAYABLE',
        GeneralAccounts::SAFE => 'SAFE',
        GeneralAccounts::INTEREST => 'INTEREST',
        GeneralAccounts::PENALTY => 'PENALTY',
        GeneralAccounts::PARK => 'PARK',
        GeneralAccounts::EXPENSES => 'EXPENSES',
        GeneralAccounts::INVESTMENT => 'INVESTMENT',
        GeneralAccounts::SALARY => 'SALARY',
        GeneralAccounts::CHARGES => 'CHARGES',
        GeneralAccounts::RMV_CHARGES => 'RMV_CHARGES',
        GeneralAccounts::CLOSE_BALANCE => 'CLOSE_BALANCE',
        GeneralAccounts::PRINCIPAL_LOSS => 'PRINCIPAL_LOSS',
    ];
}