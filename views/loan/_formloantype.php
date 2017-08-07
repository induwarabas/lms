<?php

use app\models\LoanType;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(LoanType::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton('Create', ['class' => 'ui button green']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'ui button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
