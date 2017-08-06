<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $spouse app\models\Customer */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <?= $form->field($model, 'nic')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton('Create', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
            <?php
            if ($spouse != null) {
                echo Html::a('Cancel', Yii::$app->getUrlManager()->createUrl(["customer/view", "id" => $spouse->id]), ['class' => 'ui button']);
            }
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
