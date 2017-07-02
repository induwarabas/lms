<?php

use app\models\CollectionMethod;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\LoanType;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(LoanType::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'interest')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'penalty')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'charges')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

    <?= $form->field($model, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
