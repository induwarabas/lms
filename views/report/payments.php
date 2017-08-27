<?php

use app\models\Area;
use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\LoanType;
use app\utils\enums\LoanStatus;
use app\utils\enums\LoanTypes;
use app\utils\enums\PaymentType;
use app\utils\PhoneNoFormatter;
use app\utils\PopupWindow;
use app\utils\widgets\CustomerView;
use dosamigos\datepicker\DatePicker;
use kartik\form\ActiveForm;
use webvimark\modules\UserManagement\models\User;
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
/* @var $searchModel \app\models\ReceiptSearch */

$this->title = 'Payments report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (!$print) {
    $form = ActiveForm::begin([
        //'action' => ['arrears'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE
    ]);
        $userQuery = User::find();
        if (!Yii::$app->user->isSuperadmin) {
            $userQuery->where(['superadmin' => 0]);
        }
        $users = $userQuery->all();
    ?>

    <?= $form->field($searchModel, 'type')->dropDownList(LoanTypes::getArrearsItem()) ?>
    <?= $form->field($searchModel, 'area')->dropDownList(['' => 'All'] + ArrayHelper::map(Area::find()->all(), 'id', 'name')) ?>
    <?= $form->field($searchModel, 'from')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
    <?= $form->field($searchModel, 'to')->widget(DatePicker::className(), ['clientOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd']]) ?>
    <?= $form->field($searchModel, 'teller')->dropDownList(['' => 'All'] + PaymentType::getItems())->label('Payment') ?>

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
        $type = null;
        if ($searchModel->type == 100) {
            $type = "All Vehicle Loans";
        } else if ($searchModel->type != 0) {
            $type = LoanType::findOne($searchModel->type)->name;
        }
        $area = null;
        if ($searchModel->area != 0) {
            $area = Area::findOne($searchModel->area)->name;
        }

        echo "<table>";
        if($type != null) {
            echo "<tr><th>Loan Type</th><td>: " . $type . "</td></tr>";
        }
        if ($area != null) {
            echo "<tr><th>Area</th><td>: " . $area . "</td></tr>";
        }
        if ($searchModel->from != null || $searchModel->to != null) {
            if ($searchModel->from == null) {
                echo "<tr><th>Date</th><td>: " . $searchModel->to . "</td></tr>";
            } else if ($searchModel->to == null) {
                echo "<tr><th>Date</th><td>: " . $searchModel->from . "</td></tr>";
            }else  {
                echo "<tr><th>Date</th><td>: " . $searchModel->from . " to ".$searchModel->to."</td></tr>";
            }
        }
        if ($searchModel->teller != null) {
            echo "<tr><th>Payment</th><td>: " . $searchModel->teller . "</td></tr>";
        }
//        if ($searchModel->arrears > 0) {
//            echo "<tr><th>Arrears</th><td>: ".$searchModel->arrears." or more</td></tr>";
//        }
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
            return ['id' => $model['id'], 'onclick' => 'window.location = "' . Yii::$app->getUrlManager()->createUrl(['transaction/view', 'id' => $model['txid']]) . '";'];
        },
        'tableOptions' => ['class' => 'ui table table-striped table-hover'],
        'columns' => [
            ['attribute' => 'txid', 'label' => 'Tx', 'contentOptions' => ['style' => 'max-width: 100px;']],
            ['attribute' => 'timestamp', 'label' => 'Tx Time', 'contentOptions' => ['style' => 'max-width: 100px']],
            ['attribute' => 'loan_id', 'label' => 'Loan', 'contentOptions' => ['style' => 'max-width: 100px;']],
            //['attribute' => 'disbursed_date', 'label' => 'Date'],
            ['attribute' => 'loan_type', 'content' => function ($data) {
                $details = "";
                if (LoanTypes::isVehicleLoan($data["loan_type"])) {
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
                return LoanType::findOne(['id' => $data["loan_type"]])->name.$details;
            }],
            ['attribute' => 'id', 'label' => 'Customer', 'content' => function ($data) {
                return Html::a($data['name'], Url::to(['customer/view', 'id' => $data['id']]));
            }],
            ['attribute' => 'payment'],
            ['attribute' => 'amount', 'value' => function($data) {return number_format($data['amount'], 2);},'contentOptions' => ['style' => 'text-align: right;']],

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
