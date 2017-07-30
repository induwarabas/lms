<?php

namespace app\controllers;

use app\models\DisburseModel;
use app\models\Loan;
use app\models\LoanSchedule;
use app\models\LoanSearch;
use app\utils\enums\LoanTypes;
use app\utils\loan\AmortizationCalculator;
use app\utils\loan\LoanDisbursement;
use app\utils\loan\LoanRecovery;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;

/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends LmsController
{
    /**
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = array(
            'pageSize' => 10,
        );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Loan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $loan = $this->findModel($id);
        if (LoanTypes::isVehicleLoan($loan->type)) {
            return $this->redirect(['hp-new-vehicle-loan/view', 'id' => $id, 'error' => Yii::$app->request->getQueryParam("error")]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'error' => Yii::$app->request->getQueryParam("error")
        ]);
    }

    /**
     * Creates a new Loan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::$app->getSession()->get("loan");
        if ($model == null) {
            $model = new Loan();
            $model->collection_method = 1;

            if (!$model->load(Yii::$app->request->post()) || !isset($model->type)) {
                return $this->render('create', [
                    'model' => $model
                ]);
            }
        }

        if (LoanTypes::isVehicleLoan($model->type)) {
            return $this->redirect(["hp-new-vehicle-loan/create", 'type' => $model->type]);
        } else {
            Yii::$app->getSession()->remove('loan');
            return $this->render('create', [
                'model' => $model
            ]);
        }


//        $tx = Yii::$app->getDb()->beginTransaction();
//        $loanCreator = new LoanCreator;
//        $created = $loanCreator->createLoan($model->customer_id,
//            $model->type,
//            $model->amount,
//            $model->interest,
//            $model->penalty,
//            $model->charges,
//            $model->collection_method,
//            $model->period);
//        if ($created) {
//            $tx->commit();
//            return $this->redirect(['view', 'id' => $loanCreator->getLoanId()]);
//        } else {
//            $tx->rollBack();
//            return $this->render('create', [
//                'model' => $model
//            ]);
//        }
    }

    public function actionCustomer($id, $type)
    {
        Yii::$app->getSession()->remove("loan-req");
        $model = Yii::$app->getSession()->get("loan");
        if ($model == null) {
            return $this->redirect(["loan/index"]);
        }
        if ($type == "Applicant") {
            $model->customer_id = $id;
        } else if ($type == "Guarantor 1") {
            $model->guarantor_1 = $id;
        } else if ($type == "Guarantor 2") {
            if ($model->guarantor_1 == null) {
                $model->guarantor_1 = $id;
            } else {
                $model->guarantor_2 = $id;
            }
        } else if ($type == "Guarantor 3") {
            if ($model->guarantor_1 == null) {
                $model->guarantor_1 = $id;
            } else if ($model->guarantor_2 == null) {
                $model->guarantor_2 = $id;
            } else {
                $model->guarantor_3 = $id;
            }
        }
        Yii::$app->getSession()->set("loan", $model);
        if (LoanTypes::isVehicleLoan($model->type)) {
            if (isset($model->id) && $model->id > 0) {
                return $this->redirect(["hp-new-vehicle-loan/update", 'id' => $model->id]);
            }
            return $this->redirect(["hp-new-vehicle-loan/create", 'type' => $model->type]);
        } else {
            Yii::$app->getSession()->remove('loan');
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionRemoveCustomer($type)
    {
        Yii::$app->getSession()->remove("loan-req");
        $model = Yii::$app->getSession()->get("loan");
        if ($model == null) {
            return $this->redirect(["loan/index"]);
        }
        if ($type == "Applicant") {
            $model->customer_id = null;
        } else if ($type == "Guarantor 1") {
            $model->guarantor_1 = $model->guarantor_2;
            $model->guarantor_2 = $model->guarantor_3;
            $model->guarantor_3 = null;
        } else if ($type == "Guarantor 2") {
            $model->guarantor_2 = $model->guarantor_3;
            $model->guarantor_3 = null;
        } else if ($type == "Guarantor 3") {
            $model->guarantor_3 = null;
        }
        if (LoanTypes::isVehicleLoan($model->type)) {
            return $this->redirect(["hp-new-vehicle-loan/create", 'type' => $model->type]);
        } else {
            Yii::$app->getSession()->remove('loan');
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionCancel()
    {
        Yii::$app->getSession()->remove("loan-req");
        Yii::$app->getSession()->remove("loan");
        Yii::$app->getSession()->remove("loanex");
        return $this->redirect(["loan/index"]);
    }

    /**
     * Updates an existing Loan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionSchedulex($amount, $interest, $terms, $charges)
    {
        $calc = new AmortizationCalculator();

        $schedule = $calc->calculate($amount, $interest, $terms, 12, $charges);

        return $this->render('schedulex', [
            'schedule' => $schedule,
        ]);
    }

    public function actionSchedule($id)
    {
        $query = LoanSchedule::find()->andFilterWhere(['loan_id' => $id])->orderBy('installment_id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->pagination = array(
            'pageSize' => 0,
        );
        return $this->render('schedule', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreatex()
    {
        Yii::$app->getSession()->remove("loan");
        Yii::$app->getSession()->remove("loanex");
        return $this->redirect(["create"]);
    }

    public function actionDisburse()
    {
        $model = new DisburseModel();
        if ($model->load(Yii::$app->request->post())) {
            $tx = Yii::$app->getDb()->beginTransaction();
            $disbursement = new LoanDisbursement();
            if ($disbursement->disburse($model->loan, $model->date)) {
                $tx->commit();
            } else {
                $tx->rollBack();
            }
            $this->redirect(['view', 'id' => $model->loan, 'error'=>$disbursement->error]);
        }else {
            $this->redirect(['view', 'id' => $model->loan, 'error'=>'Invalid request']);
        }

    }

    public function actionRecover($id)
    {
        $date = Yii::$app->request->getQueryParam('date',null);
        if ($date == null) {
            $date = date('Y-m-d');
        }
        $disbursement = new LoanRecovery();
        if ($disbursement->recover($id, $date)) {
            return $this->redirect(["view", 'id' => $id]);
        }else{
            echo $disbursement->error;
        }
    }

    /**
     * Finds the Loan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
