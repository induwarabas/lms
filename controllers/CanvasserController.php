<?php

namespace app\controllers;

use app\models\Account;
use app\models\Canvasser;
use app\models\CanvasserSearch;
use app\utils\enums\CanvasserStatus;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * CanvasserController implements the CRUD actions for Canvasser model.
 */
class CanvasserController extends LmsController
{
    /**
     * Lists all Canvasser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CanvasserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Canvasser model.
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
     * Creates a new Canvasser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Canvasser();

        if ($model->load(Yii::$app->request->post())) {
            $tx = Yii::$app->getDb()->beginTransaction();
            if ($model->save()) {
                $account = new Account();
                $account->id = Account::createAccountId(Account::TYPE_CANVASSER, $model->primaryKey);
                $account->type = Account::TYPE_CANVASSER;
                $account->balance = 0.0;
                $account->protection = Account::PROTECTION_PLUS;
                if ($account->save()) {
                    $model->account = $account->id;
                    if ($model->save()) {
                        $tx->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            $tx->rollBack();

        }
        $model->status = CanvasserStatus::ACTIVE;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Canvasser model.
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
     * Finds the Canvasser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Canvasser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Canvasser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
