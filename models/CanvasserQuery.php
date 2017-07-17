<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Canvasser]].
 *
 * @see Canvasser
 */
class CanvasserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Canvasser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Canvasser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
