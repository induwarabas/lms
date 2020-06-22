<?php

use yii\helpers\Html;
//use yii\
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Seize Vehicle';
$this->params['breadcrumbs'][] = ['label' => 'Loan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
;
?>
<div class="seize_panelty_form">
    <?php $form = ActiveForm::begin(); ?>
<!--    --><?//= Html::hiddenInput("action", "submit") ;?>
    <?= $form->field($loan, 'type')->hiddenInput()->label(false); ?>
    <?= $form->field($loan, 'id')->hiddenInput()->label(false); ?>

    <div class="ui segment">
        <?= $form ->field($model,'seize_panelty')->textInput(['maxlength' => true]); ?>
    </div>

    <div class="form-group">

        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton( 'Update', ['class' => 'ui button green' ]); ?>
            <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']); ?>
        </div>
    </div>

    <?php ActiveForm::end();?>
</div>

