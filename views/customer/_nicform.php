<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $spouse app\models\Customer */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nic')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?php
        if ($spouse != null){
            echo Html::a('Cancel' , Yii::$app->getUrlManager()->createUrl(["customer/view", "id" => $spouse->id]), ['class' => 'ui button']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
