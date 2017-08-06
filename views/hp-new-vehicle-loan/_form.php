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
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hp-new-vehicle-loan-form">

    <?php $form = ActiveForm::begin(['id' => 'hp','type' => ActiveForm::TYPE_HORIZONTAL,
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],]); ?>
    <?= Html::hiddenInput("action", "submit") ?>
    <?= $form->field($loan, 'type')->hiddenInput()->label(false) ?>
    <?= $form->field($loan, 'id')->hiddenInput()->label(false) ?>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('users') . '<div class="content">Customer Details<div class="sub header">Manage customer details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($loan, 'customer_id')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Applicant', 'id' => $model->id]), 'customer' => $applicant, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_1')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 1', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 1']), 'customer' => $guarantor1, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_2')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 2', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 2']), 'customer' => $guarantor2, 'fullname' => true]) ?>

        <?= $form->field($loan, 'guarantor_3')->widget(CustomerSelector::className(), ['form' => 'hp',
            'url' => Yii::$app->urlManager->createUrl(["hp-new-vehicle-loan/set-customer", 'type' => 'Guarantor 3', 'id' => $model->id]),
            'remove_url' => Yii::$app->urlManager->createUrl(["loan/remove-customer", 'type' => 'Guarantor 3']), 'customer' => $guarantor3, 'fullname' => true]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('car') . '<div class="content">Vehicle Details<div class="sub header">Manage vehicle details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'vehicle_type')->dropDownList(ArrayHelper::map(VehicleType::find()->all(), 'id', 'name')) ?>
        <?= $form->field($model, 'make')->dropDownList(ArrayHelper::map(VehicleBrand::find()->all(), 'id', 'name')) ?>
        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'engine_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'chasis_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'vehicle_no')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'insurance')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="ui segment">
        <?= Elements::header(Elements::icon('money') . '<div class="content">Loan Details<div class="sub header">Manage loan details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'loan_amount')->textInput(['maxlength' => true,'type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($loan, 'interest')->textInput(['maxlength' => true,'type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($loan, 'penalty')->textInput(['maxlength' => true,'type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($loan, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>
        <?= $form->field($loan, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>
        <?= $form->field($loan, 'disbursed_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']])->label("Start Date") ?>
        <?= $form->field($model, 'charges')->textInput(['maxlength' => true,'type' => 'number', 'step' => '0.01']) ?>
        <?= Elements::divider() ?>
        <div class="form-group field-loan-installment">
            <label class="control-label col-sm-3" for="loan-installment">Installment</label>
            <div class='col-sm-9'> <div id="instal" style="margin-top: 6px;margin-left: 10px"></div></div>
        </div>
        <div class="form-group field-loan-installment">
            <label class="control-label col-sm-3" for="total-commision">Commission</label>
            <div class='col-sm-9'> <div id="total-commision" style="margin-top: 6px;margin-left: 10px"></div></div>
        </div>
        <div class="form-group field-loan-installment">
            <label class="control-label col-sm-3" for="total-charges">Charges</label>
            <div class='col-sm-9'> <div id="total-charges" style="margin-top: 6px;margin-left: 10px"></div></div>
        </div>
        <div class="form-group field-loan-installment">
            <label class="control-label col-sm-3" for="total-installment" style="font-size: x-large">Total Installment</label>
            <div class='col-sm-9'> <div id="total-installment" style="margin-top: 6px;margin-left: 10px;font-size: x-large"></div></div>
        </div>

    </div>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('briefcase') . '<div class="content">Charges<div class="sub header">Manage charges details.</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?php
        $supps = ArrayHelper::map(Supplier::find()->all(), 'id', 'name');
        $supps["0"] = '-- No supplier --';
        echo $form->field($model, 'supplier')->dropDownList($supps); ?>
        <?= $form->field($model, 'sales_commision')->widget(CommissionSelector::class, ['type_attr' => 'sales_commision_type']) ?>
        <div class="form-group">
            <label class="control-label col-sm-3" for="sales-commision-amount">Sales Commission Amount</label>
            <div class='col-sm-9'> <div id="sales-commision-amount" style="margin-top: 6px;margin-left: 10px"></div></div>
        </div>
        <?= Elements::divider() ?>
        <?php
        $cnvs = ArrayHelper::map(Canvasser::find()->all(), 'id', 'name');
        $cnvs["0"] = '-- No canvasser --';
        echo $form->field($model, 'canvassed')->dropDownList($cnvs);
        ?>
        <?= $form->field($model, 'canvassing_commision')->widget(CommissionSelector::class, ['type_attr' => 'canvassing_commision_type']) ?>
        <div class="form-group">
            <label class="control-label col-sm-3" for="canvessing-commision-amount">Canvessing Commission Amount</label>
            <div class='col-sm-9'> <div id="canvessing-commision-amount" style="margin-top: 6px;margin-left: 10px"></div></div>
        </div>

    </div>
    <div class="ui segment">
        <?= Elements::header(Elements::icon('send') . '<div class="content">RMV<div class="sub header">RMV document tracking</div></div>', ['tag' => 'h2']) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'rmv_sent_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
        <?= $form->field($model, 'rmv_sent_agent')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'rmv_sent_by')->textInput(['maxlength' => true]) ?>
        <?= Elements::divider() ?>
        <?= $form->field($model, 'rmv_recv_date')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
        <?= $form->field($model, 'rmv_recv_agent')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'rmv_recv_by')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?= Html::a("Cancel", ["loan/cancel"], ['id' => 'cancel', 'class' => 'ui button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("  
    function updateContents() {
        var amount = $('#hpnewvehicleloan-loan_amount').val();
        var interest_percentage = $('#loan-interest').val();
        var terms = $('#loan-period').val();
        var interest_terms = 12;//$('#hpnewvehicleloan-loan_amount').val();
       
        //var chargePerTerm = Math.floor(100 * charges / terms) /100;
        var rate = interest_percentage / 100.0 / interest_terms;
        var part1 = Math.pow((1 + rate), terms);
        var part2 = amount * rate * part1;
        var part3 = part1 - 1;
        payment = Math.round(Math.floor(100 * (part2 / part3))) / 100;
        $('#instal').text(payment);
        
        var totalCommision = 0;
    
        if ($('#".Html::getInputId($model, 'sales_commision_type')."').val() == 'Percentage') {
            var amount = $('#hpnewvehicleloan-loan_amount').val();
            if (amount == '') {
                amount = 0;
            }
            var percentage = $('#".Html::getInputId($model, 'sales_commision')."').val();
            var commision = (amount * percentage / 100);
            $('#sales-commision-amount').text(amount + ' x ' + percentage + '% = ' + commision.toFixed(2));
            totalCommision += commision;
        } else {
            var commision = $('#".Html::getInputId($model, 'sales_commision')."').val();
            if (commision == '') {
                commision = 0;
            }
            $('#sales-commision-amount').text(commision);
            totalCommision += parseFloat(commision);
        }
        
        if ($('#".Html::getInputId($model, 'canvassing_commision_type')."').val() == 'Percentage') {
            var amount = $('#hpnewvehicleloan-loan_amount').val();
            if (amount == '') {
                amount = 0;
            }
            var percentage = $('#".Html::getInputId($model, 'canvassing_commision')."').val();
            var commision = (amount * percentage / 100);
            $('#canvessing-commision-amount').text(amount + ' x ' + percentage + '% = ' + commision.toFixed(2));
            totalCommision += commision;
        } else {
            var commision  = $('#".Html::getInputId($model, 'canvassing_commision')."').val();
            if (commision == '') {
                commision = 0;
            }
            $('#canvessing-commision-amount').text(commision);
            totalCommision += parseFloat(commision);
        }
        var commisionPerTerm = (totalCommision/terms);
         $('#total-commision').text(totalCommision + ' / ' + terms + ' = ' + (commisionPerTerm).toFixed(2));
         
         var charges = $('#hpnewvehicleloan-charges').val();
         if (charges == '') {
            charges = 0;
        }
         var chargesPerTerm = (charges/terms);
         $('#total-charges').text(charges + ' / ' + terms + ' = ' + (chargesPerTerm).toFixed(2));
         
         
         $('#total-installment').text(payment.toFixed(2) + ' + ' + commisionPerTerm.toFixed(2) + ' + ' + chargesPerTerm.toFixed(2) + ' = ' + (payment + commisionPerTerm + chargesPerTerm).toFixed(2));
    }
    
    $('#hpnewvehicleloan-loan_amount').on('input', function(e) {
        updateContents();
    });
    
    $('#hpnewvehicleloan-charges').on('input', function(e) {
        updateContents();
    });
    
    $('#loan-interest').on('input', function(e) {
        updateContents();
    });
    
    $('#loan-period').on('input', function(e) {
        updateContents();
    });
    
    $('#interest_terms').on('input', function(e) {
        updateContents();
    });
    
    $('#loan-collection_method').on('input', function(e) {
        updateContents();
    });
    
    $('#".Html::getInputId($model, 'sales_commision_type')."').on('input', function(e) {
        updateContents();
    });
    
    $('#".Html::getInputId($model, 'sales_commision')."').on('input', function(e) {
        updateContents();
    });
    
    $('#".Html::getInputId($model, 'canvassing_commision_type')."').on('input', function(e) {
        updateContents();
    });
    
    $('#".Html::getInputId($model, 'canvassing_commision')."').on('input', function(e) {
        updateContents();
    });
");
?>