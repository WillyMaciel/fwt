<?php
// include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once constant("MP_CONVERTERS") . "IDebitConverter.php";

/**
* @author: Matheus
* @version: 1.0
* revision: 2014/09/09
*/
interface IMundiPaggDebitServiceClient {

	/**
	* Creates an order.
	* @param OnlineDebitRequest $onlineDebitRequest The order to be created.
	*/
	public function CreateOrder(OnlineDebitRequest $onlineDebitRequest);

	/**
	* Gets an order.
	* @param String $orderIdentification The order to be returned.
	* @param Guid $merchantKey (Optional) The merchant identification.
	*/
	public function QueryOrder($orderIdentification, $merchantKey = NULL);
}
