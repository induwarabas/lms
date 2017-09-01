<?php

namespace app\controllers;

use app\models\ArrearsSearch;
use app\models\Loan;
use app\models\ReceiptSearch;
use app\utils\enums\LoanTypes;
use app\utils\enums\TxType;
use app\utils\Settings;
use kartik\mpdf\Pdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class ReportController extends LmsController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPayment()
    {
        $query = Loan::find()->where(['paid' => 0])->andWhere(['status' => 'ACTIVE']);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->pagination = array(
            'pageSize' => 20,
        );

        $total = $query->sum('amount');

        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->sort = false;
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );

            return $this->createPdf("Loans to Pay", $this->renderPartial('payment', [
                'dataProvider' => $dataProvider,
                'total' => $total,
                'print' => true
            ]));
        } else {
            return $this->render('payment', [
                'dataProvider' => $dataProvider,
                'total' => $total,
                'print' => false
            ]);
        }
    }

    public function actionDisburse()
    {
        $query = Loan::find()->where(['status' => 'PENDING']);
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->pagination = array(
            'pageSize' => 20,
        );

        $total = $query->sum('amount');

        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->sort = false;
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            // return the pdf output as per the destination setting
            return $this->createPdf("Loans to Disburse", $this->renderPartial('disburse', [
                'dataProvider' => $dataProvider,
                'total' => $total,
                'print' => true
            ]));
        } else {
            return $this->render('disburse', [
                'dataProvider' => $dataProvider,
                'total' => $total,
                'print' => false
            ]);
        }
    }

    public function actionArrears()
    {
        $searchModel = new ArrearsSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        $query = new Query();
        $query->select(['loan_due.*', 'loan.type', 'customer.*', 'account.balance'])
            ->from('loan_due')
            ->innerJoin('loan', 'loan_due.loan_id = loan.id')
            ->innerJoin('customer', 'loan.customer_id = customer.id')
            ->innerJoin('account', 'loan.saving_account = account.id')
            ->where('loan_due.due > 0');

        if ($searchModel->validate()) {
            $query->andFilterWhere(['area' => $searchModel->area]);
            if ($searchModel->type == 100) {
                $query->andFilterWhere(['type' => [LoanTypes::HP_REG_VEHICLE_REFINANCE, LoanTypes::HP_REG_VEHICLE_OTHER, LoanTypes::HP_NEW_VEHICLE]]);
            } else {
                $query->andFilterWhere(['type' => $searchModel->type]);
            }
            if ($searchModel->arrears != null) {
                $query->andWhere('arrears >= :arr', [':arr' => $searchModel->arrears]);
            }
        }

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->pagination = array(
            'pageSize' => 20,
        );
        $dataProvider->sort = ['attributes' => ['loan_id', 'type', 'arrears', 'penalty', 'due']];

        $total = $query->sum('due - balance');

        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            // return the pdf output as per the destination setting
            return $this->createPdf("Arrears Report", $this->renderPartial('arrears', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => true
            ]));
        } else {
            return $this->render('arrears', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => false
            ]);
        }
    }

    public function actionReceipts()
    {
        $searchModel = new ReceiptSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        $query = new Query();
        $query->select(['transaction.*', 'loan.id as loan_id', 'loan.type as loan_type', 'customer.*'])
            ->from('transaction')
            ->innerJoin('loan', 'transaction.cr_account = loan.saving_account')
            ->innerJoin('customer', 'loan.customer_id = customer.id')
            ->where(["transaction.type" => TxType::RECEIPT]);

        if ($searchModel->validate()) {
            $query->andFilterWhere(['area' => $searchModel->area, 'user' => $searchModel->teller]);
            if ($searchModel->type == 100) {
                $query->andFilterWhere(['loan.type' => [LoanTypes::HP_REG_VEHICLE_REFINANCE, LoanTypes::HP_REG_VEHICLE_OTHER, LoanTypes::HP_NEW_VEHICLE]]);
            } else {
                $query->andFilterWhere(['loan.type' => $searchModel->type]);
            }
            $from = $searchModel->from;
            $to = $searchModel->to;
            if ($from != null || $to != null) {
                if ($from == null && $to != null) {
                    $from = $to;
                }

                if ($to == null) {
                    $to = $from;
                }

                $tox = date('Y-m-d', strtotime("+1 day", strtotime($to)));

                $query->andWhere(['>', "timestamp", $from])->andWhere(['<', "timestamp", $tox]);
            }
        }

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->pagination = array(
            'pageSize' => 20,
        );
        $dataProvider->sort = ['attributes' => ['loan_id', 'txid', 'timestamp', 'loan_type', 'user', 'amount']];

        $total = $query->sum('transaction.amount');

        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            // return the pdf output as per the destination setting
            return $this->createPdf("Receipt Report", $this->renderPartial('receipts', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => true
            ]));
        } else {
            return $this->render('receipts', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => false
            ]);
        }
    }

    public function actionSummary()
    {
        $results = Yii::$app->getDb()->createCommand("SELECT status, sum(principal) as principal, sum(charges) as charges, sum(penalty) as penalty, sum(interest) as interest, sum(paid) as paid, sum(due) as due from loan_schedule where status != 'PAYED' group by status")->query();

        $due = ['status'=> 'DUE','principal' => 0.0, 'charges' => 0.0, 'penalty' => 0.0, 'interest' => 0.0, 'due' => 0.0, 'paid' => 0.0];
        $total = ['status'=> 'TOTAL','principal' => 0.0, 'charges' => 0.0, 'penalty' => 0.0, 'interest' => 0.0, 'due' => 0.0, 'paid' => 0.0];

        $rows = [];

        foreach ($results as $row) {
            if ($row['status'] != 'PENDING') {
                $due['principal'] += $row['principal'];
                $due['charges'] += $row['charges'];
                $due['penalty'] += $row['penalty'];
                $due['interest'] += $row['interest'];
                $due['due'] += $row['due'];
                $due['paid'] += $row['paid'];
            } else {
                $row['due'] = $row['principal'] + $row['interest'] + $row['charges'] + $row['penalty'] - $row['paid'];
            }
            $rows[] = $row;
            $total['principal'] += $row['principal'];
            $total['charges'] += $row['charges'];
            $total['penalty'] += $row['penalty'];
            $total['interest'] += $row['interest'];
            $total['paid'] += $row['paid'];
        }

        $total['due'] = $total['principal'] + $total['interest'] + $total['charges'] + $total['penalty'] - $total['paid'];
        $rows[] = $due;
        $rows[] = $total;

        $dataProvider = new ArrayDataProvider(['allModels' => $rows]);


        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            // return the pdf output as per the destination setting
            return $this->createPdf("Summary Report", $this->renderPartial('summary', [
                'dataProvider' => $dataProvider,
                'print' => true
            ]));
        } else {
            return $this->render('summary', [
                'dataProvider' => $dataProvider,
                'print' => false
            ]);
        }
    }

    public function actionPayments()
    {
        $searchModel = new ReceiptSearch();
        $searchModel->load(Yii::$app->request->queryParams);

        $query = new Query();
        $query->select(['transaction.*', 'loan.id as loan_id', 'loan.type as loan_type', 'customer.*'])
            ->from('transaction')
            ->innerJoin('loan', 'transaction.txid = loan.paid')
            ->innerJoin('customer', 'loan.customer_id = customer.id')
            ->where(["transaction.type" => TxType::PAYMENT]);

        if ($searchModel->validate()) {
            $query->andFilterWhere(['area' => $searchModel->area, 'payment' => $searchModel->teller]);
            if ($searchModel->type == 100) {
                $query->andFilterWhere(['loan.type' => [LoanTypes::HP_REG_VEHICLE_REFINANCE, LoanTypes::HP_REG_VEHICLE_OTHER, LoanTypes::HP_NEW_VEHICLE]]);
            } else {
                $query->andFilterWhere(['loan.type' => $searchModel->type]);
            }
            $from = $searchModel->from;
            $to = $searchModel->to;
            if ($from != null || $to != null) {
                if ($from == null && $to != null) {
                    $from = $to;
                }

                if ($to == null) {
                    $to = $from;
                }

                $tox = date('Y-m-d', strtotime("+1 day", strtotime($to)));

                $query->andWhere(['>', "timestamp", $from])->andWhere(['<', "timestamp", $tox]);
            }
        }

        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $dataProvider->pagination = array(
            'pageSize' => 20,
        );
        $dataProvider->sort = ['attributes' => ['loan_id', 'txid', 'timestamp', 'loan_type', 'payment', 'amount']];

        $total = $query->sum('transaction.amount');

        if (Yii::$app->getRequest()->getQueryParam("print") == "true") {
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            // return the pdf output as per the destination setting
            return $this->createPdf("Payment Report", $this->renderPartial('payments', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => true
            ]));
        } else {
            return $this->render('payments', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'total' => $total,
                'print' => false
            ]);
        }
    }

    /**
     * @param $title string
     * @param $content string
     * @return string
     */
    private function createPdf($title, $content)
    {
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => 'A4',
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px} a {color: black;text-decoration: none;}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cash Receipt'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [$title . '||' . Settings::companyName()],
                'SetFooter' => [date("Y-m-d H:i:s") . '||page {PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }
}
