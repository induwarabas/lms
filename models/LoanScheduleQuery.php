<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LoanSchedule]].
 *
 * @see LoanSchedule
 */
class LoanScheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LoanSchedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LoanSchedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
