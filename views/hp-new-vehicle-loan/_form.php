<?php

use app\models\CollectionMethod;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\widgets\CustomerSelector;
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
    <div class="ui segment">
        <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Manage customer details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($loan, 'customer_id')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Applicant']), 'customer' => $applicant]) ?>

        <?= $form->field($loan, 'guarantor_1')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 1']),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 1']), 'customer' => $guarantor1]) ?>

        <?= $form->field($loan, 'guarantor_2')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 2']),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 2']), 'customer' => $guarantor2]) ?>

        <?= $form->field($loan, 'guarantor_3')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 3']),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 3']), 'customer' => $guarantor3]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('truck') . '<div class="content">Vehicle Details<div class="sub header">Manage vehicle details.</div></div>', ['tag' => 'h2']) ?>
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
        <?= $form->field($loan, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>
        <?= $form->field($loan, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>
    </div>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('briefcase') . '<div class="content">Charges<div class="sub header">Manage charges details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'supplier')->textInput() ?>
        <?= $form->field($model, 'sales_commision')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'canvassed')->textInput() ?>
        <?= $form->field($model, 'canvassing_commision')->textInput(['maxlength' => true]) ?>

    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
