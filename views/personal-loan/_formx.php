<?php

use app\models\CollectionMethod;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanStatus;
use app\utils\widgets\CanvasserView;
use app\utils\widgets\CommissionView;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use dosamigos\datepicker\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-loan-form">

    <?php $form = ActiveForm::begin(['id' => 'hp', 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>
    <?= Html::hiddenInput("action", "submit") ?>
    <?= $form->field($loan, 'type')->hiddenInput()->label(false) ?>
    <?= $form->field($loan, 'id')->hiddenInput()->label(false) ?>
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
                ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                    return LoanStatus::label($data->status);
                }],
                'amount',
                'charges',
                'interest',
                ['attribute' => 'penalty', 'format' => 'html', 'value' => function ($data) {
                    return isset($data->penalty) ? $data->penalty . ' %' : '<span class="not-set">(not set)</span>';
                }],
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
        <?= Elements::header(Elements::icon('send') . '<div class="content">Notes<div class="sub header">Personal loan notes</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
