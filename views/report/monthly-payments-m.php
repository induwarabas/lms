<?php

use app\models\MonthlySummarySearch;
use app\utils\PopupWindow;
use kartik\form\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

use dosamigos\highcharts\HighCharts;

/* @var $this yii\web\View */
/* @var $receivable yii\data\ArrayDataProvider */
/* @var $received yii\data\ArrayDataProvider */
/* @var $summary yii\data\ArrayDataProvider */
/* @var $disbursements yii\data\ArrayDataProvider */
/* @var $report \app\models\MonthlyReport */
/* @var $searchModel app\models\MonthlySummarySearch */
/* @var $print boolean */

$this->title = 'Month Summary (' . $searchModel->year . "-" . str_pad($searchModel->month, 2, '0', STR_PAD_LEFT) . ")";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!$print) {

        $form = ActiveForm::begin([
            'action' => ['monthly-details'],
            'method' => 'get',
            'type' => ActiveForm::TYPE_INLINE
        ]); ?>

        <?= $form->field($searchModel, 'year')->textInput(['type' => 'number']) ?>
        <?= $form->field($searchModel, 'month')->textInput(['type' => 'number']) ?>

        <div class="form-group" align="right" style="padding-right: 20px;">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <p style="text-align: right">
            <?php
            echo Html::a("Summary", ['monthly-payments'], ['class' => 'ui button blue']);
            echo Html::a("Print", '#', ['class' => 'ui button blue', 'onclick' => PopupWindow::show(Url::current(['print' => 'true']))]);
            ?>
        </p>
    <?php } ?>
    <div class="row">
        <div class="col-lg-6">
            <h3>Receivable</h3>
            <?php
            $gridOptions = [
                'dataProvider' => $receivable,
                'tableOptions' => ['class' => 'ui table table-striped table-hover'],
                'columns' => [
                    'type',
                    ['attribute' => 'thisMonth', 'value' => function ($data) {
                        return number_format($data['thisMonth'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                    ['attribute' => 'arrears', 'value' => function ($data) {
                        return number_format($data['arrears'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                    ['attribute' => 'total', 'value' => function ($data) {
                        return number_format($data['total'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                ],
            ];
            if ($print) {
                $gridOptions['layout'] = '{items}';
            }
            ?>
            <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-lg-6">
            <h3>Received</h3>
            <?php
            $gridOptions = [
                'dataProvider' => $received,
                'tableOptions' => ['class' => 'ui table table-striped table-hover'],
                'columns' => [
                    'type',
                    ['attribute' => 'thisMonth', 'value' => function ($data) {
                        return number_format($data['thisMonth'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                    ['attribute' => 'arrears', 'value' => function ($data) {
                        return number_format($data['arrears'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                    ['attribute' => 'total', 'value' => function ($data) {
                        return number_format($data['total'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                ],
            ];
            if ($print) {
                $gridOptions['layout'] = '{items}';
            }
            ?>
            <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <h3>Summary</h3>
            <?php
            $gridOptions = [
                'dataProvider' => $summary,
                'tableOptions' => ['class' => 'ui table table-striped table-hover'],
                'columns' => [
                    'type',
                    ['attribute' => 'amount', 'value' => function ($data) {
                        return number_format($data['amount'], 2);
                    }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                ],
            ];
            if ($print) {
                $gridOptions['layout'] = '{items}';
            }
            ?>
            <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-lg-6">
            <?php
            echo Highcharts::widget([
                'clientOptions' => [
                    'chart' => ['type' => 'pie'],
                    'title' => ['text' => 'Payment Summary'],
//                    'xAxis' => [
//                        'categories' => $data["columns"]
//                    ],
//                    'yAxis' => [
//                        'title' => ['text' => 'Amount']
//                    ],
//                    'plotOptions' => [
//                        'column' => ['stacking' => 'normal']
//                    ],
//
                    'plotOptions' => [
                        'pie' => [
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'dataLabels' => [
                                'enabled' => true,
                                'format' => '<b>{point.name}</b>: {point.percentage:.1f} %',
                            ]
                        ]
                    ],
                    'tooltip' => [
                        'pointFormat' => '{series.name}: {point.y} <b>({point.percentage:.1f}%)</b>'],
                    'series' => [
                        ['name' => 'Amount', 'data' => [
                            [
                                'name' => 'Arrears',
                                'y' => floatval($report->arrears),
                                'color' => '#dc3545'
                            ],

                            [
                                'name' => 'Partially Payed',
                                'y' => floatval($report->savingBalance),
                                'color' => '#17a2b8'
                            ],
                            [
                                'name' => 'Received',
                                'y' => floatval($report->received + $report->partialPay),
                                'color' => '#28a745'
                            ]
                        ]
                        ]
                    ]
                ]
            ]);
            ?>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3>Disbursements</h3>
                <?php
                $gridOptions = [
                    'dataProvider' => $disbursements,
                    'tableOptions' => ['class' => 'ui table table-striped table-hover'],
                    'columns' => [
                        'type',
                        ['attribute' => 'amount', 'value' => function ($data) {
                            return $data['amount'];
                        }, 'contentOptions' => ['style' => 'text-align: right;'], 'headerOptions' => ['style' => 'text-align: right;']],
                    ],
                ];
                if ($print) {
                    $gridOptions['layout'] = '{items}';
                }
                ?>
                <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
