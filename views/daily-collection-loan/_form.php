<?php

use app\models\Canvasser;
use app\models\CollectionMethod;
use app\models\Supplier;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\widgets\CommissionSelector;
use app\utils\widgets\CustomerSelector;
use dosamigos\datepicker\DatePicker;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */
/* @var $form yii\widgets\ActiveForm */

$loanId = isset($loan->id) ? $loan->id : 0;
?>

    <div class="hp-new-vehicle-loan-form">

        <?php $form = ActiveForm::begin(['id' => 'hp', 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>
        <?= Html::hiddenInput("action", "submit") ?>
        <?= $form->field($loan, 'type')->hiddenInput()->label(false) ?>
        <?= $form->field($loan, 'id')->hiddenInput()->label(false) ?>
        <div class="ui segment">
            <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Manage customer details.</div></div>', ['tag' => 'h2']) ?>
            <?= Elements::divider() ?>
            <?= $form->field($loan, 'customer_id')->widget(CustomerSelector::className(), ['form' => 'hp',
                'url' => Yii::$app->urlManager->createUrl(["daily-collection-loan/set-customer", 'type' => 'Applicant', 'id' => $loanId]), 'customer' => $applicant, 'fullname' => true]) ?>

            <?= $form->field($loan, 'guarantor_1')->widget(CustomerSelector::className(), ['form' => 'hp',
                'url' => Yii::$app->urlManager->createUrl(["daily-collection-loan/set-customer", 'type' => 'Guarantor 1', 'id' => $loanId]),
                'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 1']), 'customer' => $guarantor1, 'fullname' => true]) ?>

            <?= $form->field($loan, 'guarantor_2')->widget(CustomerSelector::className(), ['form' => 'hp',
                'url' => Yii::$app->urlManager->createUrl(["daily-collection-loan/set-customer", 'type' => 'Guarantor 2', 'id' => $loanId]),
                'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 2']), 'customer' => $guarantor2, 'fullname' => true]) ?>

            <?= $form->field($loan, 'guarantor_3')->widget(CustomerSelector::className(), ['form' => 'hp',
                'url' => Yii::$app->urlManager->createUrl(["daily-collection-loan/set-customer", 'type' => 'Guarantor 3', 'id' => $loanId]),
                'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 3']), 'customer' => $guarantor3, 'fullname' => true]) ?>
        </div>

        <div class="ui segment">
            <?= Elements::header(Elements::icon('money') . '<div class="content">Loan Details<div class="sub header">Manage loan details.</div></div>', ['tag' => 'h2']) ?>
            <?= Elements::divider() ?>
            <?= $form->field($loan, 'amount')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '0.01']) ?>
            <?= $form->field($loan, 'interest')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '0.01']) ?>
            <?= $form->field($loan, 'period')->textInput(['type' => 'number', 'step' => '1'])->label("Months") ?>
            <?= $form->field($loan, 'disbursed_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']])->label("Start Date") ?>
            <?= $form->field($loan, 'penalty')->hiddenInput()->label(false) ?>
            <?= $form->field($loan, 'collection_method')->hiddenInput()->label(false) ?>
            <?= $form->field($loan, 'charges')->hiddenInput()->label(false) ?>
            <?= Elements::divider() ?>
            <div class="form-group field-loan-installment">
                <label class="control-label col-md-2" for="loan-installment">Days</label>
                <div class='col-md-10'>
                    <div id="days" style="margin-top: 6px;margin-left: 10px"></div>
                </div>
            </div>
            <div class="form-group field-loan-installment">
                <label class="control-label col-md-2" for="loan-installment">Interest</label>
                <div class='col-md-10'>
                    <div id="interest" style="margin-top: 6px;margin-left: 10px"></div>
                </div>
            </div>
            <div class="form-group field-loan-installment">
                <label class="control-label col-md-2" for="loan-installment">Total Payment</label>
                <div class='col-md-10'>
                    <div id="total-pay" style="margin-top: 6px;margin-left: 10px"></div>
                </div>
            </div>
            <div class="form-group field-loan-installment">
                <label class="control-label col-md-2" for="loan-installment">Installment</label>
                <div class='col-md-10'>
                    <div id="instal" style="margin-top: 6px;margin-left: 10px"></div>
                </div>
            </div>
            <div class="form-group field-loan-installment">
                <label class="control-label col-md-2" for="total-installment" style="font-size: x-large">Total</label>
                <div class='col-md-10'>
                    <div id="total-installment" style="margin-top: 6px;margin-left: 10px;font-size: x-large"></div>
                </div>
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
            <?= Html::submitButton($loan->isNewRecord ? 'Create' : 'Update', ['class' => $loan->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
            <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
<?php
$this->registerJs("
    function updateContents() {
        var months = parseInt($('#loan-period').val());
        var amount = parseFloat($('#loan-amount').val());
        var interest = parseFloat($('#loan-interest').val());
        var days = parseInt(months / 2) * 44 + (months % 2) * 21;
        var totalInterest = Math.floor(amount * interest * months) / 100;
        var totalPayment = (amount + totalInterest);
        var installment = totalPayment / days;
        
        $('#days').text(days); 
        $('#interest').text(amount.toFixed(2) + ' x ' + interest.toFixed(2) + ' x ' + months + ' / 100 = ' + totalInterest.toFixed(2)); 
        $('#total-pay').text(amount.toFixed(2) + ' + ' + totalInterest.toFixed(2) + ' = ' + totalPayment.toFixed(2)); 
        $('#instal').text(totalPayment.toFixed(2) + ' / ' + days + ' = ' + installment.toFixed(2)); 
        $('#total-installment').text(Math.ceil(installment).toFixed(2)); 
       /* var interest_percentage = $('#loan-interest').val();
        var terms = $('#loan-period').val();
        var interest_terms = 12;//$('#hpnewvehicleloan-loan_amount').val();
       
        //var chargePerTerm = Math.floor(100 * charges / terms) /100;
        var rate = interest_percentage / 100.0 / interest_terms;
        var part1 = Math.pow((1 + rate), terms);
        var part2 = amount * rate * part1;
        var part3 = part1 - 1;
        payment = Math.round(Math.floor(100 * (part2 / part3))) / 100;
           
        $('#instal').text(payment);    
        $('#total-installment').text(payment.toFixed(2) + ' + ' + commisionPerTerm.toFixed(2) + ' + ' + chargesPerTerm.toFixed(2) + ' = ' + (payment + commisionPerTerm + chargesPerTerm).toFixed(2));
        */
    }
    
    $('#loan-amount').on('input', function(e) {
        updateContents();
    });
    
    $('#loan-interest').on('input', function(e) {
        updateContents();
    });
    
    $('#loan-period').on('input', function(e) {
        updateContents();
    });
   
    updateContents();
");
?>