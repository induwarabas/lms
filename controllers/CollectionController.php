<?php

namespace app\controllers;

use app\models\Setting;
use Yii;
use app\models\Collection;
use app\models\CollectionSearch;
use app\controllers\LmsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CollectionController implements the CRUD actions for Collection model.
 */
class CollectionController extends LmsController
{
    /**
     * Lists all Collection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CollectionSearch();
        $searchModel->date = Setting::findOne(1)->value;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Collection model.
     * @param integer $loan_id
     * @param string $date
     * @return mixed
     */
    public function actionView($loan_id, $date)
    {
        return $this->render('view', [
            'model' => $this->findModel($loan_id, $date),
        ]);
    }

    /**
     * Creates a new Collection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Collection();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'loan_id' => $model->loan_id, 'date' => $model->date]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Collection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $loan_id
     * @param string $date
     * @return mixed
     */
    public function actionUpdate($loan_id, $date)
    {
        $model = $this->findModel($loan_id, $date);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'loan_id' => $model->loan_id, 'date' => $model->date]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Collection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $loan_id
     * @param string $date
     * @return mixed
     */
    public function actionDelete($loan_id, $date)
    {
        $this->findModel($loan_id, $date)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Collection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $loan_id
     * @param string $date
     * @return Collection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($loan_id, $date)
    {
        if (($model = Collection::findOne(['loan_id' => $loan_id, 'date' => $date])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
