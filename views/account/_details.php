<?php

use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $details \app\utils\AccountDetails */
?>

<table border="0" width="100%" class="ui table">
    <tr>
        <th style="width: 1%;white-space:nowrap;">Account ID</th>
        <td><?= $details->account->id ?></td>
        <th style="width: 1%;white-space:nowrap;">Type</th>
        <td><?= $details->account->type ?></td>
    </tr>
    <tr>
        <th style="width: 1%;white-space:nowrap;">Account Name</th>
        <td><?php
            if ($details->nameUrl == null) {
                echo $details->name;
            } else {
                echo Html::a($details->name, $details->nameUrl);
            }
            ?>
        </td>
        <th rowspan="3" style="width: 1%;white-space:nowrap;padding-top: 15px;">
            <h2>Balance</h2>
        </th>
        <td rowspan="3" style="width: 1%;white-space:nowrap;"><?php
            if ($details->account->balance >= 0) {
                $parts = explode('.', number_format($details->account->balance, 2));
                echo '<span style="font-size: xx-large">' . $parts[0] . '.' . '</span>' . '<span style="font-size: x-large">' . $parts[1] . Elements::icon('plus square', ['class' => 'green']) . '</span>';
            } else {
                $parts = explode('.', number_format(-$details->account->balance, 2));
                echo '<span style="font-size: xx-large">' . $parts[0] . '.' . '</span>' . '<span style="font-size: x-large">' . $parts[1] . Elements::icon('minus square', ['class' => 'red']) . '</span>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th style="width: 1%;white-space:nowrap;"><?= $details->descriptionTitle ?></th>
        <td><?php
            if ($details->descriptionUrl == null) {
                echo $details->description;
            } else {
                echo Html::a($details->description, $details->descriptionUrl);
            }
            ?>
        </td>
    </tr>
</table>
