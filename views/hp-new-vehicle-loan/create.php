<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HpNewVehicleLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */

$this->title = 'Create Hp New Vehicle Loan';
$this->params['breadcrumbs'][] = ['label' => 'Hp New Vehicle Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hp-new-vehicle-loan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'loan' => $loan,
        'applicant' => $applicant,
        'guarantor1' => $guarantor1,
        'guarantor2' => $guarantor2,
        'guarantor3' => $guarantor3,
    ]) ?>

</div>
