<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GeneralAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'General Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        //Html::a(Yii::t('app', 'Create General Account'), ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['general-account/view', 'id' => $model['id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'description',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
