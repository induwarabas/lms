<?php

use app\utils\enums\PaymentType;
use app\utils\widgets\CustomerView;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\ManualTransaction */

$this->title = 'Safe to bank';
$this->params['breadcrumbs'][] = ['label' => 'Teller', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ($model->error != null && $model->error != '') {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => '<b>Error:</b> ' . $model->error,
        ]);
    }
    ?>

    <?php if ($model->stage == 1) { ?>
        <?php $form = ActiveForm::begin(['id' => 'frmx']); ?>

        <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'cr_account')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'dr_account')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'bank_account')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'payment')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'cheque')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'amount')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'description')->hiddenInput()->label(false) ?>

        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
            'attributes' => [
                ['attribute' => 'cr_account', 'value' => $model->cr_account." : ".\app\models\Account::findOne($model->cr_account)->getAccountName()],
                ['attribute' => 'dr_account', 'value' => $model->dr_account." : ".\app\models\Account::findOne($model->dr_account)->getAccountName()],
                'payment',
                ['attribute' => 'amount', 'value' => number_format($model->amount, 2)],
                'description',
            ],
        ]) ?>

        <div class="form-group">
            <?= Html::a('Back', "#", ['class' => 'btn btn-success', 'id'=>'grr']) ?>
            <?= Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php } ?>

    <?php if ($model->stage == 0) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(['id' => 'frmx']); ?>

            <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'cr_account')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'dr_account')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'bank_account')->dropDownList(\app\models\BankAccount::getBankAccItems()) ?>
            <?= $form->field($model, 'payment')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'cheque')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>

<?php
$this->registerJs("
$('#grr').click(function(e){
    e.preventDefault();
    $('#manualtransaction-stage').val(4);
    $('#frmx').attr('action', '".\yii\helpers\Url::to(['transaction/safe-to-bank'])."').submit();
    
});
")
?>
