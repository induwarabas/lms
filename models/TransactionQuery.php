<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Transaction]].
 *
 * @see Transaction
 */
class TransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Transaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Transaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
