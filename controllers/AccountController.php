<?php

namespace app\controllers;

use app\models\Customer;
use app\models\Loan;
use app\models\Transaction;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use app\controllers\LmsController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends LmsController
{
    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * View account ledger
     * @param string $id
     * @return mixed
     */
    public function actionLedger($id)
    {
        $query = Transaction::find()->where("cr_account = :acc or dr_account = :acc", [":acc" => $id])->orderBy(['txid'=>SORT_DESC])->limit(10);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false,
            'pagination' => false,
        ]);

        $account = Account::findOne($id);
        $accountName = 'General';
        $accountNameUrl = '';
        $loanId = 0;
        $balance = $account->balance;

        if ($account->type == Account::TYPE_SAVING) {
            $loan = Loan::find()->where("saving_account = :id", [':id' => $id])->one();
            $loanId = $loan->id;
            $customer = Customer::findOne($loan->customer_id);
            $accountName = $customer->name;
            $accountNameUrl = Yii::$app->getUrlManager()->createUrl(['customer/view', 'id' => $customer->id]);
        }else if ($account->type == Account::TYPE_LOAN) {
            $loan = Loan::find()->where("loan_account = :id", [':id' => $id])->one();
            $loanId = $loan->id;
            $customer = Customer::findOne($loan->customer_id);
            $accountName = $customer->name;
            $accountNameUrl = Yii::$app->getUrlManager()->createUrl(['customer/view', 'id' => $customer->id]);
        }

        return $this->render('ledger', [
            'accountId' => $id,
            'dataProvider' => $dataProvider,
            'accountName' => $accountName,
            'accountNameUrl' => $accountNameUrl,
            'loanId' => $loanId,
            'balance' => $balance
        ]);
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
