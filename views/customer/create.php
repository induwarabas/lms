<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $spouse app\models\Customer */

$this->title = 'Create Customer';
$spouseData = "";
if ($spouse !== null) {
    $this->title = 'Create Spouse';
    $spouseData = " : ". $spouse->name." (".$spouse->nic.")";
}

$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) .$spouseData ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'spouse' => $spouse
    ]) ?>

</div>
