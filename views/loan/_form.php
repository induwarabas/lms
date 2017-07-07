<?php

use app\models\CollectionMethod;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use \app\models\LoanType;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\helpers\Size;
use Zelenin\yii\SemanticUI\modules\Modal;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map(LoanType::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'interest')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'penalty')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>
    <?= $form->field($model, 'charges')->textInput(['type' => 'number', 'maxlength' => true, 'step' => '0.01']) ?>

    <?= $form->field($model, 'collection_method')->dropDownList(ArrayHelper::map(CollectionMethod::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'period')->textInput(['type' => 'number', 'step' => '1']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'], ["onclick" => 'jQuery("#w0").modal("show");']) ?>

    <?php $modal = Modal::begin([
        'size' => Size::LARGE,
        'header' => 'Profile Picture',
        'actions' =>Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']).Elements::button('Nope', ['class' => 'teal right labeled icon'])
    ]); ?>
    <?= Elements::image('/images/image.png', ['class' => 'medium']) ?>
    <div class="description">
        <?= Elements::header('We\'ve auto-chosen a profile image for you') ?>
        <p>We've grabbed the following image from the <a target="_blank" href="https://www.gravatar.com">gravatar</a> image
            associated with your registered e-mail address.</p>

        <p>Is it okay to use this photo?</p>
    </div>
    <?php $modal::end(); ?>

    <?= $modal->renderToggleButton("FRS". Elements::icon('checkmark'), ['class' => 'violet right labeled icon']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
