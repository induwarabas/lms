<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residential_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'billing_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'work_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fixed_salary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_incomes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spouse_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
