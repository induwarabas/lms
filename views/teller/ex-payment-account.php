<?php

use app\models\Canvasser;
use app\models\GeneralAccount;
use app\utils\enums\GeneralAccountTypes;
use app\utils\GeneralAccounts;
use kartik\form\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ExpenditurePayment */
/* @var $error string */

$this->title = 'Expenditure Payment';
$this->params['breadcrumbs'][] = ['label' => 'Teller', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canvasser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="canvasser-form">
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
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

        <?= $form->field($model, 'drAccount')->dropDownList(ArrayHelper::map(GeneralAccount::find()->where(["type" => GeneralAccountTypes::EXPENDITURE])->all(), "account_id", "name")) ?>
        <?= $form->field($model, 'stage')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'link')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <?= Html::submitButton('Pay', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
