<?php

use app\models\CollectionMethod;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $error string */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <?= Html::a('Disburse', ['disburse', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to disburse this item?',
            'method' => 'post',
        ],
    ]) ?>
    <?php
    if ($error != null && $error != '') {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-info',
            ],
            'body' => $error,
        ]);
    }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'customer_id',
            'saving_account',
            'loan_account',
            'amount',
            'interest',
            'penalty',
            'charges',
            ['attribute' => 'collection_method', 'value' => CollectionMethod::findOne(['id' => $model->collection_method])->name],
            'period',
            'status',
            'disbursed_date',
            'closed_date',
            'installment',
            'total_interest',
            'total_payment',
        ],
    ]) ?>

</div>
