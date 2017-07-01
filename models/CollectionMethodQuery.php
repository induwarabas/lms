<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CollectionMethod]].
 *
 * @see CollectionMethod
 */
class CollectionMethodQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CollectionMethod[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CollectionMethod|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
