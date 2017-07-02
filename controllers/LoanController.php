<?php

namespace app\controllers;

use app\models\Loan;
use app\models\LoanSearch;
use app\utils\loan\AmortizationCalculator;
use app\utils\loan\LoanCreator;
use app\utils\loan\LoanDisbursement;
use app\utils\loan\LoanRecovery;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * LoanController implements the CRUD actions for Loan model.
 */
class LoanController extends LmsController
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
     * Lists all Loan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LoanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        return $this->render('view', [
            'model' => $this->findModel($id),
            'error' => null
        ]);
    }

    /**
     * Creates a new Loan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Loan();
        $model->collection_method = 1;
        if (!$model->load(Yii::$app->request->post())) {
            return $this->render('create', [
                'model' => $model
            ]);
        }

        $tx = Yii::$app->getDb()->beginTransaction();
        $loanCreator = new LoanCreator;
        $created = $loanCreator->createLoan($model->customer_id,
            $model->type,
            $model->amount,
            $model->interest,
            $model->penalty,
            $model->charges,
            $model->collection_method,
            $model->period);
        if ($created) {
            $tx->commit();
            return $this->redirect(['view', 'id' => $loanCreator->getLoanId()]);
        } else {
            $tx->rollBack();
            return $this->render('create', [
                'model' => $model
            ]);
        }
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

    public function actionSchedule($amount, $interest, $terms, $charges)
    {
        $calc = new AmortizationCalculator();

        $schedule = $calc->calculate($amount, $interest, $terms, 12, $charges);

        return $this->render('schedule', [
            'schedule' => $schedule,
        ]);
    }

    public function actionDisburse($id)
    {
        $disbursement = new LoanDisbursement();
        $disbursement->disburse($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'error' => $disbursement->error
        ]);
    }

    public function actionRecover($id,$date)
    {
        $disbursement = new LoanRecovery();
        $disbursement->recover($id, $date);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'error' => $disbursement->error
        ]);
    }
    /**
     * Deletes an existing Loan model.
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
