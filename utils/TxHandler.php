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


    public function createTransaction($cr, $dr, $amount, $type, $description)
    {
        $tx = Yii::$app->getDb()->beginTransaction();
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

        $transaction = new Transaction;
        $transaction->cr_account = $cr;
        $transaction->dr_account = $dr;
        $transaction->cr_balance = $crAccount->balance - $amount;
        $transaction->dr_balance = $drAccount->balance + $amount;
        $transaction->amount = $amount;
        $transaction->type = $type;
        $transaction->description = $description;
        $transaction->save();
        $this->txid = $transaction->getPrimaryKey();

        $crAccount->balance = $transaction->cr_balance;
        $crAccount->save();

        $drAccount->balance = $transaction->dr_balance;
        $drAccount->save();

        $tx->commit();
        return true;
    }
}