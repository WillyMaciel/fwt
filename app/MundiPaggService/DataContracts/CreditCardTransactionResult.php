<?php
include_once "Enum.php";

class CreditCardTransactionResult {
	/*@var [string] Message*/
	public $AcquirerMessage;
	/*@var [string] Return Code*/
	public $AcquirerReturnCode;
	/*@var [long] Amount in cents*/
	public $AmountInCents;
	/*@var [string] Authorization Code*/
	public $AuthorizationCode;
	/*@var [long] Authorized Amount In cents*/
	public $AuthorizedAmountInCents;
	/*@var [long] Captured Amount in cents*/
	public $CapturedAmountInCents; 
	/*@var [string] CreditCard Number*/
	public $CreditCardNumber;
	/*@var [CreditCardOperationEnum] CreditCard Operation */
	public $CreditCardOperationEnum; 
	/*@var [CreditCardTransactionStatusEnum] CreditCard Transaction Status*/
	public $CreditCardTransactionStatusEnum;
	/*@var [String] Custom Status*/
	public $CustomStatus;
	/*@var [DateTime] Transaction Due Date*/
	public $DueDate;
	/*@var [long] External Time In Milliseconds*/
	public $ExternalTimeInMilliseconds;
	/*@var [guid] Instant Buy Key*/
	public $InstantBuyKey;
	/*@var [long] Transaction Refunded Amount In Cents*/
	public $RefundedAmountInCents;
	/*@var [bool] Fail Or Success*/
	public $Success;
	/*@var [string] Transaction Identifier*/
	public $TransactionIdentifier;
	/*@var [guid] Transaction Key*/
	public $TransactionKey;
	/*@var [string] Transaction Reference*/
	public $TransactionReference;
	/*@var [string] Unique Sequential Number*/
	public $UniqueSequentialNumber;
	/*@var [long] Transaction Voided Amount In Cents*/
	public $VoidedAmountInCents;
	/*@var [OriginalAcquirerReturn] Original Acquirer Return collection */
	public $OriginalAcquirerReturnCollection; 
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#FF0000">';
		$te = '</font>';
		
		$str .= $ts . "AcquirerMessage: " . $te . $this->AcquirerMessage . NEWLINE;
		$str .= $ts . "AcquirerReturnCode: " . $te . $this->AcquirerReturnCode . NEWLINE;
		$str .= $ts . "AmountInCents: " . $te . $this->AmountInCents . NEWLINE;
		$str .= $ts . "AuthorizationCode: " . $te . $this->AuthorizationCode . NEWLINE;
		$str .= $ts . "AuthorizedAmountInCents: " . $te . $this->AuthorizedAmountInCents . NEWLINE;
		$str .= $ts . "CapturedAmountInCents: " . $te . $this->CapturedAmountInCents . NEWLINE;
		$str .= $ts . "CreditCardNumber: " . $te . $this->CreditCardNumber . NEWLINE;
		$str .= $ts . "CreditCardOperationEnum: " . $te . $this->CreditCardOperationEnum . NEWLINE;
		$str .= $ts . "CreditCardTransactionStatusEnum: " . $te . $this->CreditCardTransactionStatusEnum . NEWLINE;
		$str .= $ts . "CustomStatus: " . $te . $this->CustomStatus . NEWLINE;
		$str .= $ts . "DueDate: " . $te . $this->DueDate . NEWLINE;
		$str .= $ts . "ExternalTimeInMilliseconds: " . $te . $this->ExternalTimeInMilliseconds . NEWLINE;
		$str .= $ts . "InstantBuyKey: " . $te . $this->InstantBuyKey . NEWLINE;
		$str .= $ts . "RefundedAmountInCents: " . $te . $this->RefundedAmountInCents . NEWLINE;
		$str .= $ts . "Success: " . $te . $this->Success . NEWLINE;
		$str .= $ts . "TransactionIdentifier: " . $te . $this->TransactionIdentifier . NEWLINE;
		$str .= $ts . "TransactionKey: " . $te . $this->TransactionKey . NEWLINE;
		$str .= $ts . "TransactionReference: " . $te . $this->TransactionReference . NEWLINE;
		$str .= $ts . "UniqueSequentialNumber: " . $te . $this->UniqueSequentialNumber . NEWLINE;
		$str .= $ts . "VoidedAmountInCents: " . $te . $this->VoidedAmountInCents . NEWLINE;
		
		if (is_array($this->OriginalAcquirerReturnCollection)) {
			foreach($this->OriginalAcquirerReturnCollection as $key => $orAcReturn) {
				$str .= $ts . "OriginalAcquirerReturn: " . $te . $key . ' => ' . $orAcReturn . NEWLINE;
			}
		}
		
		return $str;
	}
}
