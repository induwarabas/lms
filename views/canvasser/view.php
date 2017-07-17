<?php

use app\models\Bank;
use app\utils\enums\CanvasserStatus;
use app\utils\PhoneNoFormatter;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Canvasser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Canvassers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canvasser-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'ui button blue']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'name',
            'account',
            ['attribute' =>'status', 'format' => 'html', 'value' => function($data){ return CanvasserStatus::label($data->status);}],
            'address:ntext',
            ['attribute'=>'phone', 'value'=> function($data) {return PhoneNoFormatter::format($data->phone);}],
            ['attribute'=>'mobile', 'value'=> function($data) {return PhoneNoFormatter::format($data->mobile);}],
            'email:email',
            ['attribute'=>'bank', 'value'=> function($data) {return Bank::findOne($data->bank)->name;}],
            'bank_account_name',
            'bank_account',
        ],
    ]) ?>

</div>
