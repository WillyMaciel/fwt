<?php
include_once "Enum.php";

class CreditCardTransactionData {
	/*@var [string] Authorization Code*/
	public $AcquirerAuthorizationCode;
	/*@var [string] Acquirer Name*/
	public $AcquirerName;
	/*@var [long] Amount in Cents*/
	public $AmountInCents;
	/*@var [long] Authorized Amount in Cents*/
	public $AuthorizedAmountInCents;
	/*@var [long] Captured Amount in Cents */
	public $CapturedAmountInCents;
	/*@var [DateTime] Transaction Creation Date*/
	public $CreateDate; 
	/*@var [CreditCardBrandEnum] CreditCard Brand*/
	public $CreditCardBrandEnum; 
	/*@var [string] CreditCard Number*/
	public $CreditCardNumber;
	/*@var [CreditCardTransactionStatusEnum] CreditCard Transaction Status*/
	public $CreditCardTransactionStatusEnum; 
	/*@var [string] Custom Status*/
	public $CustomStatus;
	/*@var [DateTime] Transaction Due Date*/
	public $DueDate;
	/*@var [integer] Transaction Installment Count*/
	public $InstallmentCount;
	/*@var [guid] Transaction Instant Buy Key*/
	public $InstantBuyKey;
	/*@var [bool] If transaction is Reccurrency*/
	public $IsReccurrency; 
	/*@var [long] Refunded Amount in cents*/
	public $RefundedAmountInCents; 
	/*@var [string] Transaction Identifier*/
	public $TransactionIdentifier;
	/*@var [guid] Transaction Key*/
	public $TransactionKey; 
	/*@var [string] Transaction Reference */
	public $TransactionReference;
	/*@var [string] Unique Sequential Number*/
	public $UniqueSequentialNumber;
	/*@var [long] Voided Amount In Cents*/
	public $VoidedAmountInCents; // Nullable<long>
	
	function __construct() {
		$this->AcquirerAuthorizationCode = "";
		$this->AcquirerName = "";
		$this->AmountInCents = 0;
		$this->AuthorizedAmountInCents = null;
		$this->CapturedAmountInCents = null;
		$this->CreateDate = null;
		$this->CreditCardBrandEnum = CreditCardBrandEnum::__default;
		$this->CreditCardNumber = "";
		$this->CreditCardTransactionStatusEnum = CreditCardTransactionStatusEnum::__default;
		$this->CustomStatus = "";
		$this->DueDate = null;
		$this->InstallmentCount = 0;
		$this->InstantBuyKey = null;
		$this->IsReccurency = false;
		$this->RefundedAmountInCents = null;
		$this->TransactionIdentifier = "";
		$this->TransactionKey = null;
		$this->TransactionReference = "";
		$this->UniqueSequentialNumber = "";
		$this->VoidedAmountInCents = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "AcquirerAuthorizationCode: " . $this->AcquirerAuthorizationCode . NEWLINE;
		$str .=  "AcquirerName: " . $this->AcquirerName . NEWLINE;
		$str .=  "AmountInCents: " . $this->AmountInCents . NEWLINE;
		$str .=  "AuthorizedAmountInCents: " . $this->AuthorizedAmountInCents . NEWLINE;
		$str .=  "CreateDate: " . $this->CreateDate . NEWLINE;
		$str .=  "CreditCardBrandEnum: " . $this->CreditCardBrandEnum . NEWLINE;
		$str .=  "CreditCardNumber: " . $this->CreditCardNumber . NEWLINE;
		$str .=  "OrderReference: " . $this->OrderReference . NEWLINE;
		$str .=  "CreditCardTransactionStatusEnum: " . $this->CreditCardTransactionStatusEnum . NEWLINE;
		$str .=  "CustomStatus: " . $this->CustomStatus . NEWLINE;
		$str .=  "DueDate: " . $this->DueDate . NEWLINE;
		$str .=  "InstallmentCount: " . $this->InstallmentCount . NEWLINE;
		$str .=  "InstantBuyKey: " . $this->InstantBuyKey . NEWLINE;
		$str .=  "IsReccurrency: " . $this->IsReccurrency . NEWLINE;
		$str .=  "RefundedAmountInCents: " . $this->RefundedAmountInCents . NEWLINE;
		$str .=  "TransactionIdentifier: " . $this->TransactionIdentifier . NEWLINE;
		$str .=  "TransactionKey: " . $this->TransactionKey . NEWLINE;
		$str .=  "TransactionReference: " . $this->TransactionReference . NEWLINE;
		$str .=  "UniqueSequentialNumber: " . $this->UniqueSequentialNumber . NEWLINE;
		$str .=  "VoidedAmountInCents: " . $this->VoidedAmountInCents . NEWLINE;
		
		return $str;
	}
}
