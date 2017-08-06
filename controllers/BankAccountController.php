<?php

namespace app\controllers;

use app\models\Account;
use app\models\BankAccount;
use app\models\BankAccountSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * BankAccountController implements the CRUD actions for BankAccount model.
 */
class BankAccountController extends LmsController
{
    /**
     * Lists all BankAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BankAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BankAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BankAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BankAccount();

        if ($model->load(Yii::$app->request->post())) {
            $tx = Yii::$app->getDb()->beginTransaction();
            if ($model->save()) {
                $acc = new Account();
                $acc->id = Account::createAccountId(Account::TYPE_BANK, $model->primaryKey);
                $acc->type = Account::TYPE_BANK;
                $acc->balance = 0.0;
                $acc->protection = Account::PROTECTION_NONE;
                $model->account_id = $acc->id;
                if ($acc->save() && $model->save()) {
                    $tx->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            $tx->rollBack();
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing BankAccount model.
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

    /**
     * Deletes an existing BankAccount model.
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
     * Finds the BankAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BankAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BankAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
