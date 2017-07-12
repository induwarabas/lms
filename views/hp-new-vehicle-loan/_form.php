<?php

use app\models\CollectionMethod;
use app\models\LoanType;
use app\utils\widgets\CustomerSelector;
use app\utils\widgets\StaticField;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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

    <?php $form = ActiveForm::begin(['id'=>'hp']); ?>
    <?= Html::hiddenInput("action", "submit") ?>
    <?= $form->field($loan, 'type')->widget(StaticField::className(), ['text' => LoanType::findOne(['id' => $loan->type])->name]) ?>

    <?= $form->field($loan, 'customer_id')->widget(CustomerSelector::className(), ['form' => 'hp',
        'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Applicant']), 'customer' => $applicant]) ?>

    <?= $form->field($loan, 'guarantor_1')->widget(CustomerSelector::className(), ['form' => 'hp',
        'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 1']),
        'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 1']), 'customer' => $guarantor1]) ?>

    <?= $form->field($loan, 'guarantor_2')->widget(CustomerSelector::className(), ['form' => 'hp',
        'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 2']), 'customer' => $guarantor2]) ?>

    <?= $form->field($loan, 'guarantor_3')->widget(CustomerSelector::className(), ['form' => 'hp',
        'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 3']), 'customer' => $guarantor3]) ?>


    <?= $form->field($loan, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($loan, 'interest')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($loan, 'penalty')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($loan, 'charges')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

    <?= $form->field($loan, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>

    <?= $form->field($loan, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>

    <?= $form->field($model, 'vehicle_type')->textInput() ?>

    <?= $form->field($model, 'vehicle_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chasis_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loan_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_commision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'canvassed')->textInput() ?>

    <?= $form->field($model, 'canvassing_commision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insurance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a("Go", "#", ['id' => 'brr'])?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
    $this->registerJs('
    $( "#brr" ).click(function() {
        var datastring = $("#hp").serializeArray();
        $.post("index.php?r=hp-new-vehicle-loan%2Fset-applicant", $.param(datastring), function(data) {
        
        });
    });
    ');

    ?>
</div>
