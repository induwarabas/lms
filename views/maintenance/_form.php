<?php

use dosamigos\datepicker\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <?= $form->field($model, 'date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>


    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton('Start', ['class' => 'ui button green']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
