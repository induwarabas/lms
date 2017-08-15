<?php

use yii\bootstrap\Progress;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $accounts array */
/* @var $date string */

$this->title = 'Day Start';
//$this->params['breadcrumbs'][] = ['label' => 'Areas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Day Start';
?>
<div class="day-start">

    <h1><?= Html::encode($this->title) ?></h1>
    <div id="prog">
    <?php
    echo Progress::widget([
        'percent' => 0,
        'barOptions' => ['class' => 'progress-bar-success'],
        'options' => ['class' => 'active progress-striped']
    ]);
    ?></div>
    <p align="center" style="font-size: xx-large" id="progx"></p>
</div>
<?php
$this->registerJs("
var loanIds = ['".implode("','", $accounts)."'];
var current = 0;
function processNext() {
    if (current >= loanIds.length) {
         $('#progx').html('Complete');
        return;
    }
    $.get( '".\yii\helpers\Url::to(['loan/recoverx'])."&id=' + loanIds[current], function( data, status ) {
        if (status == 'success' && data =='success') {
        $('#prog').html('<div id=\"w0\" class=\"active progress-striped progress\"><div class=\"progress-bar-success progress-bar\" role=\"progressbar\" aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:' + (current * 100 / loanIds.length) +'%\"><span class=\"sr-only\">70% Complete</span></div></div>');
        processNext();
        } else {
            alert('Error recovering loans');
            $('#progx').html('Error');
        }
    });
    ++current;
}
processNext();
");
?>