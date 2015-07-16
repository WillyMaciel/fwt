<?php
include_once "Buyer.php";
include_once "BoletoTransaction.php";
include_once "CreditCardTransaction.php";
include_once "ShoppingCart.php";
include_once "Enum.php";

class CreateOrderRequest {
	/*@var [Long] Order amount in cents*/
	public $AmountInCents;
	/*@var [Long] Amount (in cents) to consider the order is paid*/
	public $AmountInCentsToConsiderPaid;
	/*@var [CorrencyIsoEnum] Order amount currency.*/
	/*@param Default: BRL*/
	public $CurrencyIsoEnum;
	/*@var [EmailUpadateToBuyerEnum] EMail Update To buyer*/
	public $EmailUpdateToBuyerEnum; 
	/*@var [Guid] MundiPagg merchant identification */
	public $MerchantKey; 
	/*@var [String] Custom order identification.*/
	public $OrderReference; 
	/*@var [Guid] Globally Unique Identifier.*/
	/*@param Default: 00000000-0000-0000-0000-000000000000*/
	public $RequestKey;
	/*@var [int] Number of Retries*/
	public $Retries;
	/*@var [Buyer] Buyer instance*/
	public $Buyer; // Buyer
	/*@var [ShoppingCart] Shopping Cart Collection*/
	public $ShoppingCartCollection;
	/*@var [CreditCardTransaction] CreditCard Transaction collection*/
	public $CreditCardTransactionCollection;
	/*@var [BoletoTransaction] Boleto transaction collection*/
	public $BoletoTransactionCollection; 
	
	function __construct() {
		$this->AmountInCents = 0;
		$this->AmountInCentsToConsiderPaid = 0;
		$this->CurrencyIsoEnum = CurrencyIsoEnum::BRL;
		$this->EmailUpdateToBuyerEnum = EmailUpdateToBuyerEnum::__default;
		$this->MerchantKey = constant("MP_MERCHANT_KEY");
		$this->OrderReference = "";
		$this->RequestKey = null;
		$this->Retries = null;
		$this->Buyer = null;
		$this->ShoppingCartCollection = null;
		$this->CreditCardTransactionCollection = null;
		//$this->BoletoTransactionCollection = null;
	}
	
	function __tostring() {
		$str = "";
		$str .=  "AmountInCents: " . $this->AmountInCents . NEWLINE;
		$str .=  "AmountInCentsToConsiderPaid: " . $this->AmountInCentsToConsiderPaid . NEWLINE;
		$str .=  "CurrencyIsoEnum: " . $this->CurrencyIsoEnum . NEWLINE;
		$str .=  "EmailUpdateToBuyerEnum: " . $this->EmailUpdateToBuyerEnum . NEWLINE;
		$str .=  "MerchantKey: " . $this->MerchantKey . NEWLINE;
		$str .=  "OrderReference: " . $this->OrderReference . NEWLINE;
		$str .=  "RequestKey: " . $this->RequestKey . NEWLINE;
		$str .=  "Retries: " . $this->Retries . NEWLINE;
		$str .=  "Buyer: " . $this->Buyer . NEWLINE;
		if (is_array($this->ShoppingCartCollection)) {
			foreach($this->ShoppingCartCollection as $sCart) {
				$str .=  "ShoppingCart: " . $sCart . NEWLINE;
			}
		}
		if (is_array($this->CreditCardTransactionCollection)) {
			foreach($this->CreditCardTransactionCollection as $ccTrans) {
				$str .=  "CreditCardTransaction: " . $ccTrans . NEWLINE;
			}
		}
		if (is_array($this->BoletoTransactionCollection)) {
			foreach($this->BoletoTransactionCollection as $boletoTrans) {
				$str .=  "BoletoTransaction: " . $boletoTrans . NEWLINE;
			}
		}
		
		return $str;
	}
}
