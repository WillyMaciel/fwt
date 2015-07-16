<?php
include_once "CreditCardData.php";

class GetInstantBuyDataResponse {
	/*@var [integer] CreditCard Data Count*/
	public $CreditCardDataCount;
	/*@var [long] Mundipagg Time In Milliseconds */	
	public $MundiPaggTimeInMilliseconds;
	/*@var [Guid] Request Key*/
	public $RequestKey;
	/*@var [bool] Fail or Success */
	public $Success;
	/*@var [CreditCardData] CreditCard Data Collection */
	public $CreditCardDataCollection;
	/*@var [MundiPaggSuggestion] Mundipagg Suggestion */
	public $MundiPaggSuggestion;
	/*@var [ErrorReport] Error Report */
	public $ErrorReport;
	
	function __construct() {
		$this->CreditCardDataCount = 0;
		$this->MundiPaggTimeInMilliseconds = 0;
		$this->RequestKey = null;
		$this->Success = false;
		$this->CreditCardDataCollection = null;
		$this->MundiPaggSuggestion = null;
		$this->ErrorReport = null;
	}
	
	function __tostring() {
		$str = "";
		$ts = '<font color="#0000FF">';
		$te = '</font>';
		
		$str .=  "CreditCardDataCount: " . $this->CreditCardDataCount . NEWLINE;
		$str .=  "MundiPaggTimeInMilliseconds: " . $this->MundiPaggTimeInMilliseconds . NEWLINE;
		$str .=  "RequestKey: " . $this->RequestKey . NEWLINE;
		$str .=  "Success: " . $this->Success . NEWLINE;
		
		if (is_array($this->CreditCardDataCollection)) {
			foreach($this->CreditCardDataCollection as $ccTransData) {
				$str .= $ts . "CreditCardData: " . $te . $ccTransData . NEWLINE;
			}
		}
		
		$str .=  "MundiPaggSuggestion: " . $this->MundiPaggSuggestion . NEWLINE;
		$str .=  "ErrorReport: " . $this->ErrorReport . NEWLINE;

		return $str;
	}
}
