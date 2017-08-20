<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Collector]].
 *
 * @see Collector
 */
class CollectorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Collector[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Collector|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
