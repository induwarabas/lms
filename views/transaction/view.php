<?php

use app\models\Account;
use app\utils\enums\TxType;
use app\utils\widgets\AccountIDView;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\helpers\Size;
use Zelenin\yii\SemanticUI\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Transaction */

$this->title = 'View Transaction';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($model->reverted != 0) { ?>
        <h3>This transaction has been reverted
            by <?= Html::a("#" . $model->reverted, ['transaction/view', 'id' => $model->reverted]) ?>.</h3>
    <?php } ?>
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
    <div style="text-align: right">
        <?php if ($model->reverted == 0) { ?>
            <?php $modal = Modal::begin([
                'size' => Size::TINY,
                'header' => '<h2 style="text-align: left">Revert transaction</h2>',
                'toggleButton' => ['label' => 'Revert', 'class' => 'ui button red'],
                'footer' => Html::a("Revert", ['transaction/revert', 'id' => $model->txid], ['class' => 'ui button red']).Elements::button('Nope', ['class' => 'ui button default', 'data-dismiss' => 'modal'])

            ]); ?>
        <div style="text-align: left">
            <p class="description">Are you sure you want to revert this transaction?</p>
            <b>Note:</b> This action cannot be undone.
        </div>
            <?php $modal::end(); ?>
        <?php } ?>
        <?php if (($model->type == TxType::RECEIPT || $model->type == TxType::DOWN_PAYMENT) && substr($model->cr_account, 0, 1) == Account::getTypeId(Account::TYPE_SAVING)) {
            echo Html::a("Print Receipt", '#', ['class' => 'ui button blue', 'onClick' => "MyWindow=window.open('" . \yii\helpers\Url::to(['transaction/print-receipt', 'id' => $model->txid]) . "','MyWindow',width=700,height=300); return false;"]);
        } ?>
    </div>
</div>
