<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeneralAccount */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'General Account',
    ]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'General Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="general-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
