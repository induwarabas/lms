<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
//use yii\
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
/* @var $schedule app\models\LoanSchedule*/


$this->title = 'Reschedule loan';
$this->params['breadcrumbs'][] = ['label' => 'Loan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
;
?>
<div class="reschedule">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($loan, 'id')->hiddenInput()->label(false); ?>

    <div class="ui segment">
        <?= $form->field($loan, 'disbursed_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']])->label("Start Date") ?>
    </div>

    <div class="form-group">

        <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton( 'Update', ['class' => 'ui button green' ]); ?>
            <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']); ?>
        </div>
    </div>

    <?php ActiveForm::end();?>
</div>

