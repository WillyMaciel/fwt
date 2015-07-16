<?php
include_once "Enum.php";
	


class BoletoTransaction {
	/** @var [Long] Transaction amount in cents*/
	public $AmountInCents;
	/** @var [Integer] Bank code*/
	public $BankNumber;
	/** @var [Integer] How many days after the creation the boleto will be valid.
	* @param Default: 7*/
	public $DaysToAddInBoletoExpirationDate; // Nullable<int>
	/** @var [String] */
	public $Instructions; 
	/** @var [Integer] Number used to identify the boleto */
	public $NossoNumero; 
	/** @var  [Long] Custom transaction identifier.*/
	public $TransactionReference; 
	
	function __construct() {
		$this->AmountInCents = 0;
		$this->BankNumber = null;
		$this->DaysToAddInBoletoExpirationDate = 0;
		$this->Instructions = "";
		$this->NossoNumero = null;
		$this->TransactionReference = null;
	}
	
	function __tostring() {
		$str = "";
		$str .=  "AmountInCents: " . $this->AmountInCents . NEWLINE;
		$str .=  "BankNumber: " . $this->BankNumber . NEWLINE;
		$str .=  "DaysToAddInBoletoExpirationDate: " . $this->DaysToAddInBoletoExpirationDate . NEWLINE;
		$str .=  "Instructions: " . $this->Instructions . NEWLINE;
		$str .=  "NossoNumero: " . $this->NossoNumero . NEWLINE;
		$str .=  "TransactionReference: " . $this->TransactionReference . NEWLINE;
		
		return $str;
	}
}
