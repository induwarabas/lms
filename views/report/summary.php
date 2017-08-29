<?php

use app\utils\PopupWindow;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $print boolean */

$this->title = 'Loan Summary';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$print) { ?>
    <p style="text-align: right">
        <?php
        echo Html::a("Print", '#', ['class' => 'ui button blue', 'onclick' => PopupWindow::show(Url::current(['print' => 'true']))]);
        ?>
    </p>
    <?php } ?>
    <?php
    $gridOptions = [
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            'status',
            ['attribute' => 'principal', 'value' => function($data) {return number_format($data['principal'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'interest', 'value' => function($data) {return number_format($data['interest'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'charges', 'value' => function($data) {return number_format($data['charges'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'penalty', 'value' => function($data) {return number_format($data['penalty'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'paid', 'value' => function($data) {return number_format($data['paid'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'due', 'value' => function($data) {return number_format($data['due'], 2);}, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
        ],
    ];
    if ($print) {
        $gridOptions['layout'] = '{items}';
    }
    ?>
    <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
    <?php Pjax::end(); ?>
</div>
