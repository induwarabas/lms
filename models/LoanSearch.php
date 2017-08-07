<?php

namespace app\models;

use app\utils\NICValidator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LoanSearch represents the model behind the search form about `app\models\Loan`.
 *
 * @property integer $id
 * @property string $customer_id
 * @property integer $type
 * @property string $status
 */
class LoanSearch extends Model
{
    public $id;
    public $customer_id;
    public $type;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['customer_id', 'status'], 'string'],
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

        $this->load($params);
        $custid = null;
        if (isset($this->customer_id) && $this->customer_id != '') {
            $cust = Customer::find()->where("full_name like :fullname or (nic = :nic or nic = :oldnic)",
                [':fullname' => '%'.$this->customer_id.'%', ':nic' => NICValidator::getNewNic($this->customer_id), ':oldnic' => NICValidator::getOldNic($this->customer_id)])->one();
            $custid = ($cust != null) ? $cust->id : 0;
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $custid,
            'type' => $this->type,
            'status' => $this->status
        ]);

//        $query->andFilterWhere(['like', 'saving_account', $this->saving_account])
//            ->andFilterWhere(['like', 'loan_account', $this->loan_account])
//            ->andFilterWhere(['like', 'collection_method', $this->collection_method])
//            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
