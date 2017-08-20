<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Collector;

/**
 * CollectorSearch represents the model behind the search form about `app\models\Collector`.
 */
class CollectorSearch extends Collector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bank'], 'integer'],
            [['name', 'phone', 'mobile', 'email', 'address', 'status', 'account', 'bank_account_name', 'bank_account'], 'safe'],
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
        $query = Collector::find();

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
            'bank' => $this->bank,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'bank_account_name', $this->bank_account_name])
            ->andFilterWhere(['like', 'bank_account', $this->bank_account]);

        return $dataProvider;
    }
}
