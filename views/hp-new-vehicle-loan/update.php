<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */

$this->title = 'Update Hp New Vehicle Loan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hp New Vehicle Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hp-new-vehicle-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
