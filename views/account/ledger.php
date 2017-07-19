<?php

use app\utils\widgets\TxAmountView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $accountId string */
/* @var $accountName string */
/* @var $accountNameUrl string */
/* @var $loanId integer */
/* @var $balance number */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<table border="0" width="100%" class="ui table">
    <tr><th style="width: 1%;white-space:nowrap;">Account ID</th><td><?= $accountId ?></td><th style="width: 1%;white-space:nowrap;">Type</th><td>SAVING</td></tr>
    <tr><th style="width: 1%;white-space:nowrap;">Account Name</th><td><?php
            if ($accountNameUrl == '') {
                echo $accountName;
            } else {
                echo Html::a($accountName, $accountNameUrl);
            }
            ?></td><th rowspan="3" style="width: 1%;white-space:nowrap;padding-top: 15px;"><h2>Balance</h2></th><td rowspan="3"><?php
                if ($balance >= 0) {
                    $parts = explode('.', number_format($balance,2));
                    echo '<span style="font-size: xx-large">'.$parts[0].'.'.'</span>'.'<span style="font-size: x-large">'.$parts[1].Elements::icon('plus square', ['class' => 'green']).'</span>';
                }else{
                    $parts = explode('.', number_format(-$balance,2));
                    echo '<span style="font-size: xx-large">'.$parts[0].'.'.'</span>'.'<span style="font-size: x-large">'.$parts[1].Elements::icon('minus square', ['class' => 'red']).'</span>';
                }
                 ?></td></tr>
    <tr><th style="width: 1%;white-space:nowrap;">Loan</th><td><?php
            if($loanId == 0) {
                echo "N/A";
            } else {
                echo Html::a("#".$loanId, Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loanId]));
            }
            ?></td></tr>
</table>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'timestamp',
            'type',
            'description',
            ['attribute' => 'amount', 'format' => 'html', 'value' => function($data) use ($accountId) {
                if ($data->cr_account === $accountId) {
                    return number_format($data->amount, 2).' '.Elements::icon('minus square', ['class' => 'red']);
                } else {
                    return number_format($data->amount, 2).' '.Elements::icon('add square', ['class' => 'green']);
                }
            },'contentOptions'=>array('style' => 'text-align: right;')],
            ['attribute' => 'amount','label' => 'Balance', 'format' => 'html', 'value' => function($data) use ($accountId) {
                if ($data->cr_account === $accountId) {
                    return  number_format($data->cr_balance, 2);
                } else {
                    return number_format($data->dr_balance, 2);
                }
            },'contentOptions'=>array('style' => 'text-align: right;')],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
