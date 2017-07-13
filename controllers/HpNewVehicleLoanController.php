<?php

namespace app\controllers;

use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\HpNewVehicleLoanEx;
use app\models\HpNewVehicleLoanSearch;
use app\models\Loan;
use app\utils\enums\LoanTypes;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * HpNewVehicleLoanController implements the CRUD actions for HpNewVehicleLoan model.
 */
class HpNewVehicleLoanController extends LmsController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HpNewVehicleLoan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HpNewVehicleLoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HpNewVehicleLoan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $loan = Loan::findOne(['id' => $model->id]);
        $applicant = Customer::findOne(['id' => $loan->customer_id]);
        $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
        $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
        $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'loan' => $loan,
            'applicant' => $applicant,
            'guarantor1' => $guarantor1,
            'guarantor2' => $guarantor2,
            'guarantor3' => $guarantor3,
        ]);
    }

    /**
     * Creates a new HpNewVehicleLoan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::$app->getSession()->get("loanex");
        if ($model == null) {
            $model = new HpNewVehicleLoan();
        }

        $loan = Yii::$app->getSession()->get("loan");
        if ($loan == null) {
            $loan = new Loan();
            $loan->type = LoanTypes::HP_NEW_VEHICLE;
        } else if (isset($loan->id)) {
            $this->redirect(["update", 'id' => $loan->id]);
        }
        $model->id = 0;
        $loan->amount = $model->loan_amount;
        $loan->charges = $model->sales_commision + $model->canvassing_commision;
        $loan->penalty = 0.0;

        if ($model->load(Yii::$app->request->post()) && $loan->load(Yii::$app->request->post()) && $model->validate() && $loan->validate()) {
            $tx = Yii::$app->getDb()->beginTransaction();
            $loan->save();
            $model->id = $loan->primaryKey;
            $model->save();
            $tx->commit();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $applicant = null;
            if (isset($loan->customer_id)) {
                $applicant = Customer::findOne(['id' => $loan->customer_id]);
            }
            $guarantor1 = null;
            if (isset($loan->guarantor_1)) {
                $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
            }
            $guarantor2 = null;
            if (isset($loan->guarantor_2)) {
                $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
            }
            $guarantor3 = null;
            if (isset($loan->guarantor_3)) {
                $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);
            }
            return $this->render('create', [
                'model' => $model,
                'loan' => $loan,
                'applicant' => $applicant,
                'guarantor1' => $guarantor1,
                'guarantor2' => $guarantor2,
                'guarantor3' => $guarantor3,
            ]);
        }
    }

    public function actionSetCustomer($id, $type)
    {
        $loan = new Loan();
        if ($id != 0) {
            $loan = Loan::findOne(['id' => $id]);
        }
        $loan->load(Yii::$app->request->post());
        Yii::$app->getSession()->set('loan', $loan);

        $loanex = new HpNewVehicleLoan();
        if ($id != 0) {
            $loanex = HpNewVehicleLoan::findOne(['id' => $id]);
        }
        $loanex->load(Yii::$app->request->post());
        Yii::$app->getSession()->set('loanex', $loanex);

        Yii::$app->getSession()->set('loan-req', $type);

        $this->redirect(["customer/index"]);
    }

    /**
     * Updates an existing HpNewVehicleLoan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $loan = Yii::$app->getSession()->get("loan");
        if ($loan->id != $id) {
            $loan = Loan::findOne(['id' => $id]);
        }

        $loan->amount = $model->loan_amount;
        $loan->charges = $model->sales_commision + $model->canvassing_commision;
        $loan->penalty = 0.0;

        if ($model->load(Yii::$app->request->post()) && $loan->load(Yii::$app->request->post()) && $model->validate() && $loan->validate()) {
            $tx = Yii::$app->getDb()->beginTransaction();
            $loan->save();
            $model->id = $loan->primaryKey;
            $model->save();
            $tx->commit();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $applicant = null;
            if (isset($loan->customer_id)) {
                $applicant = Customer::findOne(['id' => $loan->customer_id]);
            }
            $guarantor1 = null;
            if (isset($loan->guarantor_1)) {
                $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
            }
            $guarantor2 = null;
            if (isset($loan->guarantor_2)) {
                $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
            }
            $guarantor3 = null;
            if (isset($loan->guarantor_3)) {
                $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);
            }
            return $this->render('update', [
                'model' => $model,
                'loan' => $loan,
                'applicant' => $applicant,
                'guarantor1' => $guarantor1,
                'guarantor2' => $guarantor2,
                'guarantor3' => $guarantor3,
            ]);
        }
    }

    /**
     * Deletes an existing HpNewVehicleLoan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HpNewVehicleLoan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HpNewVehicleLoan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HpNewVehicleLoan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
