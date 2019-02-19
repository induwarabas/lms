<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Receipt]].
 *
 * @see Receipt
 */
class ReceiptQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Receipt[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Receipt|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
