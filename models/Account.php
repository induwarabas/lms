<?php

namespace app\models;
use app\utils\enums\LoanTypes;
use app\utils\widgets\AccountIDView;
use app\utils\widgets\CanvasserView;
use app\utils\widgets\CustomerView;
use app\utils\widgets\SupplierView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "account".
 *
 * @property string $id
 * @property string $type
 * @property double $balance
 * @property string $protection
 */
class Account extends \yii\db\ActiveRecord
{
    const TYPE_SAVING = 'SAVING';
    const TYPE_LOAN = 'LOAN';
    const TYPE_SUPPLIER = 'SUPPLIER';
    const TYPE_CANVASSER = 'CANVASSER';
    const TYPE_BANK = 'BANK';
    const TYPE_TELLER = 'TELLER';
    const TYPE_GENERAL = 'GENERAL';


    const PROTECTION_NONE = 'NONE';
    const PROTECTION_PLUS = 'PLUS';
    const PROTECTION_MINUS = 'MINUS';

    public static function getTypeId($type) {
        static $TYPE_IDS = [
            Account::TYPE_SAVING => '1',
            Account::TYPE_LOAN => '2',
            Account::TYPE_SUPPLIER => '3',
            Account::TYPE_CANVASSER => '4',
            Account::TYPE_BANK => '7',
            Account::TYPE_TELLER => '8',
            Account::TYPE_GENERAL => '9',
        ];
        return $TYPE_IDS[$type];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'balance', 'protection'], 'required'],
            [['type', 'protection'], 'string'],
            [['balance'], 'number'],
            [['id'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Acocunt ID',
            'type' => 'Type',
            'balance' => 'Balance',
            'protection' => 'Protection',
        ];
    }

    /**
     * @inheritdoc
     * @return AccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountQuery(get_called_class());
    }

    /**
     * Creates the account id
     * @param $type integer
     * @param $id integer
     * @return string
     */
    public static function createAccountId($type, $id)
    {
        return Account::getTypeId($type) . str_pad($id, 9, '0', STR_PAD_LEFT);
    }

    /**
     * Get the teller account
     * @return \app\models\Account
     */
    public static function getTellerAccount() {
        $accountID = Account::createAccountId(Account::TYPE_TELLER, \Yii::$app->getUser()->id);
        $account = Account::findOne($accountID);
        if ($account == null) {
            $account = new Account();
            $account->id = $accountID;
            $account->type = Account::TYPE_TELLER;
            $account->balance = 0.0;
            $account->protection = Account::PROTECTION_MINUS;
            if ($account->save()) {
                return $account;
            }
        }
        return $account;
    }

    public function getAccountName() {
        if($this->type == Account::TYPE_SAVING) {
            $loan = Loan::findOne(['saving_account' => $this->id]);
            if ($loan != null) {
                $customer = Customer::findOne($loan->customer_id);
                return "Saving account of ".LoanType::findOne($loan->type)->name." "
                    .Html::a("loan #".$loan->id, Url::to(['loan/view', 'id' => $loan->id]))
                    ." of ".CustomerView::widget(['customer' => $customer]);
            }
        } else if ($this->type == Account::TYPE_LOAN) {
            $loan = Loan::findOne(['loan_account' => $this->id]);
            if ($loan != null) {
                $customer = Customer::findOne($loan->customer_id);
                return "Loan account of ".LoanType::findOne($loan->type)->name." "
                    .Html::a("loan #".$loan->id, Url::to(['loan/view', 'id' => $loan->id]))
                    ." of ".CustomerView::widget(['customer' => $customer]);
            }
        } else if($this->type == Account::TYPE_SUPPLIER) {
            $supplier = Supplier::findOne(['account' => $this->id]);
            if ($supplier != null) {
                return "Supplier ".SupplierView::widget(['supplier' => $supplier]);
            }
        } else if($this->type == Account::TYPE_CANVASSER) {
            $canvasser = Canvasser::findOne(['account' => $this->id]);
            if ($canvasser != null) {
                return "Canvasser ".CanvasserView::widget(['canvasser' => $canvasser]);
            }
        }else if($this->type == Account::TYPE_TELLER) {
            $userid = intval(substr($this->id, 1));
            $user = \webvimark\modules\UserManagement\models\User::findOne($userid);
            if ($user != null) {
                return "Teller ".$user->username;
            }
        }else if($this->type == Account::TYPE_BANK) {
            $bankAcc = BankAccount::findOne(['account_id' => $this->id]);
            if ($bankAcc != null) {
                return Html::a(Bank::findOne($bankAcc->bank)->name." - ".$bankAcc->bank_account_id, ['bank-account/view', ['id' => $bankAcc->id]]);
            }
        }else if($this->type == Account::TYPE_GENERAL) {
            $ga = GeneralAccount::findOne(['id' => $this->id]);
            if ($ga != null) {
                return "General account ".$ga->name. "(".$ga->description.")";
            }
        }
        return "Invalid account";
    }

    public function getAccountHtml() {
        return AccountIDView::widget(['accountId' => $this->id])." : ".$this->getAccountName();
    }
}
