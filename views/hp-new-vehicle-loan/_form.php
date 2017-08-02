<?php

use app\models\Canvasser;
use app\models\CollectionMethod;
use app\models\Supplier;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\widgets\CommissionSelector;
use app\utils\widgets\CustomerSelector;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;

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

    <?php $form = ActiveForm::begin(['id' => 'hp']); ?>
    <?= Html::hiddenInput("action", "submit") ?>
    <?= $form->field($loan, 'type')->hiddenInput()->label(false) ?>
    <?= $form->field($loan, 'id')->hiddenInput()->label(false) ?>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Manage customer details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($loan, 'customer_id')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Applicant', 'id' => $model->id]), 'customer' => $applicant, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_1')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 1', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 1']), 'customer' => $guarantor1, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_2')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 2', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 2']), 'customer' => $guarantor2, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_3')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 3', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 3']), 'customer' => $guarantor3, 'fullname' => true]) ?>
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
        <?= Elements::header(Elements::icon('money') . '<div class="content">Loan Details<div class="sub header">Manage loan details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'insurance')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'loan_amount')->textInput(['maxlength' => true]) ?>
        <?= $form->field($loan, 'interest')->textInput(['maxlength' => true]) ?>
        <?= $form->field($loan, 'penalty')->textInput(['maxlength' => true]) ?>
        <?= $form->field($loan, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>
        <?= $form->field($loan, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>
        <?= $form->field($loan, 'disbursed_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']])->label("Start Date") ?>
    </div>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('briefcase') . '<div class="content">Charges<div class="sub header">Manage charges details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?php
        $supps = ArrayHelper::map(Supplier::find()->all(), 'id', 'name');
        $supps["0"] = '-- No supplier --';
        echo $form->field($model, 'supplier')->dropDownList($supps); ?>
        <?= $form->field($model, 'sales_commision')->widget(CommissionSelector::class, ['type_attr' => 'sales_commision_type']) ?>
        <?php
        $cnvs = ArrayHelper::map(Canvasser::find()->all(), 'id', 'name');
        $cnvs["0"] = '-- No canvasser --';
        echo $form->field($model, 'canvassed')->dropDownList($cnvs);
        ?>
        <?= $form->field($model, 'canvassing_commision')->widget(CommissionSelector::class, ['type_attr' => 'canvassing_commision_type']) ?>

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
