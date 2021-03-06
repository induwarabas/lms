<?php

namespace app\models;

use app\utils\NICValidator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LoanSearch represents the model behind the search form about `app\models\Loan`.
 *
 * @property string $id
 * @property string $customer_id
 * @property integer $type
 * @property string $status
 * @property string $payment_status
 */
class LoanSearch extends Model
{
    public $id;
    public $customer_id;
    public $type;
    public $status;
    public $payment_status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['id', 'customer_id', 'status', 'payment_status'], 'string'],
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
        $custid = [];
        if (isset($this->customer_id) && $this->customer_id != '') {
            $custs = Customer::find()->where("full_name like :fullname or (nic like :nic or nic like :oldnic)",
                [':fullname' => '%'.$this->customer_id.'%', ':nic' => NICValidator::getNewNic($this->customer_id)."%", ':oldnic' => NICValidator::getOldNic($this->customer_id)."%"])->all();
            foreach ($custs as $cust)
            $custid[] = ($cust != null) ? $cust->id : 0;
        }

        $loanId = [];
        if (isset($this->id) && $this->id != '') {
            $loanId[] = $this->id;
            if (strlen($this->id) > 4) {
                $idx = str_replace(' ', '', $this->id);
                $ids = HpNewVehicleLoan::find()->where('REPLACE(`vehicle_no`, \' \', \'\') LIKE :vid', [':vid' => '%' . $idx])->all();
                foreach ($ids as $id)
                    $loanId[] = $id;
            }
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
            'id' => $loanId,
            'customer_id' => $custid,
            'type' => $this->type,
            'status' => $this->status,
            'payment_status' => $this->payment_status
        ]);

//        $query->andFilterWhere(['like', 'saving_account', $this->saving_account])
//            ->andFilterWhere(['like', 'loan_account', $this->loan_account])
//            ->andFilterWhere(['like', 'collection_method', $this->collection_method])
//            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
