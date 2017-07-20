<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 7/20/2017
 * Time: 9:00 AM
 */

namespace app\utils;


class AccountDetails
{
    /**
     * @var \app\models\Account
     */
    public $account;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $nameUrl = null;

    /**
     * @var string
     */
    public $descriptionTitle;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $descriptionUrl = null;
}