<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TellerReceipt */

$this->title = 'Loan Receipt';
$this->params['breadcrumbs'][] = ['label' => 'Teller', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="supplier-form">

        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

        <?= $form->field($model, 'loanId')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <?= Html::submitButton('Receipt', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
