<?php
// include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once "IMundiPaggDebitServiceClient.php";
include_once constant("MP_CONVERTERS") . "DebitConverter.php"; // Also includes IDebitConverter.php
include_once constant("MP_HELPERS") . "BasicHttpClient.php"; // Also includes IHttpClient.php

/**
* @author: Matheus
* @version: 1.0
* revision: 2014/09/09
*/
class MundiPaggDebitServiceClient implements IMundiPaggDebitServiceClient {

	const CREATE_ORDER_RESOURCE = "/Order/OnlineDebit/";
	const QUERY_ORDER_RESOURCE = "/Order/OnlineDebit/Query/";

	private $serviceUri = NULL;
	public function GetServiceUri() {

		if (is_null($this->serviceUri) == true) {

			$this->serviceUri = constant("MP_DEBIT_SERVICE_URI");
		}
		return $this->serviceUri;
	}

	private $operationTimeout = NULL;
	public function GetOperationTimeout() {

		if (is_null($this->operationTimeout) == true) {

			$this->operationTimeout = constant("MP_OPERATION_TIME_OUT");
		}
		return $this->operationTimeout;
	}

	private $converter = NULL;
	public function GetDebitConverter() {

		if (is_null($this->converter) == true) { $this->converter = new DebitConverter(); }
		return $this->converter;
	}

	private $httpClient = NULL;
	public function GetHttpClient() {

		if (is_null($this->httpClient) == true) { $this->httpClient = new BasicHttpClient(); }
		return $this->httpClient;
	}


	function __construct($serviceUri = NULL, $operationTimeout = NULL, IDebitConverter $converter = NULL, IHttpClient $httpClient = NULL) {

		$this->serviceUri = $serviceUri;
		$this->converter = $converter;
		$this->operationTimeout = $operationTimeout;
		$this->httpClient = $httpClient;
	}

	/**
	* Creates an order.
	* @param OnlineDebitRequest $onlineDebitRequest The order to be created.
	*/
	public function CreateOrder(OnlineDebitRequest $onlineDebitRequest) {

		$converter = $this->GetDebitConverter();

		$requestArray = $converter->ConvertFromOnlineDebitRequest($onlineDebitRequest);

		$serviceUri = $this->GetServiceUri() . MundiPaggDebitServiceClient::CREATE_ORDER_RESOURCE;

		$responseArray = $this->SendPostRequest($serviceUri, $requestArray);

		$onlineDebitResponse = $converter->ConvertToOnlineDebitResult($responseArray);

		return $onlineDebitResponse;
	}

	public function QueryOrder($orderIdentification, $merchantKey = NULL) {

		if (is_null($orderIdentification) == true || is_string($orderIdentification) == false) {

			throw new InvalidArgumentException("OrderIdentification must be a string.");
		}

		if (is_null($merchantKey) == true) {

			$merchantKey = constant("MP_MERCHANT_KEY");
		}

		$serviceUri = $this->GetServiceUri() . MundiPaggDebitServiceClient::QUERY_ORDER_RESOURCE . urlencode($orderIdentification);

		$responseArray = $this->SendGetRequest($serviceUri, $merchantKey);

		$converter = $this->GetDebitConverter();

		$onlineDebitResponse = $converter->ConvertToQueryOrderResponse($responseArray);

		return $onlineDebitResponse;
	}

	private function SendGetRequest($uri, $merchantKey) {

		$httpHeader = array('Accept: application/json', 'MerchantKey: ' . $merchantKey);

		$httpClient = $this->GetHttpClient();
		$httpClient->SetUri($uri);
		$httpClient->SetOperationTimeout($this->GetOperationTimeout());
		$httpClient->SetHttpHeader($httpHeader);

		$httpResponse = $httpClient->GetData();
		//$httpResponse = $httpClient->GetData($uri, $this->GetOperationTimeout(), $httpHeader, $httpStatusCode);

		$responseArray = json_decode($httpResponse->ResponseContent);

		return $responseArray;		
	}

	private function SendPostRequest($uri, array $requestArray) {

		$postData = json_encode($requestArray, JSON_PRETTY_PRINT);

		$httpHeader = array('Content-Type: application/json', 'Accept: application/json');

		$httpClient = $this->GetHttpClient();
		$httpClient->SetUri($uri);
		$httpClient->SetOperationTimeout($this->GetOperationTimeout());
		$httpClient->SetHttpHeader($httpHeader);

		$httpResponse = $httpClient->PostData($postData);
		//$httpResponse = $httpClient->PostData($postDat, $uri, $this->GetOperationTimeout(), $httpHeader);

		$responseArray = json_decode($httpResponse->ResponseContent);

		return $responseArray;
	}
}
