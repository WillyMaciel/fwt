<?php

//include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "Enum.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "OnlineDebitRequest.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "OrderRequest.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "BuyerRequest.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "PhoneRequest.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "BuyerAddressRequest.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "OnlineDebitResult.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "ErrorReport.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "ErrorItem.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "QueryOrderResponse.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "OrderData.php";
include_once constant("MP_DATA_CONTRACTS_DEBIT") . "OnlineDebitTransactionData.php";

/** Debit Converters Interface
*/
interface IDebitConverter {

	// Request Converters
	public function ConvertFromOnlineDebitRequest(OnlineDebitRequest $onlineDebitRequest);
	public function ConvertFromOrderRequest(OrderRequest $orderRequest);
	public function ConvertFromBuyerRequest(BuyerRequest $buyerRequest);
	public function ConvertFromPhoneRequestCollection(array $phoneRequestCollection);
	public function ConvertFromPhoneRequest(PhoneRequest $phoneRequest);
	public function ConvertFromBuyerAddressRequestCollection(array $buyerAddressCollection);
	public function ConvertFromBuyerAddressRequest(BuyerAddressRequest $buyerAddressRequest);

	// Response Converters
	public function ConvertToOnlineDebitResult($response);
	public function ConvertToErrorReport($response);
	public function ConvertToErrorItemCollection(array $responseArray);
	public function ConvertToErrorItem($response);
	public function ConvertToQueryOrderResponse($response);
	public function ConvertToOrderDataCollection(array $responseArray);
	public function ConvertToOrderData($response);
	public function ConvertToOnlineDebitTransactionDataCollection(array $responseArray);
	public function ConvertToOnlineDebitTransactionData($response);
}
