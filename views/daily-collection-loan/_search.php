<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hp-new-vehicle-loan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vehicle_type') ?>

    <?= $form->field($model, 'vehicle_no') ?>

    <?= $form->field($model, 'engine_no') ?>

    <?= $form->field($model, 'chasis_no') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'make') ?>

    <?php // echo $form->field($model, 'supplier') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'loan_amount') ?>

    <?php // echo $form->field($model, 'sales_commision') ?>

    <?php // echo $form->field($model, 'canvassed') ?>

    <?php // echo $form->field($model, 'canvassing_commision') ?>

    <?php // echo $form->field($model, 'insurance') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
