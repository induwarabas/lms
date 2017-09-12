<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Loan;
use app\models\PersonalLoan;
use app\utils\enums\LoanTypes;
use app\utils\loan\AmortizationCalculator;
use app\utils\loan\LoanCreator;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * PersonalLoanController implements the CRUD actions for PersonalLoan model.
 */
class PersonalLoanController extends LmsController
{
    /**
     * Lists all PersonalLoan models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['loan/index']);
    }

    /**
     * Displays a single PersonalLoan model.
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

        $interestTerms = 12;
        if ($loan->collection_method === 2) //Weekly
        {
            $interestTerms = 52;
        } else if ($loan->collection_method == 3) //Daily
        {
            $interestTerms = 365;
        }

        $amort = new AmortizationCalculator();
        $installment = $amort->calculateInstallment($loan->amount, $loan->interest, $loan->period, $interestTerms);
        $loan->installment = $installment;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'loan' => $loan,
            'applicant' => $applicant,
            'guarantor1' => $guarantor1,
            'guarantor2' => $guarantor2,
            'guarantor3' => $guarantor3,
            'error' => Yii::$app->request->getQueryParam("error")
        ]);
    }

    /**
     * Creates a new PersonalLoan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::$app->getSession()->get("loanex");
        if ($model == null) {
            $model = new PersonalLoan();
        }

        $loan = Yii::$app->getSession()->get("loan");
        if ($loan == null) {
            $loan = new Loan();
            $loan->type = LoanTypes::PERSONAL;
            $loan->collection_method = 1;
            $loan->period = 36;
            $loan->interest = 12;
            $loan->penalty = 3;
        } else if (isset($loan->id)) {
            $this->redirect(["update", 'id' => $loan->id]);
        }
        $model->id = 0;

        if ($model->load(Yii::$app->request->post()) && $loan->load(Yii::$app->request->post())) {
            if ($model->validate() && $loan->validate()) {
                $tx = Yii::$app->getDb()->beginTransaction();
                $loanCreator = new LoanCreator();
                $id = $loanCreator->createLoan($loan);
                if ($id == -1) {
                    $tx->rollBack();
                } else {
                    $model->id = $id;
                    $model->save();
                    $tx->commit();
                    Yii::$app->getSession()->remove("loan");
                    Yii::$app->getSession()->remove("loanex");
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
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

    public function actionSetCustomer($id, $type)
    {
        $loan = new Loan();
        if ($id != 0) {
            $loan = Loan::findOne(['id' => $id]);
        }
        $loan->load(Yii::$app->request->post());
        Yii::$app->getSession()->set('loan', $loan);

        $loanex = new PersonalLoan();
        if ($id != 0) {
            $loanex = PersonalLoan::findOne(['id' => $id]);
        }
        $loanex->load(Yii::$app->request->post());
        Yii::$app->getSession()->set('loanex', $loanex);

        Yii::$app->getSession()->set('loan-req', $type);

        $this->redirect(["customer/index"]);
    }

    /**
     * Updates an existing PersonalLoan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $loan = Yii::$app->getSession()->get("loan");
        if ($loan == null || $loan->id != $id) {
            $loan = Loan::findOne(['id' => $id]);
        }

        if ($loan->status != 'PENDING') {
            return $this->redirect(['updatex', 'id' => $id]);
        }

        if ($model->load(Yii::$app->request->post()) && $loan->load(Yii::$app->request->post()) && $model->validate() && $loan->validate()) {
            $tx = Yii::$app->getDb()->beginTransaction();
            $loan->save();
            $model->save();
            $tx->commit();
            Yii::$app->getSession()->remove("loan");
            Yii::$app->getSession()->remove("loanex");
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
     * Updates an existing PersonalLoan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatex($id)
    {
        $model = $this->findModel($id);
        $loan = Loan::findOne(['id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model2 = $this->findModel($id);
            $model2->notes = $model->notes;
            if ($model2->save()) {
                return $this->redirect(['view', 'id' => $model2->id]);
            }
        }
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
        return $this->render('updatex', [
            'model' => $model,
            'loan' => $loan,
            'applicant' => $applicant,
            'guarantor1' => $guarantor1,
            'guarantor2' => $guarantor2,
            'guarantor3' => $guarantor3,
        ]);
    }

    /**
     * Finds the HpNewVehicleLoan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonalLoan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonalLoan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
