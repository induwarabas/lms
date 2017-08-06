<?php

namespace app\models;

use app\utils\NICValidator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'spouse_id', 'area'], 'integer'],
            [['nic', 'full_name', 'name', 'dob', 'residential_address', 'billing_address', 'phone', 'mobile', 'email', 'occupation', 'work_address', 'work_phone', 'work_email'], 'safe'],
            [['fixed_salary', 'other_incomes'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Customer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $area = $this->area;
        if ($area == 0) {
            $area = null;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dob' => $this->dob,
            'fixed_salary' => $this->fixed_salary,
            'other_incomes' => $this->other_incomes,
            'spouse_id' => $this->spouse_id,
            'area' => $area,
        ]);

        if (isset($this->nic) && $this->nic != '') {
            $query->andWhere("(nic = '" . NICValidator::getOldNic($this->nic) . "' OR nic = '" . NICValidator::getNewNic($this->nic) . "')");
        }

        if (isset($this->phone) && $this->phone != '') {
            $phone = str_replace(' ', '', $this->phone);
            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);
            if ($phone != '') {
                if (substr($phone, 0, 1) == "0") {
                    $phone = substr($phone, 1);
                }
            }
            $query->andWhere("phone like '%" . $phone . "%'");
        }

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'residential_address', $this->residential_address])
            ->andFilterWhere(['like', 'billing_address', $this->billing_address])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'occupation', $this->occupation])
            ->andFilterWhere(['like', 'work_address', $this->work_address])
            ->andFilterWhere(['like', 'work_phone', $this->work_phone])
            ->andFilterWhere(['like', 'work_email', $this->work_email]);

        return $dataProvider;
    }
}
