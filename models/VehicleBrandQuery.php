<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VehicleBrand]].
 *
 * @see VehicleBrand
 */
class VehicleBrandQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VehicleBrand[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VehicleBrand|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
