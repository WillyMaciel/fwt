<?php
include_once "Enum.php";
include_once "CreditCardTransactionData.php";
include_once "BoletoTransactionData.php";


class OrderData {
	/*@var [DateTime] Order Creation Date*/
	public $CreateDate;
	/*@var [Guid] Order Key*/
	public $OrderKey; 
	/*@var [string] Order Reference*/
	public $OrderReference;
	/*@var [OrderStatusEnum] Order Status */
	public $OrderStatusEnum;
	/*@var [CreditCardTransactionData] CreditCard Transaction Data Collection  */
	public $CreditCardTransactionDataCollection;
	/*@var [BoletoTransactionData] Boleto Transaction Data Collection*/
	public $BoletoTransactionDataCollection;
	
	function __construct() {
		$this->CreateDate = null;
		$this->OrderKey = null;
		$this->OrderReference = "";
		$this->OrderStatusEnum = OrderStatusEnum::__default;
		$this->CreditCardTransactionDataCollection = null;
		$this->BoletoTransactionDataCollection = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "CreateDate: " . $this->CreateDate . NEWLINE;
		$str .=  "OrderKey: " . $this->OrderKey . NEWLINE;
		$str .=  "OrderReference: " . $this->OrderReference . NEWLINE;
		$str .=  "OrderStatusEnum: " . $this->OrderStatusEnum . NEWLINE;
		
		if (is_array($this->CreditCardTransactionDataCollection)) {
			foreach($this->CreditCardTransactionDataCollection as $ccTransData) {
				$str .= $ts . "CreditCardTransactionData: " . $te . $ccTransData . NEWLINE;
			}
		}
		
		if (is_array($this->BoletoTransactionDataCollection)) {
			foreach($this->BoletoTransactionDataCollection as $boletoTransData) {
				$str .= $ts . "BoletoTransactionData: " . $te . $boletoTransData . NEWLINE;
			}
		}

		return $str;
	}
}
