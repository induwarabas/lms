<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'SAVING' => 'SAVING', 'LOAN' => 'LOAN', 'SUPPLIER' => 'SUPPLIER', 'CANVASSER' => 'CANVASSER', 'BANK' => 'BANK', 'TELLER' => 'TELLER', 'GENERAL' => 'GENERAL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protection')->dropDownList([ 'NONE' => 'NONE', 'PLUS' => 'PLUS', 'MINUS' => 'MINUS', '' => '', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
