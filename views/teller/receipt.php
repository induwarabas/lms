<?php

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
            <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

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
