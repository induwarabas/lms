<?php

use app\utils\Doubles;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $details \app\utils\AccountDetails */

$this->title = 'Recent 10 Transactions';
if ($history != null) {
    $this->title = 'Transaction history';
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $this->render('_details', [
        'details' => $details,
    ]) ?>
    <?php
    if ($history != null) {
        echo $this->render('_search', [
            'history' => $history,
            'id' => $details->account->id
        ]);
    } ?>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            $options = ['id' => $model['txid'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['transaction/view', 'id' => $model['txid']]) . '";'];
            if ($model['reverted'] != 0) {
                $options['style'] = 'font-style: italic;color: gray';
            }
            return $options;
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            'txid',
            'timestamp',
            'type',
            'payment',
            'description',
            ['attribute' => 'amount', 'format' => 'html', 'value' => function ($data) use ($details) {
                if ($data->dr_account === $details->account->id) {
                    return number_format($data->amount, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($data->amount, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
            }, 'contentOptions' => function ($data) {
                if ($data->reverted != 0) return array('style' => 'text-decoration: line-through;text-align: right;');
                else return array('style' => 'text-align: right;');
            }],
            ['attribute' => 'amount', 'label' => 'Balance', 'format' => 'html', 'value' => function ($data) use ($details) {
                if ($data->dr_account === $details->account->id) {
                    if (Doubles::compare($data->dr_balance, 0.0) < 0) {
                        return number_format(-$data->dr_balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                    } else {
                        return number_format($data->dr_balance, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                    }
                } else {
                    if (Doubles::compare($data->cr_balance, 0.0) < 0) {
                        return number_format(-$data->cr_balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                    } else {
                        return number_format($data->cr_balance, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                    }
                }
            }, 'contentOptions' => function ($data) {
                if ($data->reverted != 0) return array('style' => 'text-decoration: line-through;text-align: right;');
                else return array('style' => 'text-align: right;');
            }],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    <p align="right">
        <?php
        if ($history != null) {
            echo Html::a('View Recent', ['ledger', 'id' => $details->account->id], ['class' => 'ui button blue']);
        } else {
            echo "<br/>";
            echo Html::a('View History', ['history', 'id' => $details->account->id], ['class' => 'ui button blue']);
        } ?>
    </p>
</div>
