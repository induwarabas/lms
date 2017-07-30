<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[BankAccount]].
 *
 * @see BankAccount
 */
class BankAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BankAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BankAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
