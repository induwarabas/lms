<?php

use app\models\Account;
use app\utils\enums\TxType;
use app\utils\widgets\AccountIDView;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $error string */

$this->title = 'Error';
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Alert::widget([
        'options' => [
            'class' => 'alert-danger',
        ],
        'body' => '<b>Error:</b> ' . $error,
    ]) ?>
</div>
