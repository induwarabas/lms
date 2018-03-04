<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MonthlyReport]].
 *
 * @see MonthlyReport
 */
class MonthlyReportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MonthlyReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MonthlyReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
