<?php

use app\models\Account;
use app\models\BankAccount;
use app\utils\enums\PaymentType;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CustomerView;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;


/* @var $this yii\web\View */
/* @var $model app\models\TellerPayment */
/* @var $loan app\models\Loan */
/* @var $loanex app\models\HpNewVehicleLoan */
/* @var $customer app\models\Customer */
/* @var $details string */
/* @var $balance double */
/* @var $error string */
/* @var $chequeWriteTo string */

$this->title = 'Loan Payment';
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
            <td><?= CustomerView::widget(['customer' => $customer, 'id' => $customer->id]) ?></td>
        </tr>
        <tr>
            <td>Details</td>
            <td><?= Html::a($details, Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loan->id])) ?></td>
        </tr>
        <?php if ($loanex != null && \app\utils\Doubles::compare($loanex->down_payment, 0.0) != 0) { ?>
            <tr>
                <td>Loan Amount</td>
                <td><?= number_format($loanex->loan_amount, 2)?></td>
            </tr>
            <tr>
                <td>Down Payment</td>
                <td><?= number_format($loanex->down_payment, 2)?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Amount</td>
            <td><?php
                if ($loanex != null && \app\utils\Doubles::compare($loanex->down_payment, 0.0) != 0) {
                    echo number_format($model->amount, 2)." (Loan Amount + Down Payment)";
                } else {
                    echo number_format($model->amount, 2);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Debit Account</td>
            <td><?= Account::findOne($model->drAccount)->getAccountHtml() ?></td>
        </tr>
        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Credit Account</td>
                <td><?= Account::findOne($model->crAccount)->getAccountHtml() ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td>Saving Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->saving_account]) ?></td>
        </tr>
        <tr>
            <td>Loan Account</td>
            <td><?= AccountIDView::widget(['accountId' => $loan->loan_account]) ?></td>
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
            <?php if (PaymentType::needReference($model->payment)) { ?>
                <tr>
                    <td>Reference Number</td>
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
    <?= $chequeWriteTo ?>
    <?php if ($model->stage == 2) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

            <?= $form->field($model, 'drAccount')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'loanId')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'readonly' => true]) ?>

            <?= $form->field($model, 'payment')->dropDownList(PaymentType::getItems()) ?>
            <?= $form->field($model, 'cheque')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'bankAccount')->dropDownList(BankAccount::getBankAccItems()) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <?= Html::submitButton('Pay', ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>
