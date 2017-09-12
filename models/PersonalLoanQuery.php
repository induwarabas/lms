<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PersonalLoan]].
 *
 * @see PersonalLoan
 */
class PersonalLoanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PersonalLoan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PersonalLoan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
