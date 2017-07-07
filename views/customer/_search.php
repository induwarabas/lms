<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nic') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'residential_address') ?>

    <?php // echo $form->field($model, 'billing_address') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'work_address') ?>

    <?php // echo $form->field($model, 'work_phone') ?>

    <?php // echo $form->field($model, 'work_email') ?>

    <?php // echo $form->field($model, 'fixed_salary') ?>

    <?php // echo $form->field($model, 'other_incomes') ?>

    <?php // echo $form->field($model, 'spouse_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
