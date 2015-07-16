<?php
class ManageCreditCardTransactionRequest {
	/*@var [long] Amount In Cents */
	public $AmountInCents;
	/*@var [Guid] Transaction Key */
	public $TransactionKey;
	/*@var [string] Transaction Reference */
	public $TransactionReference; // string
	
	function __construct() {
		$this->AmountInCents = 0;
		$this->TransactionKey = null;
		$this->TransactionReference = "";
	}
}
