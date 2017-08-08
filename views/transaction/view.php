<?php

use app\utils\widgets\AccountIDView;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'View Transaction';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;min-width: 150px">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'txid',
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;min-width: 150px">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            ['attribute' => 'dr_account', 'format' => 'html', 'value' => AccountIDView::widget(['accountId' => $model->dr_account, 'balance' => false])],
            ['attribute' => 'dr_account', 'label' => 'Debit Name', 'format' => 'html', 'value' => \app\models\Account::findOne($model->dr_account)->getAccountName()],
            ['attribute' => 'dr_balance', 'format' => 'html', 'value' => function ($data) {
                if ($data->dr_balance < 0) {
                    return number_format(-$data->dr_balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($data->dr_balance, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
            }],
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;min-width: 150px">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            ['attribute' => 'cr_account', 'format' => 'html', 'value' => AccountIDView::widget(['accountId' => $model->cr_account, 'balance' => false])],
            ['attribute' => 'cr_account', 'format' => 'html', 'label' => 'Credit Name', 'value' => \app\models\Account::findOne($model->cr_account)->getAccountName()],
            ['attribute' => 'cr_balance', 'format' => 'html', 'value' => function ($data) {
                if ($data->cr_balance < 0) {
                    return number_format(-$data->cr_balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($data->cr_balance, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
            }],
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;min-width: 150px">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'timestamp',
            'type',
            'payment',
            'cheque',
            ['attribute' => 'amount', 'value' => number_format($model->amount, 2)],
            'description',
        ],
    ]) ?>
</div>
