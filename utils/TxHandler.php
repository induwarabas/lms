<?php
/**
 * Created by PhpStorm.
 * User: Supun
 * Date: 6/29/2017
 * Time: 9:18 PM
 */

namespace app\utils;


use app\models\Account;
use app\models\Transaction;
use app\utils\enums\PaymentType;
use Yii;

class TxHandler
{
    public $error = null;
    public $txid = null;

    public function getError()
    {
        return $this->error;
    }

    public function getTransactionID()
    {
        return $this->txid;
    }

    public function createLink() {
        return uniqid();
    }

    public function createTransaction($cr, $dr, $amount, $type, $payment, $description, $link = null, $cheque = null)
    {
        if($amount == 0) {
            return true;
        }

        if($link == null) {
            $link = uniqid();
        }
        //$tx = Yii::$app->getDb()->beginTransaction();
        $crAccount = Account::find()->where(["id" => $cr])->one();

        if ($crAccount->protection == 'PLUS' && $crAccount->balance - $amount < 0.0) {
            $this->error = $cr . " has no funds to do the transaction";
            return false;
        }

        $drAccount = Account::find()->where(["id" => $dr])->one();

        if ($drAccount->protection == 'MINUS' && $drAccount->balance + $amount > 0.0) {
            $this->error = $dr . " has no funds to do the transaction";
            return false;
        }

        if ($payment == PaymentType::CHEQUE && ($cheque == null || $cheque == '')) {
            $this->error = "Cheque number not given";
            return false;
        }

        $transaction = new Transaction;
        $transaction->cr_account = $cr;
        $transaction->dr_account = $dr;
        $transaction->cr_balance = $crAccount->balance - $amount;
        $transaction->dr_balance = $drAccount->balance + $amount;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->description = $description;
        $transaction->txlink = $link;
        $transaction->payment = $payment;
        $transaction->cheque = $cheque;
        $transaction->txlink = $link;
        if (!$transaction->save()) {
            foreach ($transaction->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        $this->txid = $transaction->getPrimaryKey();

        $crAccount->balance = $transaction->cr_balance;
        if (!$crAccount->save()) {
            foreach ($crAccount->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        $drAccount->balance = $transaction->dr_balance;
        $drAccount->save();
        if (!$drAccount->save()) {
            foreach ($drAccount->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        //$tx->commit();
        return true;
    }
}