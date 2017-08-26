<?php

use app\models\Account;
use app\utils\enums\LoanScheduleStatus;
use app\utils\enums\PaymentType;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CustomerView;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;


/* @var $this yii\web\View */
/* @var $model app\models\TellerReceipt */
/* @var $loan app\models\Loan */
/* @var $customer app\models\Customer */
/* @var $details string */
/* @var $balance double */
/* @var $error string */
/* @var $schedule \app\models\LoanSchedule */

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
        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Receipt No</td>
                <td><?= $model->txid ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Customer</td>
            <td><?= CustomerView::widget(['customer' => $customer, 'id' => $customer->id]) ?></td>
        </tr>
        <tr>
            <td>Details</td>
            <td><?= Html::a($details, Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loan->id])) ?></td>
        </tr>
        <tr>
            <td>Loan Amount</td>
            <td><?= number_format($loan->amount, 2) ?></td>
        </tr>
        <tr>
            <td>Saving Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->saving_account]) ?></td>
        </tr>
        <tr>
            <td>Installments Due</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->saving_account]) ?></td>
        </tr>
        <tr>
            <td>Loan Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->loan_account]) ?></td>
        </tr>
        <tr>
            <td>Loan Status</td>
            <td><?= LoanScheduleStatus::label($schedule->status). ' <span style="font-size: medium;font-weight: bold">('.$schedule->installment_id.')</span>' ?></td>
        </tr>
        <?php if ($schedule->status != 'PAYED') { ?>
        <tr>
            <td>Due</td>
            <td><?= number_format($schedule->principal, 2) . " + "
                .number_format($schedule->interest, 2) . " + "
                . number_format($schedule->charges, 2) . " + "
                . number_format($schedule->penalty, 2) . " - "
                . number_format($schedule->paid, 2) . " = "
                . '<span style="font-size: large;font-weight: bold">'.number_format($schedule->due, 2).'</span>' ?>
            <br/>
                (Principal + Interest + Charges + Penalty - Recovered = Due Amount)
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td>Balance Due</td>
            <td><?= number_format($schedule->due, 2) ." - ".number_format(Account::findOne($loan->saving_account)->balance, 2) . " = " ?>
                <?php
                echo '<span style="font-size: large;font-weight: bold">';
                if ($balance < 0) {
                    echo number_format(-$balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    echo number_format($balance, 2) . ' ' . Elements::icon('plus square', ['class' => 'green']);
                }
                echo '</span>';
                ?>
                <br/>
                (Due - Account Balance = Balance Due)
            </td>
        </tr>

        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Payment type</td>
                <td><?= $model->payment ?></td>
            </tr>
            <?php if (PaymentType::needReference($model->payment)) { ?>
                <tr>
                    <td>Reference number</td>
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
            <tr>
                <td>User</td>
                <td><?= $model->user ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php if ($model->stage == 3) {
        echo '<div style="text-align: right">';
        echo Html::a("Print Receipt", '#', ['class' => 'ui button blue', 'onClick' => "MyWindow=window.open('".\yii\helpers\Url::to(['transaction/print-receipt', 'id' => $model->txid])."','MyWindow',width=700,height=300); return false;"]);
        echo '</div>';
    } ?>
    <?php if ($model->stage == 2) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

            <?= $form->field($model, 'loanId')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'payment')->dropDownList(PaymentType::getTellerItems()) ?>
            <?= $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?= Html::submitButton('Receipt', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>
