<?php

use app\utils\PopupWindow;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

use miloschuman\highcharts\Highcharts;



/* @var $this yii\web\View */
/* @var $data array*/

$this->title = 'Monthly Summary';
$this->params['breadcrumbs'][] = $this->title;
?><?php
echo Highcharts::widget([
    'options' => [
        'chart' => ['type' => 'column'],
        'title' => ['text' => 'Monthly Payments'],
        'xAxis' => [
            'categories' => $data["columns"]
        ],
        'yAxis' => [
            'title' => ['text' => 'Amount']
        ],
        'plotOptions' => [
            'column' => ['stacking' => 'normal']
        ],

        'tooltip' => [
        'formatter' => new JsExpression("function(){
           return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
         }")],
        'series' => [
            ['name' => 'Arrears Receivable', 'data' => $data["arrearsReceivable"], 'stack' => 'Receivable', 'color' => '#ffc107'],
            ['name' => 'This Month Receivable', 'data' => $data["thisMonthReceivable"], 'stack' => 'Receivable', 'color' => '#17a2b8'],
            ['name' => 'Saving Balance', 'data' => $data["savingBalance"], 'stack' => 'Received', 'color' => '#28a745'],
            ['name' => 'Arrears Received', 'data' => $data["arrearsReceived"], 'stack' => 'Received', 'color' => '#ffc107'],
            ['name' => 'This Month Received', 'data' => $data["thisMonthReceived"], 'stack' => 'Received', 'color' => '#17a2b8'],
            ['name' => 'Arrears', 'data' => $data["arrears"], 'stack' => 'Arrears', 'color' => '#dc3545'],
        ]
    ]
]);

echo Highcharts::widget([
    'options' => [
        'chart' => ['type' => 'line'],
        'title' => ['text' => 'Performance'],
        'xAxis' => [
            'categories' => $data["columns"]
        ],
        'yAxis' => [
            'title' => ['text' => 'Amount']
        ],
//        'plotOptions' => [
//            'column' => ['stacking' => 'normal']
//        ],

        'tooltip' => [
            'formatter' => new JsExpression("function(){
           return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '%';
         }")],
        'series' => [
            ['name' => 'Collections', 'data' => $data["collectedPercentage"], 'stack' => 'Collected', 'color' => '#28a745']
        ]
    ]
]);


//    chart: {
//        type: 'column'
//    },
//
//    title: {
//        text: 'Total fruit consumtion, grouped by gender'
//    },
//
//    xAxis: {
//        categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
//    },
//
//    yAxis: {
//        allowDecimals: false,
//        min: 0,
//        title: {
//            text: 'Number of fruits'
//        }
//    },
//
//    tooltip: {
//        formatter: function () {
//            return '<b>' + this.x + '</b><br/>' +
//                this.series.name + ': ' + this.y + '<br/>' +
//                'Total: ' + this.point.stackTotal;
//        }
//    },
//
//    plotOptions: {
//        column: {
//            stacking: 'normal'
//        }
//    },
//
//    series: [{
//        name: 'John',
//        data: [5, 3, 4, 7, 2],
//        stack: 'male'
//    }, {
//        name: 'Joe',
//        data: [3, 4, 4, 2, 5],
//        stack: 'male'
//    }, {
//        name: 'Jane',
//        data: [2, 5, 6, 2, 1],
//        stack: 'female'
//    }, {
//        name: 'Janet',
//        data: [3, 0, 4, 4, 3],
//        stack: 'female'
//    }]
//});
?>

