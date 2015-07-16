<?php
class RetryOrderCreditCardTransactionRequest {
	/*@var [string] Security Code */
	public $SecurityCode;
	/*@var [Guid] Transaction key*/
	public $TransactionKey;
	
	function __construct() {
		$this->SecurityCode = "";
		$this->TransactionKey = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "SecurityCode: " . $this->SecurityCode . NEWLINE;
		$str .=  "TransactionKey: " . $this->TransactionKey . NEWLINE;
		
		return $str;
	}
}
