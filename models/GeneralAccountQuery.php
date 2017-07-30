<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GeneralAccount]].
 *
 * @see GeneralAccount
 */
class GeneralAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GeneralAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GeneralAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
