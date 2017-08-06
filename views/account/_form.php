<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(['SAVING' => 'SAVING', 'LOAN' => 'LOAN', 'SUPPLIER' => 'SUPPLIER', 'CANVASSER' => 'CANVASSER', 'BANK' => 'BANK', 'TELLER' => 'TELLER', 'GENERAL' => 'GENERAL',], ['prompt' => '']) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protection')->dropDownList(['NONE' => 'NONE', 'PLUS' => 'PLUS', 'MINUS' => 'MINUS', '' => '',], ['prompt' => '']) ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
