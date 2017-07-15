<?php

use app\models\CollectionMethod;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanStatus;
use app\utils\widgets\CustomerView;
use webvimark\modules\UserManagement\models\User;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\helpers\Size;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['loan/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hp-new-vehicle-loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if (User::hasPermission('authorizeLoan')) {
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
    }
    ?>

    <?php if ($loan->status == 'PENDING' && User::hasPermission('authorizeLoan')) {?>
    <?php $modal = Modal::begin([
        'size' => Size::TINY,
        'header' => '<h2>Disburse loan</h2>',
        'toggleButton' => ['label' => 'Disburse', 'class' => 'ui button brown'],
        'footer' => Html::a(Elements::icon('checkmark')."Disburse", ['loan/disburse', 'id' => $model->id],['class' => 'ui button brown'])
            . Elements::button('Nope', ['class' => 'ui button default', 'data-dismiss' => 'modal'])

    ]); ?>
    <p class="description">Are you sure you want to disburse this loan?</p>
    <b>Note:</b> This action cannot be undone.
    <?php $modal::end(); ?>
    <?php } ?>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Involved customer details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $loan,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                ['attribute' => 'customer_id', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $applicant])],
                ['attribute' => 'guarantor_1', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor1])],
                ['attribute' => 'guarantor_2', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor2])],
                ['attribute' => 'guarantor_3', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor3])],
            ],
        ]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('money') . '<div class="content">Loan Details<div class="sub header">Loan details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $loan,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                ['attribute' => 'status', 'format' => 'html', 'value' => function($data) {return LoanStatus::label($data->status);}],
                'amount',
                'charges',
                'interest',
                ['attribute' => 'collection_method', 'value' => CollectionMethod::findOne(['id' => $loan->collection_method])->name],
                'period',
                'installment',
                'saving_account',
                'loan_account',
                'disbursed_date',
                'closed_date',
            ],
        ]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('car') . '<div class="content">Vehicle Details<div class="sub header">Vehicle details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                'vehicle_no',
                ['attribute' => 'vehicle_type', 'value' => VehicleType::findOne(['id' => $model->vehicle_type])->name],
                ['attribute' => 'make', 'value' => VehicleBrand::findOne(['id' => $model->make])->name],
                'model',
                'engine_no',
                'chasis_no',
                'price',
                'loan_amount',
                'insurance',
            ],
        ]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('briefcase') . '<div class="content">Charges<div class="sub header">Charges details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                'supplier',
                'sales_commision',
                'canvassed',
                'canvassing_commision',
            ],
        ]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('send') . '<div class="content">RMV<div class="sub header">RMV document tracking</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                'rmv_sent_date',
                'rmv_sent_agent',
                'rmv_sent_by',
                'rmv_recv_date',
                'rmv_recv_agent',
                'rmv_recv_by',
            ],
        ]) ?>
    </div>
</div>
