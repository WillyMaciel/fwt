<?php
//include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once "RetryOrderCreditCardTransactionRequest.php";

class RetryOrderRequest {
	/*@var [Guid] Merchant key*/
	public $MerchantKey;
	/*@var [Guid] Order key*/
	public $OrderKey;
	/*@var [string] Order Reference*/
	public $OrderReference; 
	/*@var [Guid] Request key*/
	public $RequestKey;
	/*@var [RetryOrderCreditCardTransactionRequest] Retry Order CreditCard Transaction Request Collection */
	public $RetryOrderCreditCardTransactionRequestCollection;
	
	function __construct() {
		$this->MerchantKey = constant("MP_MERCHANT_KEY");
		$this->OrderKey = null;
		$this->OrderReference = "";
		$this->RequestKey = null;
		$this->RetryOrderCreditCardTransactionRequestCollection = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "MerchantKey: " . $this->MerchantKey . NEWLINE;
		$str .=  "OrderKey: " . $this->OrderKey . NEWLINE;
		$str .=  "OrderReference: " . $this->OrderReference . NEWLINE;
		$str .=  "RequestKey: " . $this->RequestKey . NEWLINE;
		
		if (is_array($this->RetryOrderCreditCardTransactionRequestCollection)) {
			foreach($this->RetryOrderCreditCardTransactionRequestCollection as $ccTrans) {
				$str .=  "RetryOrderCreditCardTransactionRequest: " . $ccTrans . NEWLINE;
			}
		}
		
		return $str;
	}
}
