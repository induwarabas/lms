<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Canvasser */

$this->title = 'Create Canvasser';
$this->params['breadcrumbs'][] = ['label' => 'Canvassers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canvasser-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
