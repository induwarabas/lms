<?php

use app\models\Account;
use app\utils\Doubles;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeneralAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'General Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        echo Html::a(Yii::t('app', 'Create General Account'), ['create'], ['class' => 'btn btn-success']);
        ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['general-account/view', 'id' => $model['id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'account_id',
            ['attribute' => 'type', 'filter' => \app\utils\enums\GeneralAccountTypes::getAll()],
            'name',
            'description',
            ['attribute' => 'account_id', 'label' => 'Balance','format' => 'html', 'value' => function($data) {
                $account = Account::findOne($data->account_id);
                if ($account == null) {
                    return number_format(0.0, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
                if (Doubles::compare($account->balance, 0.0) < 0) {
                    return number_format(-$account->balance, 2) . ' ' . Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($account->balance, 2) . ' ' . Elements::icon('add square', ['class' => 'green']);
                }
            }, 'contentOptions' => ['style'=> 'text-align: right;white-space:nowrap;'], 'filter' => false],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
