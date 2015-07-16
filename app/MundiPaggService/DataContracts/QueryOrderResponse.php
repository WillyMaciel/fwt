<?php
include_once "OrderData.php";

class QueryOrderResponse {
	/*@var [long] MundiPagg Time In Milliseconds*/
	public $MundiPaggTimeInMilliseconds;
	/*@var [integer] Order Data Count*/
	public $OrderDataCount; 
	/*@var [Guid] Request key*/
	public $RequestKey;
	/*@var [bool] Fail or Success*/
	public $Success;
	/*@var [OrderData] Order Data Collection*/
	public $OrderDataCollection;
	/*@var [MundiPaggSuggestion] MundiPagg Suggestion */
	public $MundiPaggSuggestion;
	/*@var [ErrorReport] Error Report */
	public $ErrorReport;
	
	function __construct() {
		$this->MundiPaggTimeInMilliseconds = null;
		$this->OrderDataCount = 0;
		$this->RequestKey = null;
		$this->Success = false;
		$this->OrderDataCollection = null;
		$this->MundiPaggSuggestion = null;
		$this->ErrorReport = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "MundiPaggTimeInMilliseconds: " . $this->MundiPaggTimeInMilliseconds . NEWLINE;
		$str .=  "OrderDataCount: " . $this->OrderDataCount . NEWLINE;
		$str .=  "RequestKey: " . $this->RequestKey . NEWLINE;
		$str .=  "Success: " . $this->Success . NEWLINE;
		
		if (is_array($this->OrderDataCollection)) {
			foreach($this->OrderDataCollection as $orderData) {
				$str .= $ts . "OrderData: " . $te . $orderData . NEWLINE;
			}
		}
		
		$str .=  "MundiPaggSuggestion: " . $this->MundiPaggSuggestion . NEWLINE;
		$str .=  "ErrorReport: " . $this->ErrorReport . NEWLINE;
		
		return $str;
	}
}
