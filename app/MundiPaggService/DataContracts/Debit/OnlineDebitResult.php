<?php
include_once "Enum.php";
include_once "ErrorReport.php";
include_once "ErrorItem.php";

class OnlineDebitResult {

    /** @var [String] Online debit transaction status*/
    public $OnlineDebitStatus;

    /** @var [Guid] Merchant key*/
    public $MerchantKey;

    /** @var [Guid] Order key*/
    public $OrderKey;

    /** @var [String] Transaction reference*/
    public $TransactionReference;

    /** @var [Guid] Transaction key*/
    public $TransactionKey;

    /** @var [String] Bank environment url*/
    public $BankRedirectUrl;

    /** @var [String] Version*/
    public $Version;

    /** @var [Long] Process time*/
    public $ProcessTimeInMilliseconds;

    /** @var [ErrorReport] Error*/
    public $ErrorReport;

    /** @var [Bool] Success*/
    public $Success;

    /** @var [String] Transaction key on bank*/
    public $TransactionKeyToBank;

    function __construct() {

        $this->OnlineDebitStatus = null;
        $this->MerchantKey = null;
        $this->OrderKey = null;
        $this->TransactionReference = null;
        $this->TransactionKey = null;
        $this->BankRedirectUrl = null;
        $this->Version = null;
        $this->ProcessTimeInMilliseconds = 0;
        $this->ErrorReport = null;
        $this->Success = false;
        $this->TransactionKeyToBank = null;
    }
}
