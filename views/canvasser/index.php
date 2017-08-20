<?php

use app\utils\enums\CanvasserStatus;
use app\utils\PhoneNoFormatter;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CanvasserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canvassers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canvasser-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Canvasser', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['canvasser/view', 'id' => $model['id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'account',
            ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                return CanvasserStatus::label($data->status);
            }],
            ['attribute' => 'phone', 'format' => 'html', 'content' => function ($data) {
                return PhoneNoFormatter::formatAll($data->phone, $data->mobile, '');
            }],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
