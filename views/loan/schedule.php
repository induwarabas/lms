<?php

use app\utils\enums\LoanScheduleStatus;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $loan \app\models\Loan */
/* @var $total array */
/* @var $payed array */
/* @var $balance double */

$this->title = "Schedule";
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $loan->id, 'url' => ['loan/view', 'id' => $loan->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="ui table table-bordered">
        <tr>
            <td>
                <span style="font-weight: bold;">Total Payment</span><br/>
                <span style="font-size: x-large;"><?= number_format($loan->total_payment, 2) ?></span><br/>
                <?= number_format($total['paid'], 2) . Elements::icon('add square', ['class' => 'green']) ?><br/>
                <?= number_format($loan->total_payment - $total['paid'], 2) . Elements::icon('minus square', ['class' => 'red']) ?>
            </td>
            <td>
                <span style="font-weight: bold;">Loan Amount</span><br/>
                <span style="font-size: x-large;"><?= number_format($loan->amount + $loan->charges, 2) ?></span><br/>
                <?= number_format($payed['principal'] + $payed['charges'], 2) . Elements::icon('add square', ['class' => 'green']) ?>
                <br/>
                <?= number_format($loan->amount + $loan->charges - $payed['principal'] - $payed['charges'], 2) . Elements::icon('minus square', ['class' => 'red']) ?>
            </td>
            <td>
                <span style="font-weight: bold;">Total Interest</span><br/>
                <span style="font-size: x-large;"><?= number_format($loan->total_interest, 2) ?></span><br/>
                <?= number_format($payed['interest'], 2) . Elements::icon('add square', ['class' => 'green']) ?><br/>
                <?= number_format($loan->total_interest - $payed['interest'], 2) . Elements::icon('minus square', ['class' => 'red']) ?>
            </td>
            <td>
                <span style="font-weight: bold;">Total Penalty</span><br/>
                <span style="font-size: x-large;"><?= number_format($total['penalty'], 2) ?></span><br/>
                <?= number_format($payed['penalty'], 2) . Elements::icon('add square', ['class' => 'green']) ?><br/>
                <?= number_format($total['penalty'] - $payed['penalty'], 2) . Elements::icon('minus square', ['class' => 'red']) ?>
            </td>
            <td>
                <span style="font-weight: bold;">Installment</span><br/>
                <span style="font-size: x-large;"><?= number_format($loan->installment, 2) ?></span>
            </td>
            <td>
                <span style="font-weight: bold;">Due</span><br/>
                <span style="font-size: x-large;"><?= number_format(abs($balance - $total['due']), 2) . Elements::icon( $total['due'] > $balance ? 'minus square' : 'plus square', ['class' => ($total['due']) > $balance ? 'red' : 'green']) ?></span>
                <br/>
                <?= number_format($balance, 2) . Elements::icon('add square', ['class' => 'green']) ?>
                <br/>
                <?= number_format($total['due'], 2) . Elements::icon('minus square', ['class' => 'red']) ?>
            </td>
        </tr>
    </table>
    <?php Pjax::begin(); ?>  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'ui table table-striped table-hover table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'demand_date', 'value' => function($data) {return ($data->demand_date == '9999-12-31') ? 'N/A' : $data->demand_date; }],
            'pay_date',
            ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                return LoanScheduleStatus::label($data->status);
            }],
            //['attribute' => "principal", 'label' => 'Installment', 'value' => function($data) {return $data->principal + $data->interest + $data->charges;}, 'contentOptions'=>array('style' => 'text-align: right;'), 'format'=>['decimal',2]],
            ['attribute' => "principal", 'value' => 'principal', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            ['attribute' => "interest", 'value' => 'interest', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            ['attribute' => "charges", 'value' => 'charges', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            'arrears',
            ['attribute' => "penalty", 'value' => 'penalty', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            ['attribute' => "paid", 'value' => 'paid', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            ['attribute' => "due", 'value' => 'due', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
            ['attribute' => "balance", 'value' => 'balance', 'contentOptions' => array('style' => 'text-align: right;'), 'format' => ['decimal', 2]],
        ]
    ]) ?><?php Pjax::end(); ?>


</div>
