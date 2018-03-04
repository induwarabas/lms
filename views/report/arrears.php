<?php

use app\models\Area;
use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\LoanType;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\PhoneNoFormatter;
use app\utils\PopupWindow;
use app\utils\widgets\CustomerView;
use kartik\form\ActiveForm;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use Zelenin\yii\SemanticUI\Elements;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $total double */
/* @var $print boolean */
/* @var $searchModel \app\models\ArrearsSearch */

$this->title = 'Arrears report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (!$print) {
    $form = ActiveForm::begin([
        'action' => ['arrears'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE
    ]); ?>

    <?= $form->field($searchModel, 'type')->dropDownList(LoanTypes::getArrearsItem()) ?>

    <?= $form->field($searchModel, 'area')->dropDownList(['' => 'All'] + ArrayHelper::map(Area::find()->all(), 'id', 'name')) ?>
    <?= $form->field($searchModel, 'arrears')->textInput(['type' => 'number']) ?>

    <div class="form-group" align="right" style="padding-right: 20px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?= Elements::divider() ?>
        <p style="text-align: right">
            <?php
            echo Html::a("Print", '#', ['class' => 'ui button blue', 'onclick' => PopupWindow::show(Url::current(['print' => 'true']))]);
            ?>
        </p>
    <?php } else {
        $type = "All Loans";
        if ($searchModel->type == 100) {
            $type = "All Vehicle Loans";
        } else if ($searchModel->type != 0) {
            $type = LoanType::findOne($searchModel->type)->name;
        }
        $area = "All areas";
        if ($searchModel->area != 0) {
            $area = Area::findOne($searchModel->area)->name;
        }

        echo "<table>";
        echo "<tr><th>Loan Type</th><td>: ".$type."</td></tr>";
        echo "<tr><th>Area</th><td>: ".$area."</td></tr>";
        if ($searchModel->arrears > 0) {
            echo "<tr><th>Installments</th><td>: ".$searchModel->arrears." or more</td></tr>";
        }
        echo "</table>";
    } ?>
    <div style="text-align: right"><span style="font-size: xx-large">Total :</span>
        <?php
        $parts = explode('.', number_format($total, 2));
        echo '<span style="font-size: xx-large">' . $parts[0] . '.' . '</span>' . '<span style="font-size: x-large">' . $parts[1] . '</span>';
        ?>
    </div>
    <?php
    $gridOptions = [
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['loan/schedule', 'id' => $model['loan_id']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            ['attribute' => 'loan_id', 'label' => 'ID', 'contentOptions' => ['style' => 'max-width: 100px;'], 'headerOptions' => ['style' => 'max-width: 100px;'], 'filterOptions' => ['style' => 'max-width: 100px;']],
            //['attribute' => 'disbursed_date', 'label' => 'Date'],
            ['attribute' => 'type', 'content' => function ($data) {
                $details = "";
                if (LoanTypes::isVehicleLoan($data["type"])) {
                    $loanex = HpNewVehicleLoan::findOne($data["loan_id"]);
                    if ($loanex->vehicle_no != null && $loanex->vehicle_no != '') {
                        $details .= $loanex->vehicle_no;
                    } else {
                        if ($loanex->engine_no != null && $loanex->engine_no != '') {
                            $details .= $loanex->engine_no;
                        }
                        if ($loanex->chasis_no != null && $loanex->chasis_no != '') {
                            $details .= " / " . $loanex->chasis_no;
                        }
                    }
                    $details = "<br/>".$details;
                }
                return LoanType::findOne(['id' => $data["type"]])->name.$details;
            }],
            ['attribute' => 'id', 'label' => 'Customer', 'content' => function ($data) {
                return Html::a($data['name'], Url::to(['customer/view', 'id' => $data['id']])) . '<br/>' . str_replace("\n", "<br/>", $data['residential_address']);
            }],
            ['attribute' => 'id', 'label' => 'Contact', 'content' => function ($data) {
                return PhoneNoFormatter::formatAll($data['phone'], $data['mobile'], $data['work_phone']);
            }, 'contentOptions' => ['style' => 'white-space: nowrap']],
            ['attribute' => 'arrears', 'value' => function ($model) {
                return $model['arrears'].' /'.($model['arrears'] + $model['demanded']);
            }, 'contentOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'penalty', 'value' => function ($model) {
                return number_format($model['paid'] - $model['penalty'], 2);
            }, 'contentOptions' => ['style' => 'text-align: right;']],
            ['attribute' => 'balance', 'value' => function ($model) {
                return number_format($model['balance'], 2);
            }, 'contentOptions' => ['style' => 'text-align: right;']],
            // 'collection_method',
            // 'period',
            // 'status',
            // 'closed_date',
        ],
    ];
    if ($print) {
        $gridOptions['layout'] = '{items}';
    }
    ?>
    <?php Pjax::begin(); ?>    <?= GridView::widget($gridOptions); ?>
    <?php Pjax::end(); ?>
</div>
