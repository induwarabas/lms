<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Collector */

$this->title = Yii::t('app', 'Create Collector');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collector-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
