<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */

$this->title = 'Update Hp New Vehicle Loan: ' . $loan->id;
$this->params['breadcrumbs'][] = ['label' => 'Daily Collection Loan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $loan->id, 'url' => ['view', 'id' => $loan->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hp-new-vehicle-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formx', [
        'loan' => $loan,
        'applicant' => $applicant,
        'guarantor1' => $guarantor1,
        'guarantor2' => $guarantor2,
        'guarantor3' => $guarantor3,
    ]) ?>

</div>
