<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'saving_account') ?>

    <?= $form->field($model, 'loan_account') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'collection_method') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'disbursed_date') ?>

    <?php // echo $form->field($model, 'closed_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
