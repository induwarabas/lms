<?php

namespace app\controllers;

use app\models\DayStartModel;
use app\models\Loan;
use app\models\Setting;
use app\models\VehicleType;
use app\models\VehicleTypeSearch;
use app\utils\enums\LoanStatus;
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
            $setting->value = $model->date;
            if ($setting->save()){
                $accounts = Loan::find()->where(['status' => LoanStatus::ACTIVE])->all();
                $loans = [];
                $batch = 10;
                $current = 0;
                $text = '';
                foreach ($accounts as $account){
                    if ($current == 0) {
                        $text = $account->id;
                    } else {
                        $text .= ','.$account->id;
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

                return $this->render('day-start-run', ['accounts' => $loans, 'date' => $model->date]);
            }
        }
        $model->date = Setting::getDay();
        return $this->render('day-start', ['model' => $model]);
    }
}
