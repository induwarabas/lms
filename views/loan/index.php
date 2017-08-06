<?php

use app\models\Customer;
use app\models\LoanType;
use app\utils\enums\LoanStatus;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Loan', ['createx'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' =>function ($model, $key, $index, $grid) {
                return ['id' => $model['id'], 'onclick' => 'window.location = "'.Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $model['id']]).'";'];
            },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            'id',
            ['attribute' => 'type', 'content' => function($data){return LoanType::findOne(['id' => $data->type])->name;}, 'filter'=>array_merge(['0'=>'All'], ArrayHelper::map(LoanType::find()->asArray()->all(), 'id', 'name')),],
            ['attribute' => 'customer_id', 'content' => function($data){return Customer::findOne(['id' => $data->customer_id])->name;}],
            'amount',
            ['attribute' =>'status', 'format' => 'html', 'value' => function($data){ return LoanStatus::label($data->status);}]
            // 'collection_method',
            // 'period',
            // 'status',
            // 'disbursed_date',
            // 'closed_date',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
