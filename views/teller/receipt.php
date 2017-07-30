<?php

use app\utils\enums\PaymentType;
use app\utils\widgets\CustomerView;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\TellerReceipt */
/* @var $loan app\models\Loan */
/* @var $customer app\models\Customer */
/* @var $details string */
/* @var $balance double */
/* @var $error string */

$this->title = 'Loan Receipt';
$this->params['breadcrumbs'][] = ['label' => 'Teller', 'url' => ['index']];
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
        <tr>
            <td>Customer</td>
            <td><?= CustomerView::widget(['customer' => $customer, 'id' => $customer->id, 'target' => '_blank']) ?></td>
        </tr>
        <tr>
            <td>Details</td>
            <td><?= Html::a($details, Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loan->id]), ['target' => '_blank']) ?></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td><?= number_format($loan->amount, 2) ?></td>
        </tr>
        <tr>
            <td>Saving Account</td>
            <td><?= Html::a($loan->saving_account, Yii::$app->getUrlManager()->createUrl(['account/ledger', 'id' => $loan->saving_account]), ['target' => '_blank']) ?></td>
        </tr>
        <tr>
            <td>Loan Account</td>
            <td><?= Html::a($loan->loan_account, Yii::$app->getUrlManager()->createUrl(['account/ledger', 'id' => $loan->loan_account]), ['target' => '_blank']) ?></td>
        </tr>
        <tr>
            <td>Balance</td>
            <td>
                <?php
                if ($balance < 0) {
                    echo number_format(-$balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    echo number_format($balance, 2) . ' ' . Elements::icon('plus square', ['class' => 'green']);
                }
                ?>
            </td>
        </tr>

        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Payment type</td>
                <td><?= $model->payment ?></td>
            </tr>
            <?php if ($model->payment == PaymentType::CHEQUE) { ?>
                <tr>
                    <td>Cheque number</td>
                    <td><?= $model->cheque ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td>Amount Payed</td>
                <td><?= number_format($model->amount, 2) ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><?= $model->description ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($model->stage == 2) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'loanId')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'payment')->dropDownList(['CASH' => 'CASH', 'CHEQUE' => 'CHEQUE']) ?>
            <?= $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Receipt', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>