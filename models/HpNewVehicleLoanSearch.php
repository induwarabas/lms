<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HpNewVehicleLoan;

/**
 * HpNewVehicleLoanSearch represents the model behind the search form about `app\models\HpNewVehicleLoan`.
 */
class HpNewVehicleLoanSearch extends HpNewVehicleLoan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vehicle_type', 'supplier', 'canvassed'], 'integer'],
            [['vehicle_no', 'engine_no', 'chasis_no', 'model', 'make'], 'safe'],
            [['price', 'loan_amount', 'sales_commision', 'canvassing_commision', 'insurance'], 'number'],
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
        $query = HpNewVehicleLoan::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'vehicle_type' => $this->vehicle_type,
            'supplier' => $this->supplier,
            'price' => $this->price,
            'loan_amount' => $this->loan_amount,
            'sales_commision' => $this->sales_commision,
            'canvassed' => $this->canvassed,
            'canvassing_commision' => $this->canvassing_commision,
            'insurance' => $this->insurance,
        ]);

        $query->andFilterWhere(['like', 'vehicle_no', $this->vehicle_no])
            ->andFilterWhere(['like', 'engine_no', $this->engine_no])
            ->andFilterWhere(['like', 'chasis_no', $this->chasis_no])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'make', $this->make]);

        return $dataProvider;
    }
}
