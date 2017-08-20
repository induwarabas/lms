<?php

use app\utils\enums\CollectorStatus;
use app\utils\PhoneNoFormatter;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CollectorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Collectors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collector-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Collector'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['collector/view', 'id' => $model['id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'account',
            ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                return CollectorStatus::label($data->status);
            }],
            ['attribute' => 'phone', 'format' => 'html', 'content' => function ($data) {
                return PhoneNoFormatter::formatAll($data->phone, $data->mobile, '');
            }],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
