<?php

namespace app\controllers;

use app\models\Account;
use app\models\AccountSearch;
use app\models\Customer;
use app\models\GeneralAccount;
use app\models\Loan;
use app\models\Transaction;
use app\utils\AccountDetails;
use app\utils\GeneralAccounts;
use app\utils\Settings;
use kartik\mpdf\Pdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends LmsController
{
    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionTest() {
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => "<span style='text-align: center'><h1>Hellow</h1></span>Grrrr",
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
//                'SetHeader'=>['Krajee Report Header'],
//                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Get account details
     * @param string $id
     * @return \app\utils\AccountDetails
     */
    private function getAccountDetails($id)
    {
        $account = Account::findOne($id);

        $details = new AccountDetails();
        $details->account = $account;

        if ($account->type == Account::TYPE_SAVING || $account->type == Account::TYPE_LOAN) {
            if ($account->type == Account::TYPE_SAVING)
                $loan = Loan::find()->where("saving_account = :id", [':id' => $id])->one();
            else
                $loan = Loan::find()->where("loan_account = :id", [':id' => $id])->one();

            //$customer = Customer::findOne($loan->customer_id);
            //$details->name = $customer->name;
            //$details->nameUrl = Yii::$app->getUrlManager()->createUrl(['customer/view', 'id' => $customer->id]);
            $details->descriptionTitle = "Loan";
            $details->description = "#" . $loan->id;
            $details->descriptionUrl = Yii::$app->getUrlManager()->createUrl(['loan/view', 'id' => $loan->id]);
        } else if ($account->type == Account::TYPE_GENERAL) {
            $ga = GeneralAccount::findOne(['account_id' => $id]);
            //$details->name = $ga->name;
            $details->descriptionTitle = 'Purpose';
            $details->description = $ga->description;
        }
        return $details;
    }

    /**
     * View account ledger
     * @param string $id
     * @return mixed
     */
    public function actionLedger($id)
    {
        $query = Transaction::find()->where("cr_account = :acc or dr_account = :acc", [":acc" => $id])->orderBy(['txid' => SORT_DESC])->limit(10);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
            'pagination' => false,
        ]);

        return $this->render('ledger', [
            'details' => $this->getAccountDetails($id),
            'dataProvider' => $dataProvider,
            'history' => null
        ]);
    }

    /**
     * View account ledger
     * @param string $id
     * @return mixed
     */
    public function actionHistory($id)
    {
        $from = Yii::$app->request->getQueryParam("from", null);
        $to = Yii::$app->request->getQueryParam("to", null);
        $print = Yii::$app->request->getQueryParam("print", false);
        if ($from == null && $to == null) {
            $to = date('Y-m-d');
            $from = date('Y-m-d', strtotime("-1 month"));
        }

        $tox = date('Y-m-d', strtotime("+1 day", strtotime($to)));

        $query = Transaction::find()->where("(cr_account = :acc or dr_account = :acc) and timestamp >= :from and timestamp <= :to", [":acc" => $id, ':from' => $from, ':to' => $tox]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if ($print  == true) {
            $dataProvider->pagination = array(
                'pageSize' => 0,
            );
            $content = $this->renderPartial('ledger-print', [
                'details' => $this->getAccountDetails($id),
                'dataProvider' => $dataProvider,
                'history' => ['from' => $from, 'to' => $to],
            ]);
            //return $content;
            return $this->createPdf("Ledger", $content);
        }

        return $this->render('ledger', [
            'details' => $this->getAccountDetails($id),
            'dataProvider' => $dataProvider,
            'history' => ['from' => $from, 'to' => $to],
        ]);
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
            'cssInline' => '.kv-heading-1{font-size:18px} a {color: black;text-decoration: none;} td,th {font-size:11px}',
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
