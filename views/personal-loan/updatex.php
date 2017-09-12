<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalLoan */
/* @var $loan app\models\Loan */
/* @var $applicant app\models\Customer */
/* @var $guarantor1 app\models\Customer */
/* @var $guarantor2 app\models\Customer */
/* @var $guarantor3 app\models\Customer */

$this->title = 'Update Personal Loan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Personal Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formx', [
        'model' => $model,
        'loan' => $loan,
        'applicant' => $applicant,
        'guarantor1' => $guarantor1,
        'guarantor2' => $guarantor2,
        'guarantor3' => $guarantor3,
    ]) ?>

</div>
