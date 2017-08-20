<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Collection;

/**
 * CollectionSearch represents the model behind the search form about `app\models\Collection`.
 */
class CollectionSearch extends Collection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['collector_id', 'loan_id', 'installments'], 'integer'],
            [['date'], 'safe'],
            [['status'], 'string'],
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
        $query = Collection::find();

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
            'collector_id' => $this->collector_id,
            'loan_id' => $this->loan_id,
            'date' => $this->date,
            'status' => $this->status,
            'installments' => $this->installments,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
