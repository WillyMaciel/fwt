<?php
// include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once constant("MP_CONVERTERS") . "SoapConverter.php"; // Also includes ISoapConverter.php

/**
* @author: Matheus
* @version: 1.0
* revision: 2013/12/04
*/
interface IMundiPaggServiceClient {

	/**
	* Closes the client.
	*/
	public function Close();
	
	/**
	* Creates an order in MundiPagg One.
	* @param CreateOrderRequest $createOrderRequest The order to be created.
	*/
	public function CreateOrder(CreateOrderRequest $createOrderRequest);

	/**
	* Manages an order in MundiPagg One.
	* @param ManageOrderRequest $manageOrderRequest The order to be managed.
	*/
	public function ManageOrder(ManageOrderRequest $manageOrderRequest);
	
	/**
	* Retries an order in MundiPagg One.
	* @param RetryOrderRequest $retryOrderRequest The order to be retried.
	*/
	public function RetryOrder(RetryOrderRequest $retryOrderRequest);
	
	/**
	* Returns all information about an order in MundiPagg One.
	* @param QueryOrderRequest $queryOrderRequest The order to be returned.
	*/
	public function QueryOrder(QueryOrderRequest $queryOrderRequest);

	/**
	* Returns information about a buyer's credit cards.
	* @param GetInstantBuyDataRequest $getInstantBuyDataRequest The order to be created.
	*/
	public function GetInstantBuyData(GetInstantBuyDataRequest $getInstantBuyDataRequest);
}
