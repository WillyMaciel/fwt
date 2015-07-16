<?php
include_once "Enum.php";

class CreditCardData {
	/*@var [CreditCardEnum] CreditCard Brand*/
	public $CreditCardBrandEnum;
	/*@var [string] CreditCard Number*/
	public $CreditCardNumber;
	/*@var [Guid] Instant Buy Key */
	public $InstantBuyKey;
	/*@var [bool] creditCard Validation */
	public $IsExpiredCreditCard; // bool
	
	function __construct() {
		$this->CreditCardBrandEnum = CreditCardBrandEnum::__default;
		$this->CreditCardNumber = "";
		$this->InstantBuyKey = null;
		$this->IsExpiredCreditCard = false;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .= $ts . "CreditCardBrandEnum: " . $te . $this->CreditCardBrandEnum . NEWLINE;
		$str .= $ts . "CreditCardNumber: " . $te . $this->CreditCardNumber . NEWLINE;
		$str .= $ts . "InstantBuyKey: " . $te . $this->InstantBuyKey . NEWLINE;
		$str .= $ts . "IsExpiredCreditCard: " . $te . $this->IsExpiredCreditCard . NEWLINE;
		
		return $str;
	}
}
