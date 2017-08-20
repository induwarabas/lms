<?php

namespace app\controllers;

use app\models\Account;
use app\utils\enums\CollectorStatus;
use Yii;
use app\models\Collector;
use app\models\CollectorSearch;
use app\controllers\LmsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CollectorrController implements the CRUD actions for Collector model.
 */
class CollectorController extends LmsController
{
    /**
     * Lists all Collector models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CollectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Collector model.
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
     * Creates a new Collector model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Collector();

        if ($model->load(Yii::$app->request->post())) {
            $tx = Yii::$app->getDb()->beginTransaction();
            if ($model->save()) {
                $account = new Account();
                $account->id = Account::createAccountId(Account::TYPE_COLLECTOR, $model->primaryKey);
                $account->type = Account::TYPE_COLLECTOR;
                $account->balance = 0.0;
                $account->protection = Account::PROTECTION_MINUS;
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
        $model->status = CollectorStatus::ACTIVE;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Collector model.
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
     * Finds the Collector model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Collector the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Collector::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
