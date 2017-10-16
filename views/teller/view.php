<?php

use app\models\CollectionMethod;
use app\models\DisburseModel;
use app\models\LoanType;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanStatus;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CanvasserView;
use app\utils\widgets\CommissionView;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use dosamigos\datepicker\DatePicker;
use kartik\form\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use yii\bootstrap\Alert;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\helpers\Size;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['loan/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="personal-loan-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="ui segment">
            <?= Elements::header(Elements::icon('money') . '<div class="content">Loan Details<div class="sub header">Loan details.</div></div>', ['tag' => 'h2']) ?>
            <?= Elements::divider() ?>
            <?= DetailView::widget([
                'model' => $loan,
                'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
                'attributes' => [
                    ['attribute' => 'type', 'value' => function ($data) {
                        return LoanType::findOne($data->type)->name;
                    }],
                    ['attribute' => 'saving_account', 'format' => 'html', 'value' => AccountIDView::widget(['accountId' => $loan->saving_account])],
                    ['attribute' => 'loan_account', 'format' => 'html', 'value' => AccountIDView::widget(['accountId' => $loan->loan_account])],
                    'disbursed_date',
                    'closed_date',

                    ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                        return LoanStatus::label($data->status);
                    }],
                    ['attribute' => 'amount', 'value' => number_format($loan->amount, 2)],
                    ['attribute' => 'charges', 'label' => 'Charges', 'value' => function ($data) {
                        return number_format($data->charges, 2);
                    }],
                    ['attribute' => 'amount', 'label' => 'Loan Amount', 'format' => 'html', 'value' => function ($data) {
                        return number_format($data->amount + $data->charges, 2) . " (Total Charges + Amount)";
                    }],
                    ['attribute' => 'interest', 'value' => function ($data) {
                        return $data->interest . ' %';
                    }],
                    ['attribute' => 'penalty', 'value' => function ($data) {
                        return $data->penalty . ' %';
                    }],
                    ['attribute' => 'collection_method', 'value' => CollectionMethod::findOne(['id' => $loan->collection_method])->name],
                    'period',
                    ['attribute' => 'installment', 'value' => number_format($loan->installment, 2)],
                    ['attribute' => 'installment', 'label' => 'Charges Per Term', 'value' => number_format($loan->charges / $loan->period, 2) . " (Total Charges / Period)"],
                    ['attribute' => 'installment', 'label' => 'Total Installment', 'format' => 'html', 'value' => '<span style="font-size: x-large">' . number_format($loan->installment + $loan->charges / $loan->period, 2) . '</span>' . " (Installment + Charges per term)"],
                    ['attribute' => 'amount', 'label' => 'Notes', 'format' => 'html', 'value' => function ($data) use ($model) {
                        return $model->notes;
                    }],
                ],
            ]) ?>
        </div>
    </div>
<?php
$this->registerJs("
$('#btn-loan-pay').click(function(e){
    e.preventDefault();
    $('#loan-pay').submit();
});

$('#btn-loan-receipt').click(function(e){
    e.preventDefault();
    $('#loan-receipt').submit();
});
")
?>