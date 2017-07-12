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

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'ui button green']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'ui button']) ?>
    <?php ActiveForm::end(); ?>

</div>
