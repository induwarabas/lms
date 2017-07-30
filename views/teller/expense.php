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
/* @var $title string */

$this->title = $title;
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
        <?php if ($model->stage == 1) { ?>
            <tr>
                <td style="width: 1%;white-space:nowrap;">Amount</td>
                <td><?= number_format($model->amount, 2) ?></td>
            </tr>
            <tr>
                <td style="width: 1%;white-space:nowrap;">Description</td>
                <td><?= $model->description ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($model->stage != 1) { ?>
        <div class="supplier-form">

            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Pay', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    <?php } ?>
</div>
