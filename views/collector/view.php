<?php

use app\models\Bank;
use app\utils\enums\CollectorStatus;
use app\utils\PhoneNoFormatter;
use app\utils\widgets\AccountIDView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Collector */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Collectors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collector-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'ui button blue']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'name',
            ['attribute' => 'account', 'format' => 'html', 'value' => AccountIDView::widget(['accountId' => $model->account])],
            ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                return CollectorStatus::label($data->status);
            }],
            'address:ntext',
            ['attribute' => 'phone', 'format' => 'html','value' => function ($data) {
                return PhoneNoFormatter::format($data->phone);
            }],
            ['attribute' => 'mobile', 'format' => 'html', 'value' => function ($data) {
                return PhoneNoFormatter::format($data->mobile);
            }],
            'email:email',
            ['attribute' => 'bank', 'value' => function ($data) {
                $bank = Bank::findOne($data->bank);
                return $bank != null ? $bank->name : '';
            }],
            'bank_account_name',
            'bank_account',
        ],
    ]) ?>

</div>
