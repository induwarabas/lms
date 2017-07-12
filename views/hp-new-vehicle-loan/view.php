<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hp New Vehicle Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hp-new-vehicle-loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'vehicle_type',
            'vehicle_no',
            'engine_no',
            'chasis_no',
            'model',
            'make',
            'supplier',
            'price',
            'loan_amount',
            'sales_commision',
            'canvassed',
            'canvassing_commision',
            'insurance',
        ],
    ]) ?>

</div>
