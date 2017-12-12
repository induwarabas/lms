<?php

use app\models\Account;
use app\models\LoanType;
use app\utils\enums\LoanScheduleStatus;
use app\utils\enums\PaymentType;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CustomerView;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;


/* @var $this yii\web\View */
/* @var $model app\models\LoanSettlement */
/* @var $loan app\models\Loan */
/* @var $outstanding array */
/* @var $customer app\models\Customer */
/* @var $error string */

$this->title = 'Loan Settlement';
$this->params['breadcrumbs'][] = ['label' => 'Loan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ($error != null && $error != '') {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger',
            ],
            'body' => '<b>Error:</b> ' . $error,
        ]);
    }
    ?>

    <table class="ui definition table">
        <tbody>
        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Receipt No</td>
                <td><?= $model->txid ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Details</td>
            <td><?= Html::a("#" . $loan->id . " / " . LoanType::findOne($loan->type)->name, Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loan->id])) ?></td>
        </tr>
        <tr>
            <td>Loan Amount</td>
            <td><?= number_format($loan->amount, 2) ?></td>
        </tr>
        <tr>
            <td>Customer</td>
            <td><?= CustomerView::widget(['customer' => $customer, 'id' => $customer->id]) ?></td>
        </tr>
        <tr>
            <td>Saving Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->saving_account]) ?></td>
        </tr>
        <tr>
            <td>Loan Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->loan_account]) ?></td>
        </tr>
        <tr>
            <td>Principal</td>
            <td><?= number_format($outstanding["principal"], 2) ?></td>
        </tr>
        <tr>
            <td>Interest</td>
            <td><?= number_format($outstanding["interest"], 2) ?></td>
        </tr>
        <tr>
            <td>Charges</td>
            <td><?= number_format($outstanding["charges"], 2) ?></td>
        </tr>
        <tr>
            <td>Penalty</td>
            <td><?= number_format($outstanding["penalty"], 2) ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td><?= number_format($outstanding["total"], 2) ?></td>
        </tr>
        </tbody>
    </table>

    <?php if ($model->stage == 1) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'id' => 'receipt-form']); ?>

            <?= $form->field($model, 'loanId')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'principal')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'interest')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'charges')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'penalty')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?= Html::submitButton('Settle', ['class' => 'ui button blue']) ?>
                </div>
            </div>


            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>
