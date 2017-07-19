<?php

use app\utils\enums\LoanScheduleStatus;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = "Schedule";
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>  <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'ui table table-striped table-hover table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'demand_date',
            ['attribute' =>'status', 'format' => 'html', 'value' => function($data){ return LoanScheduleStatus::label($data->status);}],
            //['attribute' => "Amount", 'value' => 'amount', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "principal", 'value' => 'interest', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "interest", 'value' => 'principal', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "charges", 'value' => 'charges', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "balance", 'value' => 'balance', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            'arrears',
            ['attribute' => "penalty", 'value' => 'penalty', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "paid", 'value' => 'paid', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "due", 'value' => 'due', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "balance", 'value' => 'balance', 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
        ]
    ]) ?><?php Pjax::end(); ?>


</div>
