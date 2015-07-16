<?php

include_once "OrderData.php";

class QueryOrderResponse {

	/*@var [List<OrderData>] Order data collection*/
	public $OrderDataCollection;

	/*@var [Nullable<Long>] MundiPagg Process time*/
	public $MundiPaggTimeInMilliseconds;

	/*@var [Bool] Success*/
	public $Success;

	/*@var [ErrorReport] Errors*/
	public $ErrorReport;

	function __construct() {

		$this->OrderDataCollection = null;
		$this->MundiPaggTimeInMilliseconds = null;
		$this->Success = false;
		$this->ErrorReport = null;
	}
}
