<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HpNewVehicleLoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hp New Vehicle Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hp-new-vehicle-loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hp New Vehicle Loan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vehicle_type',
            'vehicle_no',
            'engine_no',
            'chasis_no',
            // 'model',
            // 'make',
            // 'supplier',
            // 'price',
            // 'loan_amount',
            // 'sales_commision',
            // 'canvassed',
            // 'canvassing_commision',
            // 'insurance',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
