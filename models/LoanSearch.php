<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LoanSearch represents the model behind the search form about `app\models\Loan`.
 */
class LoanSearch extends Loan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'period', 'type'], 'integer'],
            [['saving_account', 'loan_account', 'collection_method', 'status', 'disbursed_date', 'closed_date'], 'safe'],
            [['amount'], 'number'],
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
        $query = Loan::find();

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

        if ($this->type == 0) {
            unset($this->type);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'period' => $this->period,
            'disbursed_date' => $this->disbursed_date,
            'closed_date' => $this->closed_date,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'saving_account', $this->saving_account])
            ->andFilterWhere(['like', 'loan_account', $this->loan_account])
            ->andFilterWhere(['like', 'collection_method', $this->collection_method])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
