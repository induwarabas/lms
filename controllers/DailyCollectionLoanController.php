<?php

namespace app\controllers;

use app\models\Customer;
use app\models\HpNewVehicleLoan;
use app\models\HpNewVehicleLoanEx;
use app\models\Loan;
use app\models\LoanType;
use app\models\Template;
use app\models\Transaction;
use app\models\VehicleBrand;
use app\models\VehicleType;
use app\utils\enums\LoanTypes;
use app\utils\enums\TxType;
use app\utils\loan\AmortizationCalculator;
use app\utils\loan\DailyScheduleCalculator;
use app\utils\loan\LoanCreator;
use app\utils\MustacheFormatter;
use kartik\mpdf\Pdf;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * HpNewVehicleLoanController implements the CRUD actions for HpNewVehicleLoan model.
 */
class DailyCollectionLoanController extends LmsController
{
    /**
     * Lists all HpNewVehicleLoan models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect(['loan/index']);
    }

    /**
     * Displays a single HpNewVehicleLoan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $loan = $this->findModel($id);
        $applicant = Customer::findOne(['id' => $loan->customer_id]);
        $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
        $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
        $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);

        $interestTerms = 12;
        if ($loan->collection_method === 2) //Weekly
        {
            $interestTerms = 52;
        } else if ($loan->collection_method == 3) //Daily
        {
            $interestTerms = 365;
        }

        $amort = new DailyScheduleCalculator();
        $installment = $amort->calculateInstallment($loan->amount, $loan->interest, $loan->period);
        $loan->installment = $installment;

        return $this->render('view', [
            'loan' => $loan,
            'applicant' => $applicant,
            'guarantor1' => $guarantor1,
            'guarantor2' => $guarantor2,
            'guarantor3' => $guarantor3,
            'error' => Yii::$app->request->getQueryParam("error")
        ]);
    }

    /**
     * Creates a new HpNewVehicleLoan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $loan = Yii::$app->getSession()->get("loan");
        if ($loan == null) {
            $loan = new Loan();
            $loan->type = $type;
            $loan->collection_method = 3;
            $loan->period = 3;
            $loan->interest = 6;
            $loan->penalty = 0;
            $loan->charges = 0;
        } else if (isset($loan->id)) {
            $this->redirect(["update", 'id' => $loan->id]);
        }

        if ($loan->load(Yii::$app->request->post())) {
            if ($loan->validate()) {
                $tx = Yii::$app->getDb()->beginTransaction();
                $loanCreator = new LoanCreator();
                $id = $loanCreator->createLoan($loan);
                if ($id == -1) {
                    $tx->rollBack();
                } else {
                    $tx->commit();
                    Yii::$app->getSession()->remove("loan");
                    return $this->redirect(['view', 'id' => $loan->id]);
                }
            }
        }
        $applicant = null;
        if (isset($loan->customer_id)) {
            $applicant = Customer::findOne(['id' => $loan->customer_id]);
        }
        $guarantor1 = null;
        if (isset($loan->guarantor_1)) {
            $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
        }
        $guarantor2 = null;
        if (isset($loan->guarantor_2)) {
            $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
        }
        $guarantor3 = null;
        if (isset($loan->guarantor_3)) {
            $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);
        }
        return $this->render('create', [
            'loan' => $loan,
            'applicant' => $applicant,
            'guarantor1' => $guarantor1,
            'guarantor2' => $guarantor2,
            'guarantor3' => $guarantor3,
        ]);
    }

    public function actionSetCustomer($id, $type)
    {
        $loan = new Loan();
        if ($id != 0) {
            $loan = Loan::findOne(['id' => $id]);
        }
        $loan->load(Yii::$app->request->post());
        Yii::$app->getSession()->set('loan', $loan);

        Yii::$app->getSession()->set('loan-req', $type);

        $this->redirect(["customer/index"]);
    }

    /**
     * Updates an existing HpNewVehicleLoan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $loan = Yii::$app->getSession()->get("loan");
        if ($loan == null || $loan->id != $id) {
            $loan = Loan::findOne(['id' => $id]);
        }

        if ($loan->status != 'PENDING') {
            return $this->redirect(['updatex', 'id' => $id]);
        }

        $loan->penalty = 0.0;
        $loan->charges = 0.0;

        if ($loan->load(Yii::$app->request->post()) && $loan->validate()) {
            $tx = Yii::$app->getDb()->beginTransaction();
            $loan->save();
            $tx->commit();
            Yii::$app->getSession()->remove("loan");
            return $this->redirect(['view', 'id' => $loan->id]);
        } else {
            $applicant = null;
            if (isset($loan->customer_id)) {
                $applicant = Customer::findOne(['id' => $loan->customer_id]);
            }
            $guarantor1 = null;
            if (isset($loan->guarantor_1)) {
                $guarantor1 = Customer::findOne(['id' => $loan->guarantor_1]);
            }
            $guarantor2 = null;
            if (isset($loan->guarantor_2)) {
                $guarantor2 = Customer::findOne(['id' => $loan->guarantor_2]);
            }
            $guarantor3 = null;
            if (isset($loan->guarantor_3)) {
                $guarantor3 = Customer::findOne(['id' => $loan->guarantor_3]);
            }
            return $this->render('update', [
                'loan' => $loan,
                'applicant' => $applicant,
                'guarantor1' => $guarantor1,
                'guarantor2' => $guarantor2,
                'guarantor3' => $guarantor3,
            ]);
        }
    }

    public function actionPrintReceipt($id) {
        $transaction = Transaction::findOne($id);
        if ($transaction == null) {
            return "Invalid receipt";
        }

        if ($transaction->type !== TxType::RECEIPT) {
            return "Invalid receipt";
        }

        $loan = Loan::findOne(['saving_account' => $transaction->cr_account]);
        if ($loan == null) {
            return "Invalid receipt";
        }

        $description = LoanType::findOne($loan->type)->name;
        if (LoanTypes::isVehicleLoan($loan->type)) {
            $loanx = HpNewVehicleLoan::findOne($loan->id);
            $description .= " - ".VehicleType::findOne($loanx->vehicle_type)->name." ".VehicleBrand::findOne($loanx->make)->name ." " .$loanx->model;
            if (isset($loanx->vehicle_no) && $loanx->vehicle_no != null && $loanx->vehicle_no !== '') {
                $description .= " - " . $loanx->vehicle_no;
            }
            $description .= " (" . $loanx->engine_no . "/".$loanx->chasis_no.")";
        }
        $customer = Customer::findOne($loan->customer_id);

        $template = Template::findOne(1);
        $m = new \Mustache_Engine();
        $m->addHelper("format", new MustacheFormatter());
        $text = $m->render($template->content);

        $template = Template::findOne(2);
        $text .= $m->render($template->content,['invoice_number' => str_pad($id, 10, "0", STR_PAD_LEFT),
            'loan' => $loan,
            'tx' => $transaction,
            'description' => $description,
            'customer' => $customer]);
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $text,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Cash Receipt'],
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
     * Finds the HpNewVehicleLoan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Loan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
