<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Collection]].
 *
 * @see Collection
 */
class CollectionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Collection[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Collection|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
