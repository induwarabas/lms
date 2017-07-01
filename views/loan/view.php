<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-view">

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
            'customer_id',
            'saving_account',
            'loan_account',
            'amount',
            'collection_method',
            'period',
            'status',
            'disbursed_date',
            'closed_date',
        ],
    ]) ?>

</div>
