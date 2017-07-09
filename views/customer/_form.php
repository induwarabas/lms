<?php

use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $spouse app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nic')->textInput(['maxlength' => true, "readonly" => true, "style" => 'text-color: black;']) ?>
    <?= $form->field($model, 'gender')->textInput(['maxlength' => true, "readonly" => true]) ?>
    <?= $form->field($model, 'dob')->textInput(['maxlength' => true, "readonly" => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->dropDownList(ArrayHelper::map(Area::find()->all(), 'id', 'name'))  ?>

    <?= $form->field($model, 'residential_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'billing_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'work_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fixed_salary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other_incomes')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'ui button green' : 'ui button blue']) ?>
        <?php
        if ($spouse != null){
            echo Html::a('Cancel' , Yii::$app->getUrlManager()->createUrl(["customer/view", "id" => $spouse->id]), ['class' => 'ui button']);
        } else if (!$model->isNewRecord) {
            echo Html::a('Cancel' , Yii::$app->getUrlManager()->createUrl(["customer/view", "id" => $model->id]), ['class' => 'ui button']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
