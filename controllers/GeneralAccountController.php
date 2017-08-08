<?php

namespace app\controllers;

use app\models\Account;
use app\models\GeneralAccount;
use app\models\GeneralAccountSearch;
use app\utils\enums\GeneralAccountTypes;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * GeneralAccountController implements the CRUD actions for GeneralAccount model.
 */
class GeneralAccountController extends LmsController
{
    /**
     * Lists all GeneralAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeneralAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeneralAccount model.
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
     * Creates a new GeneralAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeneralAccount();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $tx = Yii::$app->getDb()->beginTransaction();
            if($model->save()) {
                $model->account_id = Account::createAccountId(Account::TYPE_GENERAL, $model->id);
                $account = new Account();
                $account->id = $model->account_id;
                $account->type = Account::TYPE_GENERAL;
                $account->balance = 0.0;
                $account->protection = GeneralAccountTypes::getProtection($model->type);
                if($account->save() && $model->save()) {
                    $tx->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $tx->rollBack();
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GeneralAccount model.
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
     * Deletes an existing GeneralAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GeneralAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeneralAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeneralAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
