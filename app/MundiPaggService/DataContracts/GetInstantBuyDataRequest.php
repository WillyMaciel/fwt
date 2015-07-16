<?php
class GetInstantBuyDataRequest {
	/*@var [Guid] Buyer key */
	public $BuyerKey;
	/*@var [Guid] Instant Buy Key */
	public $InstantBuyKey;
	/*@var [Guid] Merchant Key */
	public $MerchantKey;
	/*@var [Guid] Request key */
	public $RequestKey;
	
	function __construct() {
		$this->BuyerKey = null;
		$this->InstantBuyKey = null;
		$this->MerchantKey = constant("MP_MERCHANT_KEY");
		$this->RequestKey = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .= $ts . "BuyerKey: " . $te . $this->BuyerKey . NEWLINE;
		$str .= $ts . "InstantBuyKey: " . $te . $this->InstantBuyKey . NEWLINE;
		$str .= $ts . "MerchantKey: " . $te . $this->MerchantKey . NEWLINE;
		$str .= $ts . "RequestKey: " . $te . $this->RequestKey . NEWLINE;
		
		return $str;
	}
}
