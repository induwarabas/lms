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

    const names = [
        GeneralAccounts::PAYABLE => 'PAYABLE',
        GeneralAccounts::SAFE => 'SAFE',
        GeneralAccounts::INTEREST => 'INTEREST',
        GeneralAccounts::PENALTY => 'PENALTY',
        GeneralAccounts::PARK => 'PARK',
        GeneralAccounts::EXPENSES => 'EXPENSES',
        GeneralAccounts::INVESTMENT => 'INVESTMENT',
    ];
}