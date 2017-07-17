<?php

use app\utils\enums\LoanStatus;
use app\utils\PhoneNoFormatter;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'account',
            ['attribute' =>'status', 'format' => 'html', 'value' => function($data){ return LoanStatus::label($data->status);}],
            'contact',
            'address:ntext',
            ['attribute'=>'phone', 'value'=> function($data) {return PhoneNoFormatter::format($data->phone);}],
            ['attribute'=>'mobile', 'value'=> function($data) {return PhoneNoFormatter::format($data->mobile);}],
            'email:email',
            'bank',
            'bank_account',
        ],
    ]) ?>

</div>
