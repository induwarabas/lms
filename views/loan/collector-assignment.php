<?php

use app\models\Collector;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CollectorAssignmentModel */

$this->title = 'Assign Collector';
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="loan-form">

        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

        <?= $form->field($model, 'collector')->dropDownList(ArrayHelper::map(Collector::find()->all(), 'id', 'name')) ?>

        <?= $form->field($model, 'loans')->textarea(['rows' => 20]) ?>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <?= Html::submitButton('Assign', ['class' => 'ui button green']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

</div>
