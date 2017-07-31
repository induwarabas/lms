<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $details \app\utils\AccountDetails */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Html::a('View History', ['history', 'id' => $details->account->id], ['class' => 'ui button blue']) ?>

    <?= $this->render('_details', [
        'details' => $details,
    ]) ?>
    <?php
    if ($history != null) {
        echo $this->render('_search', [
            'history' => $history,
            'id' => $details->account->id
        ]);
    } ?>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'timestamp',
            'type',
            'description',
            ['attribute' => 'amount', 'format' => 'html', 'value' => function ($data) use ($details) {
                if ($data->dr_account === $details->account->id) {
                    return number_format($data->amount, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($data->amount, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
            }, 'contentOptions' => array('style' => 'text-align: right;')],
            ['attribute' => 'amount', 'label' => 'Balance', 'format' => 'html', 'value' => function ($data) use ($details) {
                if ($data->dr_account === $details->account->id) {
                    return number_format($data->dr_balance, 2);
                } else {
                    return number_format($data->cr_balance, 2);
                }
            }, 'contentOptions' => array('style' => 'text-align: right;')],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
