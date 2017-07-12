<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VehicleBrand */

$this->title = 'Create Vehicle Brand';
$this->params['breadcrumbs'][] = ['label' => 'Vehicle Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vehicle-brand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
