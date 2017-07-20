<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['history'],
        'method' => 'get',
    ]);
    echo Html::hiddenInput('id', $id);
    ?>

    <table class="ui table">
        <tr>
            <td style="padding-right: 10px;padding-left: 40px;width: 1%;white-space:nowrap;">
                <div class="field field-from">
                    <label for="from">From</label>
                </div>
            </td>
            <td>
                <div class="field field-from">
                    <?= DatePicker::widget(['name' => 'from', 'value' => $history['from'],'clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
                </div>
            </td>
            <td style="padding-right: 10px;padding-left: 40px;width: 1%;white-space:nowrap;">
                <div class="field field-from">
                    <label for="to">To</label>
                </div>
            </td>
            <td>
                <div class="field field-from">
                    <?= DatePicker::widget(['name' => 'to', 'value' => $history['to'],'clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Filter', ['class' => 'ui button blue']) ?>
                </div>
            </td>
        </tr>
    </table>





    <?php ActiveForm::end(); ?>

</div>
