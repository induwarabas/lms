<?php

namespace app\controllers;

use app\models\Customer;
use app\models\CustomerLoanSearch;
use app\models\CustomerSearchEx;
use app\models\Loan;
use app\models\LoanSearch;
use app\utils\NICValidator;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends LmsController
{
    /**
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearchEx();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $loans = Loan::find()->where(['customer_id' => $id])
//            ->orWhere(['guarantor_1' => $id])
//            ->orWhere(['guarantor_2' => $id])
//            ->orWhere(['guarantor_3' => $id]);
//        $dataProvider = new ActiveDataProvider([
//            'query' => $loans,
//        ]);

        $loanModel = new CustomerLoanSearch(['cust_id' => $id]);
        $dataProvider = $loanModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'loans' => $dataProvider,
            'loansSearchModel' => $loanModel,
            'loan_req' => Yii::$app->getSession()->get('loan-req')
        ]);
    }

    private function getNameWithInitials($fullname)
    {
        if ($fullname == '') {
            return '';
        }
        $parts = explode(' ', $fullname);
        $name = "";
        $count = count($parts);

        for ($i = 0; $i < $count - 1; $i++) {
            if ($parts[$i] != '') {
                $name .= substr($parts[$i], 0, 1) . ". ";
            }
        }
        $name .= $parts[$count - 1];
        return $name;
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $uuid = Yii::$app->request->get('uuid');
        if ($uuid == null || !Yii::$app->session->has($uuid)) {
            return $this->redirect(['createnic']);
        }

        $data = Yii::$app->session->get($uuid);
        $spouse = null;
        if (isset($data['spouse'])) {
            $spouse = Customer::findOne(['id' => $data['spouse']]);
        }
        if ($model->load(Yii::$app->request->post())) {
            $nicValidator = new NICValidator();
            $details = $nicValidator->getDetails($data['nic']);
            if ($details == null) {
                return $this->redirect(['createnic']);
            }
            $model->nic = $data['nic'];
            $model->dob = $details["dob"];
            $model->gender = $details["gender"];
            $model->full_name = ucwords($model->full_name);
            $model->name = $this->getNameWithInitials($model->full_name);

            if ($spouse !== null) {
                $model->spouse_id = $spouse->id;
            }
            if ($model->save()) {
                if ($spouse !== null) {
                    $spouse->spouse_id = $model->id;
                    $spouse->save();
                    return $this->redirect(['view', 'id' => $spouse->id]);
                } else {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'spouse' => $spouse
                ]);
            }
        } else {
            $model->nic = $data['nic'];
            $nicValidator = new NICValidator();
            $details = $nicValidator->getDetails($model->nic);
            if ($details == null) {
                return $this->redirect(['createnic']);
            }
            $model->dob = $details["dob"];
            $model->gender = $details["gender"];
            return $this->render('create', [
                'model' => $model,
                'spouse' => $spouse
            ]);

        }
    }

    public function actionRemovespouse($id)
    {
        $model = Customer::findOne(['id' => $id]);
        if ($model !== null) {
            $spouse = Customer::findOne(['id' => $model->spouse_id]);
            if ($spouse !== null) {
                $spouse->spouse_id = null;
                $spouse->save();
            }
            $model->spouse_id = null;
            $model->save();
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionCreatenic()
    {
        $model = new Customer();
        $model->load(Yii::$app->request->post());
        $spouse_id = Yii::$app->request->getQueryParam("spouse", null);

        if ($spouse_id !== null && isset($model['nic'])) {
            $customer = Customer::findOne(['nic' => $model['nic']]);
            $spouse = Customer::findOne(['id' => $spouse_id]);
            if ($customer !== null && $spouse !== null && $spouse->id !== $customer->id) {
                $customer->spouse_id = $spouse_id;
                $customer->save();
                $spouse->spouse_id = $customer->id;
                $spouse->save();
                return $this->redirect(['view', 'id' => $spouse_id]);
            }
        }

        if (isset($model['nic']) && $model->validate(['nic'])) {
            if (Customer::findOne(['nic' => NICValidator::getOldNic($model->nic)]) != null || Customer::findOne(['nic' => NICValidator::getNewNic($model->nic)]) != null) {
                $spouse = Customer::findOne(['id' => $spouse_id]);
                $model->addError('nic', 'NIC number "' . NICValidator::formatNicNo($model->nic) . '" has already been taken.');
                return $this->render('createnic', [
                    'model' => $model,
                    'spouse' => $spouse
                ]);
            }
            $uuid = uniqid();
            Yii::$app->session->set($uuid, ['nic' => $model->nic, 'spouse' => $spouse_id]);
            return $this->redirect(['create', 'uuid' => $uuid]);
        } else {
            $spouse = Customer::findOne(['id' => $spouse_id]);
            return $this->render('createnic', [
                'model' => $model,
                'spouse' => $spouse
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->full_name = ucwords($model->full_name);
            $model->name = $this->getNameWithInitials($model->full_name);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
