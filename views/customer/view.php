<?php

use app\models\Area;
use app\models\Customer;
use app\models\LoanType;
use app\utils\DbUtils;
use app\utils\enums\LoanPaymentStatus;
use app\utils\enums\LoanStatus;
use app\utils\NICValidator;
use app\utils\PhoneNoFormatter;
use app\utils\widgets\CustomerView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;
use Zelenin\yii\SemanticUI\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $loans yii\data\ActiveDataProvider */
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

    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $loans,
        'filterModel' => $loansSearchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $model['id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            ['attribute' => 'id', 'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']],
            ['attribute' => 'type', 'content' => function ($data) {
                return LoanType::findOne(['id' => $data->type])->name;
            }, 'filter' => ArrayHelper::map(LoanType::find()->asArray()->all(), 'id', 'name'),
                'contentOptions' => ['style' => 'max-width: 140px;'], 'headerOptions' => ['style' => 'max-width: 140px;'], 'filterOptions' => ['style' => 'max-width: 140px;']],
            ['attribute' => 'customer_id', 'content' => function ($data) {
                return CustomerView::widget(['customer' => Customer::findOne(['id' => $data->customer_id]), 'fullname' => false]);
            }],
            ['attribute' => 'guarantor_1', 'label' => 'Participation','content' => function ($data) use ($model) {
                if ($model->id == $data->customer_id) {
                    return Elements::label("CUSTOMER", ['class' => 'green']);
                }
                return  Elements::label("GUARANTOR", ['class' => 'blue']);
            }, 'filter'=>['CUSTOMER' => 'CUSTOMER', 'GUARANTOR' => 'GUARANTOR'],
                'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']],
            'amount',
            ['attribute' => 'status', 'format' => 'html', 'value' => function ($data) {
                return LoanStatus::label($data->status);
            }, 'filter'=>['PENDING' => 'PENDING', 'ACTIVE' => 'ACTIVE','COMPLETED' => 'COMPLETED', 'CLOSED' => 'CLOSED'],
                'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']],
            ['attribute' => 'payment_status', 'format' => 'html', 'value' => function ($data) {
                return LoanPaymentStatus::label($data->payment_status);
            }, 'filter'=>['DONE' => 'DONE', 'DEMANDED' => 'DEMANDED','ARREARS' => 'ARREARS'],
                'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']]

            // 'collection_method',
            // 'period',
            // 'status',
            // 'disbursed_date',
            // 'closed_date',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
