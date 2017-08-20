<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Collection */

$this->title = Yii::t('app', 'Create Collection');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
