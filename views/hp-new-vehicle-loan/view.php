<?php

use app\models\Canvasser;
use app\models\CollectionMethod;
use app\models\DisburseModel;
use app\models\LoanType;
use app\models\Supplier;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanStatus;
use app\utils\widgets\CanvasserView;
use app\utils\widgets\CommissionView;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use dosamigos\datepicker\DatePicker;
use webvimark\modules\UserManagement\models\User;
use yii\bootstrap\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\helpers\Size;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */
/* @var $error string */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['loan/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hp-new-vehicle-loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($error != null && $error != '') {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => '<b>Error:</b> '.$error,
        ]);
    } ?>

    <?php if ($loan->status == 'PENDING' && User::hasPermission('loandisburse')) {?>
        <?php $dsb = new DisburseModel(['date' => date('Y-m-d'), 'loan' => $model->id]); ?>
        <?php $frm = ActiveForm::begin(['action' => ['loan/disburse']]); ?>
        <?php $modal = Modal::begin([
            'size' => Size::TINY,
            'header' => '<h2>Disburse loan</h2>',
            'toggleButton' => ['label' => 'Disburse this loan', 'class' => 'ui button red'],
            'footer' => Html::submitButton(Elements::icon('checkmark')."Disburse", ['class' => 'ui button red'])
                . Elements::button('Nope', ['class' => 'ui button default', 'data-dismiss' => 'modal'])

        ]); ?>
        <p class="description">Are you sure you want to disburse this loan?</p>
        <b>Note:</b> This action cannot be undone.
        <hr/>
        <?= $frm->field($dsb, 'date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
        <?= $frm->field($dsb, 'loan')->hiddenInput()->label(false) ?>

        <?php $modal::end(); ?>

        <?php $frm::end() ?>
    <?php } ?><hr/>

    <?php
    if (User::hasPermission('editafterdisburse')) {
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
    } else {
        if ($loan->status == 'PENDING') {
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
        }
    }
    if ($loan->status == 'ACTIVE') {
        echo Html::a('Recover', ['loan/recover', 'id' => $model->id], ['class' => 'ui button green']);
    }
    echo Html::a('View Schedule', ['loan/schedule', 'id' => $model->id], ['class' => 'ui button brown']);
    ?>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Involved customer details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= DetailView::widget([
            'model' => $loan,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                ['attribute' => 'customer_id', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $applicant, 'fullname' => true])],
                ['attribute' => 'guarantor_1', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor1, 'fullname' => true])],
                ['attribute' => 'guarantor_2', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor2, 'fullname' => true])],
                ['attribute' => 'guarantor_3', 'format' => 'html', 'value' => CustomerView::widget(['customer' => $guarantor3, 'fullname' => true])],
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
                ['attribute' => 'type', 'value' => function($data) {return LoanType::findOne($data->type)->name;}],
                ['attribute' => 'status', 'format' => 'html', 'value' => function($data) {return LoanStatus::label($data->status);}],
                'amount',
                'charges',
                ['attribute' => 'interest', 'value' => function($data) {return $data->interest.' %';}],
                ['attribute' => 'penalty', 'value' => function($data) {return $data->penalty.' %';}],
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
                ['attribute'=>'supplier', 'format' => 'html','value'=> SupplierView::widget(['supplier' => $model->supplier])],
                ['attribute' => 'sales_commision', 'format' => 'html','value' => CommissionView::widget(['model' => $model, 'type' => 'sales', 'owner' => 'supplier'])],
                ['attribute'=>'canvassed', 'format' => 'html','value'=> CanvasserView::widget(['canvasser' => $model->canvassed])],
                ['attribute' => 'canvassing_commision', 'format' => 'html','value' => CommissionView::widget(['model' => $model, 'type' => 'canvassing', 'owner' => 'canvassed'])],
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
                ['attribute' => 'rmv_sent_agent', 'format' => 'html','value' => function($data) {return isset($data->rmv_sent_agent) && $data->rmv_sent_agent != '' ? $data->rmv_sent_agent: '<span class="not-set">(not set)</span>';}],
                ['attribute' => 'rmv_sent_by', 'format' => 'html','value' => function($data) {return isset($data->rmv_sent_by) && $data->rmv_sent_by != '' ? $data->rmv_sent_by: '<span class="not-set">(not set)</span>';}],
                'rmv_recv_date',
                ['attribute' => 'rmv_recv_agent', 'format' => 'html','value' => function($data) {return isset($data->rmv_recv_agent) && $data->rmv_recv_agent != '' ? $data->rmv_recv_agent: '<span class="not-set">(not set)</span>';}],
                ['attribute' => 'rmv_recv_by', 'format' => 'html','value' => function($data) {return isset($data->rmv_recv_by) && $data->rmv_recv_by != '' ? $data->rmv_recv_by: '<span class="not-set">(not set)</span>';}],
            ],
        ]) ?>
    </div>
</div>
