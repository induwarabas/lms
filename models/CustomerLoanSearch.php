<?php

namespace app\models;

use app\utils\NICValidator;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LoanSearch represents the model behind the search form about `app\models\Loan`.
 *
 * @property string $id
 * @property string $guarantor_1
 * @property integer $type
 * @property string $status
 * @property string $payment_status
 */
class CustomerLoanSearch extends Model
{
    public $cust_id;
    public $id;
    public $customer_id;
    public $guarantor_1;
    public $type;
    public $status;
    public $payment_status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'cust_id'], 'integer'],
            [['id', 'status', 'payment_status', 'guarantor_1', 'customer_id'], 'string'],
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
        $this->load($params);
        if ($this->guarantor_1 == 'CUSTOMER') {
            $loans = Loan::find()->where(['customer_id' => $this->cust_id]);
        } else if ($this->guarantor_1 == 'GUARANTOR') {
            $loans = Loan::find()->where(['guarantor_1' => $this->cust_id])
                ->orWhere(['guarantor_2' => $this->cust_id])
                ->orWhere(['guarantor_3' => $this->cust_id]);
        } else {
            $loans = Loan::find()->where(['customer_id' => $this->cust_id])
                ->orWhere(['guarantor_1' => $this->cust_id])
                ->orWhere(['guarantor_2' => $this->cust_id])
                ->orWhere(['guarantor_3' => $this->cust_id]);
        }

        $custid = [];
        if (isset($this->customer_id) && $this->customer_id != '') {
            $custs = Customer::find()->where("full_name like :fullname or (nic like :nic or nic like :oldnic)",
                [':fullname' => '%'.$this->customer_id.'%', ':nic' => NICValidator::getNewNic($this->customer_id)."%", ':oldnic' => NICValidator::getOldNic($this->customer_id)."%"])->all();
            foreach ($custs as $cust)
                $custid[] = ($cust != null) ? $cust->id : 0;
        }

        $loans->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $custid,
            'type' => $this->type,
            'status' => $this->status,
            'payment_status' => $this->payment_status
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $loans,
        ]);


//        $query = Loan::find();
//
//        $this->load($params);
//        $custid = [];
//        if (isset($this->customer_id) && $this->customer_id != '') {
//            $custs = Customer::find()->where("full_name like :fullname or (nic like :nic or nic like :oldnic)",
//                [':fullname' => '%'.$this->customer_id.'%', ':nic' => NICValidator::getNewNic($this->customer_id)."%", ':oldnic' => NICValidator::getOldNic($this->customer_id)."%"])->all();
//            foreach ($custs as $cust)
//            $custid[] = ($cust != null) ? $cust->id : 0;
//        }
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//

        return $dataProvider;
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'customer_id' => $custid,
//            'type' => $this->type,
//            'status' => $this->status,
//            'payment_status' => $this->payment_status
//        ]);
//
////        $query->andFilterWhere(['like', 'saving_account', $this->saving_account])
////            ->andFilterWhere(['like', 'loan_account', $this->loan_account])
////            ->andFilterWhere(['like', 'collection_method', $this->collection_method])
////            ->andFilterWhere(['like', 'status', $this->status]);
//
//        return $dataProvider;
    }
}
