<?php

use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\TellerPayment */

$this->title = 'Loan Payment';
$this->params['breadcrumbs'][] = ['label' => 'Teller', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="supplier-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'loanId')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Pay', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
