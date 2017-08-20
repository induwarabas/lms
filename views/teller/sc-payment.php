<?php

use app\models\Account;
use app\models\BankAccount;
use app\utils\enums\PaymentType;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;


/* @var $this yii\web\View */
/* @var $model app\models\SalesCommisionPayment */
/* @var $supplier app\models\Supplier */
/* @var $error string */

$this->title = 'Sales Commission Payment';
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
            <td>Supplier</td>
            <td><?= SupplierView::widget(['supplier' => $supplier]) ?></td>
        </tr>
        <tr>
            <td>Debit Account</td>
            <td><?= AccountIDView::widget(['accountId' => $supplier->account]) ?></td>
        </tr>
        <?php if ($model->stage == 3) { ?>
            <tr>
                <td>Credit Account</td>
                <td><?= Account::findOne($model->crAccount)->getAccountHtml() ?></td>
            </tr>
        <?php } ?>

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

    <?php if ($model->stage == 2) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

            <?= $form->field($model, 'supplier')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

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
