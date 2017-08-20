<?php

use app\models\Area;
use app\utils\DbUtils;
use app\utils\NICValidator;
use app\utils\PhoneNoFormatter;
use yii\helpers\Html;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $loan_req string */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if ($loan_req != null) {
            echo Html::a('Set as ' . $loan_req, ['loan/customer', 'id' => $model->id, 'type' => $loan_req], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><td style="width: 1%;white-space:nowrap;">{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'id',
            ['attribute' => 'nic', 'value' => function ($data) {
                return NICValidator::formatNicNo($data->nic);
            }],
            'full_name',
            'name',
            'dob',
            'gender',
            ['attribute' => 'area', 'value' => Area::findOne(['id' => $model->area])->name],
            'residential_address:ntext',
            'billing_address:ntext',
            ['attribute' => 'phone', 'format' => 'html', 'value' => function ($data) {
                return PhoneNoFormatter::format($data->phone);
            }],
            ['attribute' => 'mobile', 'format' => 'html', 'value' => function ($data) {
                return PhoneNoFormatter::format($data->mobile);
            }],
            'email:email',
            'occupation',
            'work_address:ntext',
            ['attribute' => 'work_phone', 'format' => 'html', 'value' => function ($data) {
                return PhoneNoFormatter::format($data->work_phone);
            }],
            'work_email:email',
            'fixed_salary',
            'other_incomes',
            'spouse_id',
            ['attribute' => 'spouse_id', 'format' => 'html', 'value' => function ($data) {
                $spouse = DbUtils::getCustomerNameAndNicById($data->spouse_id);
                if ($spouse != null) {
                    return Html::a($spouse, ['view', 'id' => $data->spouse_id]) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . Html::a('Remove' . Elements::icon('delete'), ['removespouse', 'id' => $data->id], ['class' => 'ui button red right labeled icon ']);
                } else {
                    return Html::a("Set", ['createnic', 'spouse' => $data->id], ['class' => 'ui button blue']);
                }
            }],
        ],
    ]) ?>

</div>
