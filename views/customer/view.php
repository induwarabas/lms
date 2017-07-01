<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

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
            'nic',
            'full_name',
            'name',
            'dob',
            'area',
            'residential_address:ntext',
            'billing_address:ntext',
            'phone',
            'mobile',
            'email:email',
            'occupation',
            'work_address:ntext',
            'work_phone',
            'work_email:email',
            'fixed_salary',
            'other_incomes',
            'spouse_id',
        ],
    ]) ?>

</div>
