<?php
include_once "Recurrency.php";
include_once "Enum.php";

class CreditCardTransaction {
	/*@var [Long] Transaction amount in cents*/
	public $AmountInCents; //long
	/*@var [int] capture delay in minutes */
	public $CaptureDelayInMinutes;
	/*@var [String] Card brand. Use the static property BrandEnum*/
	public $CreditCardBrandEnum;
	/*@var [String] Credit Card Number.*/
	public $CreditCardNumber;
	/*@var [String] Type of operation. Use the static property OperationEnum*/
	public $CreditCardOperationEnum;
	/*@var [Integer] Credit card expiration month*/
	public $ExpMonth; 
	/*@return [Integer] Credit card expiration year*/
	public $ExpYear;
	/*@var [Integer] Name in the credit card*/
	public $HolderName;
	/*@var [long] Iata Value */
	public $IataAmountInCents;
	/*@var [Integer] Transaction installments count.*/
	public $InstallmentCount;
	/*@var [guid] Instant buy key*/
	public $InstantBuyKey;
	/*@var [integer] Payment Method*/
	public $PaymentMethodCode;
	/*@var [Integer] Card security code.*/
	public $SecurityCode;
	public $ThirdPartyMerchantKey; // Guid
	/*@var [String] Custom transaction identifier.*/
	public $TransactionReference;
	/*@var [Recurrency] Transaction recurrency information.*/
	public $Recurrency;

	function __construct() {
		$this->AmountInCents = 0;
		$this->CaptureDelayInMinutes = 0;
		$this->CreditCardBrandEnum = CreditCardBrandEnum::__default;
		$this->CreditCardNumber = "";
		$this->CreditCardOperationEnum = CreditCardOperationEnum::__default;
		$this->ExpMonth = 0;
		$this->ExpYear = 0;
		$this->HolderName = "";
		$this->IataAmountInCents = 0;
		$this->InstallmentCount = 0;
		$this->InstantBuyKey = null;
		$this->PaymentMethodCode = 0;
		$this->SecurityCode = null;
		$this->ThirdPartyMerchantKey = null;
		$this->TransactionReference = null;
		$this->Recurrency = null;
	}
	
	function __tostring() {
		$str = "";
		$str .=  "AmountInCents: " . $this->AmountInCents . NEWLINE;
		$str .=  "CaptureDelayInMinutes: " . $this->CaptureDelayInMinutes . NEWLINE;
		$str .=  "CreditCardBrandEnum: " . $this->CreditCardBrandEnum . NEWLINE;
		$str .=  "CreditCardNumber: " . $this->CreditCardNumber . NEWLINE;
		$str .=  "CreditCardOperationEnum: " . $this->CreditCardOperationEnum . NEWLINE;
		$str .=  "ExpMonth: " . $this->ExpMonth . NEWLINE;
		$str .=  "ExpYear: " . $this->ExpYear . NEWLINE;
		$str .=  "HolderName: " . $this->HolderName . NEWLINE;
		$str .=  "IataAmountInCents: " . $this->IataAmountInCents . NEWLINE;
		$str .=  "InstallmentCount: " . $this->InstallmentCount . NEWLINE;
		$str .=  "InstantBuyKey: " . $this->InstantBuyKey . NEWLINE;
		$str .=  "PaymentMethodCode: " . $this->PaymentMethodCode . NEWLINE;
		$str .=  "SecurityCode: " . $this->SecurityCode . NEWLINE;
		$str .=  "ThirdPartyMerchantKey: " . $this->ThirdPartyMerchantKey . NEWLINE;
		$str .=  "TransactionReference: " . $this->TransactionReference . NEWLINE;
		$str .=  "Recurrency: " . $this->Recurrency . NEWLINE;
		
		return $str;
	}
}
