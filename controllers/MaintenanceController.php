<?php

namespace app\controllers;

use app\models\DayStartModel;
use app\models\Loan;
use app\models\MonthlyReport;
use app\models\Setting;
use app\models\VehicleType;
use app\models\VehicleTypeSearch;
use app\utils\enums\LoanStatus;
use app\utils\MonthlyReportGenerator;
use webvimark\modules\UserManagement\models\User;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * MaintenanceController
 */
class MaintenanceController extends LmsController
{
    public function actionDaySwitch() {
        $model = new DayStartModel();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $setting = Setting::findOne(1);
            if ($setting->value > $model->date) {
                $model->addError('date', "Cannot go back.");
            } else if (date('Y-m-d') < $model->date && !User::hasPermission('goFutureDate')) {
                $model->addError('date', "You have no permission to go future");
            } else {
                $setting->value = $model->date;
                if ($setting->save()) {
                    $prev_month_ts = strtotime(date("Y-m-d").' -1 month');

                    $prev_year = date('Y', $prev_month_ts);
                    $prev_month = date('m', $prev_month_ts);
                    $monthReport = MonthlyReport::findOne(['year' => $prev_year, 'month' => $prev_month]);
                    $monthGenerated = true;
                    if ($monthReport == null) {
                        $monthGenerated = false;
                        $report = MonthlyReportGenerator::generate($prev_year, $prev_month);
                        if ($report->save()) {
                            $monthGenerated = true;
                        }
                    }

                    if ($monthGenerated) {
                        $accounts = Loan::find()->where(['status' => LoanStatus::ACTIVE])->all();
                        $loans = [];
                        $batch = 30;
                        $current = 0;
                        $text = '';
                        foreach ($accounts as $account) {
                            if ($current == 0) {
                                $text = $account->id;
                            } else {
                                $text .= ',' . $account->id;
                            }
                            ++$current;
                            if ($current == $batch) {
                                $loans[] = $text;
                                $text = '';
                                $current = 0;
                            }
                        }
                        if ($text !== '') {
                            $loans[] = $text;
                        }

                        return $this->render('day-start-run', ['accounts' => $loans, 'daily' => $model->daily]);
                    }
                }
            }
        }
        $model->daily = (date('N') < 6);
        $model->date = date('Y-m-d');
        return $this->render('day-start', ['model' => $model]);
    }
}
