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
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hp-new-vehicle-loan-form">

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
        <?= Elements::header(Elements::icon('car') . '<div class="content">Vehicle Details<div class="sub header">Manage vehicle details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'vehicle_type')->dropDownList(ArrayHelper::map(VehicleType::find()->all(), 'id', 'name')) ?>
        <?= $form->field($model, 'make')->dropDownList(ArrayHelper::map(VehicleBrand::find()->all(), 'id', 'name')) ?>
        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'engine_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'chasis_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'vehicle_no')->textInput(['maxlength' => true]) ?>

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
        <?= $form->field($model, 'rmv_sent_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
        <?= $form->field($model, 'rmv_sent_agent')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'rmv_sent_by')->textInput(['maxlength' => true]) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'rmv_recv_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
        <?= $form->field($model, 'rmv_recv_agent')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'rmv_recv_by')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
