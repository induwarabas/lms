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
use app\utils\widgets\AccountIDView;
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

    public function createTransaction($dr, $cr, $amount, $type, $payment, $description, $link = null, $cheque = null)
    {
        if($amount == 0) {
            return true;
        }

        if($link == null) {
            $link = uniqid();
        }
        //$tx = Yii::$app->getDb()->beginTransaction();
        $drAccount = Account::find()->where(["id" => $dr])->one();
        if ($drAccount == null) {
            $this->error = $dr . " is not a valid account";
            return false;
        }

        if ($drAccount->protection == 'PLUS' && $drAccount->balance - $amount < 0.0) {
            $this->error = $drAccount->getAccountHtml() . " has no funds to do the transaction";
            return false;
        }

        $crAccount = Account::find()->where(["id" => $cr])->one();

        if ($crAccount == null) {
            $this->error = $cr . " is not a valid account";
            return false;
        }

        if ($crAccount->protection == 'MINUS' && $crAccount->balance + $amount > 0.0) {
            $this->error = $crAccount->getAccountHtml() . " has no funds to do the transaction";
            return false;
        }

        if (PaymentType::needReference($payment) && ($cheque == null || $cheque == '')) {
            $this->error = "Reference number not given";
            return false;
        }

        $transaction = new Transaction;
        $transaction->dr_account = $dr;
        $transaction->cr_account = $cr;
        $transaction->dr_balance = $drAccount->balance - $amount;
        $transaction->cr_balance = $crAccount->balance + $amount;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->description = $description;
        $transaction->txlink = $link;
        $transaction->payment = $payment;
        $transaction->cheque = $cheque;
        $transaction->txlink = $link;
        $transaction->user = Yii::$app->getUser()->identity->username;
        if (!$transaction->save()) {
            foreach ($transaction->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        $this->txid = $transaction->getPrimaryKey();

        $drAccount->balance = $transaction->dr_balance;
        if (!$drAccount->save()) {
            foreach ($drAccount->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        $crAccount->balance = $transaction->cr_balance;
        $crAccount->save();
        if (!$crAccount->save()) {
            foreach ($crAccount->errors as $key => $value) {
                $this->error = $value[0];
                return false;
            }
        }

        //$tx->commit();
        return true;
    }
}