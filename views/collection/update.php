<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Collection */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Collection',
]) . $model->loan_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loan_id, 'url' => ['view', 'loan_id' => $model->loan_id, 'date' => $model->date]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="collection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
