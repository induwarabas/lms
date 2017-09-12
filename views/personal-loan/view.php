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
/* @var $model app\models\PersonalLoan */
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

    <div class="personal-loan-view">

        <h1><?= Html::encode($this->title) ?></h1>

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
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
        } else {
            if ($loan->status == 'PENDING') {
                echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']);
            }
        }
        if ($loan->status == 'ACTIVE') {
            echo Html::a('Recover', ['loan/recover', 'id' => $model->id], ['class' => 'ui button green']);
            echo Html::a('View Schedule', ['loan/schedule', 'id' => $model->id], ['class' => 'ui button brown']);
        }

        if (!$loan->paid) {
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
        ?>

        <form action="<?= \yii\helpers\Url::to(['teller/payment']) ?>" method="post" id="loan-pay">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <input type="hidden" id="tellerpayment-loanid" name="TellerPayment[loanId]" value="<?= $loan->id ?>"/>
            <input type="hidden" id="tellerpayment-link" name="TellerPayment[link]" value="<?= uniqid() ?>"/>
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