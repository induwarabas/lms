<?php

use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['createnic'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'name', 'content' => function($data){return Html::a($data->name, ['view', 'id' => $data->id]);}],
            ['attribute' => 'area', 'content' => function($data){return Area::findOne(['id' => $data->area])->name;}, 'filter'=>array_merge(['0'=>'All'], ArrayHelper::map(Area::find()->asArray()->all(), 'id', 'name')),],
            'nic',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>