<?php

use app\models\Customer;
use app\models\LoanType;
use app\utils\enums\LoanStatus;
use app\utils\PopupWindow;
use app\utils\widgets\CustomerView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $total double */
/* @var $print boolean */

$this->title = 'Loans to disburse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$print) { ?>
    <p style="text-align: right">
        <?php
            echo Html::a("Print", '#', ['class' => 'ui button blue', 'onclick' => PopupWindow::show(Url::current(['print'=>'true']))]);
        ?>
    </p>
    <?php } ?>
    <div style="text-align: right"><span style="font-size: xx-large">Total :</span>
        <?php
        $parts = explode('.', number_format($total, 2));
        echo '<span style="font-size: xx-large">' . $parts[0] . '.' . '</span>' . '<span style="font-size: x-large">' . $parts[1] . '</span>';
        ?>
    </div>
    <?php
        $gridOptions = [
            'dataProvider' => $dataProvider,
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $model['id']]) . '";'];
            },
            'tableOptions' => ['class' => 'ui table table-striped table-hover'],
            'columns' => [
                ['attribute' => 'id', 'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']],
                ['attribute' => 'disbursed_date', 'label' => 'Date'],
                ['attribute' => 'type', 'content' => function ($data) {
                    return LoanType::findOne(['id' => $data->type])->name;
                }, 'filter' => ArrayHelper::map(LoanType::find()->asArray()->all(), 'id', 'name'),
                    'contentOptions' => ['style' => 'max-width: 140px;'], 'headerOptions' => ['style' => 'max-width: 140px;'], 'filterOptions' => ['style' => 'max-width: 140px;']],
                ['attribute' => 'customer_id', 'content' => function ($data) use ($print) {
                    return CustomerView::widget(['customer' => Customer::findOne(['id' => $data->customer_id]), 'print' => $print]);
                }],
                ['attribute' => 'amount', 'value' => function($model) { return number_format($model['amount'], 2);}, 'contentOptions' => ['style' => 'text-align: right;']],
                // 'collection_method',
                // 'period',
                // 'status',
                // 'closed_date',
            ],
        ];
        if ($print) {
            $gridOptions['layout'] =  '{items}';
        }
    ?>
    <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
    <?php Pjax::end(); ?>
</div>
