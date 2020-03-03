<?php

use app\models\CollectionMethod;
use app\models\DisburseModel;
use app\models\LoanType;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanPaymentStatus;
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

        <h1><?= Html::encode($this->title.($model->seized == 1? "  (Seized)" : "")) ?></h1>

        <?php
        if ($error != null && $error != '') {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-danger',
                ],
                'body' => '<b>Error:</b> ' . $error,
            ]);
        } ?>

        <?php if ($loan->status == 'PENDING' && User::hasPermission('loandisburse')) { ?>
            <?php $dsb = new DisburseModel(['date' => ($loan->disbursed_date != null && $loan->disbursed_date != '') ? $loan->disbursed_date : date('Y-m-d'), 'loan' => $model->id]); ?>
            <?php $frm = ActiveForm::begin(['action' => ['loan/disburse'], 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>
            <?php $modal = Modal::begin([
                'size' => Size::TINY,
                'header' => '<h2>Disburse loan</h2>',
                'toggleButton' => ['label' => 'Disburse this loan', 'class' => 'ui button red'],
                'footer' => Html::submitButton(Elements::icon('checkmark') . "Disburse", ['class' => 'ui button red'])
                    . Elements::button('Nope', ['class' => 'ui button default', 'data-dismiss' => 'modal'])

            ]); ?>
            <p class="description">Are you sure you want to disburse this loan?</p>
            <b>Note:</b> This action cannot be undone.
            <hr/>
            <?= $frm->field($dsb, 'date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
            <?= $frm->field($dsb, 'loan')->hiddenInput()->label(false) ?>

            <?php $modal::end(); ?>

            <?php $frm::end() ?>
        <?php } ?>
        <hr/>

        <?php
        if (User::hasPermission('editafterdisburse')) {
            if ($loan->status == LoanStatus::ACTIVE) {
                echo Html::a('Settle', ['loan/settlement', 'id' => $model->id], ['class' => 'ui button red']);
            }
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
        } else {
            if ($loan->status == LoanStatus::PENDING) {
                echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
            }
        }
        if ($loan->status == LoanStatus::ACTIVE && $model->seized == 0) {
            echo Html::a('Seize', ['hp-new-vehicle-loan/seize2', 'id' => $model->id], ['class' => 'ui button red']);
        }
        if ($loan->status == LoanStatus::ACTIVE && $model->seized == 1) {
            echo Html::a('Release Seize', ['hp-new-vehicle-loan/release-seize', 'id' => $model->id], ['class' => 'ui button red']);
        }

        if ($loan->status == LoanStatus::ACTIVE) {
            echo Html::a('Recover', ['loan/recover', 'id' => $model->id], ['class' => 'ui button green']);
        }

        if ($loan->status != LoanStatus::PENDING) {
            echo Html::a('View Schedule', ['loan/schedule', 'id' => $model->id], ['class' => 'ui button brown']);
        }

        if ($loan->status != LoanStatus::CLOSED && !$loan->paid) {
            echo Html::a('Down Payment Receipt', '#', ['class' => 'ui button green', 'id' => 'btn-down-pay']);
        }

        if (!$loan->paid && $loan->status == 'ACTIVE' && User::hasPermission('loanpayment')) {
            echo Html::a('Pay', '#', ['class' => 'ui button red', 'id' => 'btn-loan-pay']);
        }
        if ($loan->status == 'ACTIVE' && User::hasPermission('tellerTransactions')) {
            echo Html::a('Receipt', '#', ['class' => 'ui button blue', 'id' => 'btn-loan-receipt']);
        }
        if ($loan->status == 'ACTIVE') {
            echo ButtonDropdown::widget([
                'label' => 'Letter',
                'options' => ['class' => 'ui button blue'],
                'dropdown' => [
                    'items' => [
                        ['label' => 'Welcome', 'url' => ['letter', 'id' => $loan->id, 'letter' => 'welcome-vehicle']],
                        ['label' => 'Arrears', 'url' => ['letter', 'id' => $loan->id, 'letter' => 'arrears-vehicle']],
                    ],
                ],
            ]);
        }

        if (($loan->status == LoanStatus::COMPLETED || $loan->status == LoanStatus::PENDING) && User::hasPermission("closeLoan")) {
            echo Html::a('Close', ['loan/close', 'id' => $loan->id], ['class' => 'ui button red', 'id' => 'btn-close-loan']);
        }
        ?>

        <form action="<?= \yii\helpers\Url::to(['teller/payment']) ?>" method="post" id="loan-pay">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <input type="hidden" id="tellerpayment-loanid" name="TellerPayment[loanId]" value="<?= $loan->id ?>"/>
            <input type="hidden" id="tellerpayment-link" name="TellerPayment[link]" value="<?= uniqid() ?>"/>
        </form>

        <form action="<?= \yii\helpers\Url::to(['teller/down-payment-receipt']) ?>" method="post" id="down-pay">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <input type="hidden" id="tellerreceipt-loanid" name="TellerReceipt[loanId]" value="<?= $loan->id ?>"/>
            <input type="hidden" id="tellerreceipt-link" name="TellerReceipt[link]" value="<?= uniqid() ?>"/>
        </form>

        <form action="<?= \yii\helpers\Url::to(['teller/receipt']) ?>" method="post" id="loan-receipt">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <input type="hidden" id="tellerreceipt-loanid" name="TellerReceipt[loanId]" value="<?= $loan->id ?>"/>
            <input type="hidden" id="tellerreceipt-link" name="TellerReceipt[link]" value="<?= uniqid() ?>"/>
        </form>

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
                    ['attribute' => 'payment_status', 'format' => 'html', 'value' => function ($data)  use ($model) {
                        return LoanPaymentStatus::label($model->seized == 1 ? "SEIZED":$data->payment_status);
                    }],
                    ['attribute' => 'amount', 'value' => number_format($loan->amount, 2)],
                    ['attribute' => 'charges', 'label' => 'Down Payment', 'value' => function ($data) use ($model) {
                        return number_format($model->down_payment, 2);
                    }],
                    ['attribute' => 'charges', 'label' => 'Sales commission', 'value' => function ($data) use ($model) {
                        return number_format($model->getSalesCommission(), 2);
                    }],
                    ['attribute' => 'charges', 'label' => 'Canvassing commission', 'value' => function ($data) use ($model) {
                        return number_format($model->getCanvassingCommission(), 2);
                    }],
                    ['attribute' => 'rmv_charges', 'label' => 'RMV Charges', 'value' => function ($data) use ($model) {
                        return number_format($model->rmv_charges, 2);
                    }],
                    ['attribute' => 'charges', 'label' => 'Seize Panelty', 'value' => function ($data) use ($model) {
                        return number_format($model->seize_panelty, 2);
                    }],
                    ['attribute' => 'charges', 'label' => 'Other Charges', 'value' => function ($data) use ($model) {
                        return number_format($model->charges, 2);
                    }],
                    ['attribute' => 'charges', 'label' => 'Total Charges', 'value' => number_format($loan->charges, 2) . "  (Sales Commission + Canvassing Commission + RMV Charges + Other Charges)"],
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
                    ['attribute' => 'price', 'value' => number_format($model->price, 2)],
                    ['attribute' => 'loan_amount', 'value' => number_format($model->loan_amount, 2)],
                    ['attribute' => 'insurance', 'value' => number_format($model->insurance, 2)],
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
                    ['attribute' => 'supplier', 'format' => 'html', 'value' => SupplierView::widget(['supplier' => $model->supplier])],
                    ['attribute' => 'sales_commision', 'format' => 'html', 'value' => CommissionView::widget(['model' => $model, 'type' => 'sales', 'owner' => 'supplier'])],
                    ['attribute' => 'canvassed', 'format' => 'html', 'value' => CanvasserView::widget(['canvasser' => $model->canvassed])],
                    ['attribute' => 'canvassing_commision', 'format' => 'html', 'value' => CommissionView::widget(['model' => $model, 'type' => 'canvassing', 'owner' => 'canvassed'])],
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
                    ['attribute' => 'charges', 'label' => 'RMV Charges', 'value' => function ($data) use ($model) {
                        return number_format($model->rmv_charges, 2);
                    }],
                    'rmv_sent_date',
                    ['attribute' => 'rmv_sent_agent', 'format' => 'html', 'value' => function ($data) {
                        return isset($data->rmv_sent_agent) && $data->rmv_sent_agent != '' ? $data->rmv_sent_agent : '<span class="not-set">(not set)</span>';
                    }],
                    ['attribute' => 'rmv_sent_by', 'format' => 'html', 'value' => function ($data) {
                        return isset($data->rmv_sent_by) && $data->rmv_sent_by != '' ? $data->rmv_sent_by : '<span class="not-set">(not set)</span>';
                    }],
                    'rmv_recv_date',
                    ['attribute' => 'rmv_recv_agent', 'format' => 'html', 'value' => function ($data) {
                        return isset($data->rmv_recv_agent) && $data->rmv_recv_agent != '' ? $data->rmv_recv_agent : '<span class="not-set">(not set)</span>';
                    }],
                    ['attribute' => 'rmv_recv_by', 'format' => 'html', 'value' => function ($data) {
                        return isset($data->rmv_recv_by) && $data->rmv_recv_by != '' ? $data->rmv_recv_by : '<span class="not-set">(not set)</span>';
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

$('#btn-down-pay').click(function(e){
    e.preventDefault();
    $('#down-pay').submit();
});

$('#btn-loan-receipt').click(function(e){
    e.preventDefault();
    $('#loan-receipt').submit();
});
")
?>