<?php
include_once "Enum.php";

class BoletoTransactionData {
	/*@var [long] Transaction amount in cents */
	public $AmountInCents;
	/*@var [long] Amount paid in cents */
	public $AmountPaidInCents;
	/*@var [string] Bank code*/
	public $BankNumber;
	/*@var [string] Barcode of boleto*/
	public $Barcode;
	/*@var [BoletoTransactionStatusEnum] Boleto Transaction status */
	public $BoletoTransactionStatusEnum;
	/*@var [string] Boleto URL */
	public $BoletoUrl; 
	/*@var [DateTime]  Date of Boleto creation */
	public $CreateDate; 
	/*@var [string] Custom Status*/
	public $CustomStatus;
	/*@var [DateTime]  Date of boleto Expiration*/
	public $ExpirationDate; 
	/*@var [string] Number used to identify the boleto */
	public $NossoNumero;
	/*@var [Guid] The Transaction Key*/
	public $TransactionKey;
	/*@var [string] The Transaction Reference*/
	public $TransactionReference;
	
	function __construct() {
		$this->AmountInCents = 0;
		$this->AmountPaidInCents = 0;
		$this->BankNumber = "";
		$this->Barcode = "";
		$this->BoletoTransactionStatusEnum = BoletoTransactionStatusEnum::__default;
		$this->BoletoUrl = "";
		$this->CreateDate = null;
		$this->CustomStatus = "";
		$this->ExpirationDate = null;
		$this->NossoNumero = "";
		$this->TransactionKey = null;
		$this->TransactionReference = "";
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "AmountInCents: " . $this->AmountInCents . NEWLINE;
		$str .=  "AmountPaidInCents: " . $this->AmountPaidInCents . NEWLINE;
		$str .=  "BankNumber: " . $this->BankNumber . NEWLINE;
		$str .=  "Barcode: " . $this->Barcode . NEWLINE;
		$str .=  "BoletoTransactionStatusEnum: " . $this->BoletoTransactionStatusEnum . NEWLINE;
		$str .=  "BoletoUrl: " . $this->BoletoUrl . NEWLINE;
		$str .=  "CreateDate: " . $this->CreateDate . NEWLINE;
		$str .=  "CustomStatus: " . $this->CustomStatus . NEWLINE;
		$str .=  "ExpirationDate: " . $this->ExpirationDate . NEWLINE;
		$str .=  "NossoNumero: " . $this->NossoNumero . NEWLINE;
		$str .=  "TransactionKey: " . $this->TransactionKey . NEWLINE;
		$str .=  "TransactionReference: " . $this->TransactionReference . NEWLINE;
		
		return $str;
	}
}
