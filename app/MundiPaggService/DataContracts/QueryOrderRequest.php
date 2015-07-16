<?php
class QueryOrderRequest {
	/*@var [Guid] Merchant key */
	public $MerchantKey;
	/*@var [Guid] Order key*/
	public $OrderKey; 
	/*@var [string] Order Reference*/
	public $OrderReference;
	/*@var [Guid] Request key*/
	public $RequestKey;
	
	function __construct() {
		$this->MerchantKey = constant("MP_MERCHANT_KEY");
		$this->OrderKey = null;
		$this->OrderReference = "";
		$this->RequestKey = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "MerchantKey: " . $this->MerchantKey . NEWLINE;
		$str .=  "OrderKey: " . $this->OrderKey . NEWLINE;
		$str .=  "OrderReference: " . $this->OrderReference . NEWLINE;
		$str .=  "RequestKey: " . $this->RequestKey . NEWLINE;
		
		return $str;
	}
}
