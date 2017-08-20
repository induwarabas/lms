<?php

use app\models\Collector;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Collections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'rowOptions' => function ($model, $key, $index, $grid) {
//            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['collector/view', 'id' => $model['id']]) . '";'];
//        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'collector_id', 'value' => function($data) {return Collector::findOne($data->collector_id)->name;}, 'filter' => ArrayHelper::map(Collector::find()->all(), 'id', 'name')],
            'loan_id',
            ['attribute' => 'date', 'filter' => DatePicker::widget(['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd'], 'name' => 'CollectionSearch[date]', 'value' => $searchModel->date])],
            'installments',
            ['attribute' => 'status', 'format' => 'html','label' => 'Collected', 'value' => function($data) {
                if ($data->status == 'COLLECTED') {
                    return Elements::label($data->status, ['class' => 'green']);
                } else {
                    return Elements::label($data->status, ['class' => 'red']);
                }
            }, 'filter' => ['NOT_COLLECTED' => 'NOT_COLLECTED', 'COLLECTED' => 'COLLECTED']],
            'amount',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
