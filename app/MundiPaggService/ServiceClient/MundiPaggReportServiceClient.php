<?php
// include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once "IMundiPaggReportServiceClient.php";
include_once constant("MP_CONVERTERS") . "DebitConverter.php"; // Also includes IDebitConverter.php
include_once constant("MP_HELPERS") . "BasicHttpClient.php"; // Also includes IHttpClient.php

/**
* @author: Matheus
* @version: 1.0
* revision: 2014/09/09
*/
class MundiPaggReportServiceClient implements IMundiPaggReportServiceClient {

	const GET_STREAM_RESOURCE = "/TransactionReportFile/GetStream?fileDate=";
	const GET_BYTES_RESOURCE = "/TransactionReportFile/GetBytes?fileDate=";
	const DATE_FORMAT = "Ymd";

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

	private $httpClient = NULL;
	public function GetHttpClient() {

		if (is_null($this->httpClient) == true) { $this->httpClient = new BasicHttpClient(); }
		return $this->httpClient;
	}


	function __construct($serviceUri = NULL, $operationTimeout = NULL, IHttpClient $httpClient = NULL) {

		$this->serviceUri = $serviceUri;
		$this->operationTimeout = $operationTimeout;
		$this->httpClient = $httpClient;
	}

	public function SaveReportFile(DateTime $fileDate, $filename, $merchantKey = NULL) {

		$responseContent = $this->GetStream($fileDate, $merchantKey);

		$fr = fopen($filename, 'w');
		fwrite($fr, $responseContent);
		fclose($fr);
	}

	public function GetStream(DateTime $fileDate, $merchantKey = NULL) {

		if (is_null($merchantKey) == true) {

			$merchantKey = constant("MP_MERCHANT_KEY");
		}

		$serviceUri = $this->GetServiceUri() . self::GET_STREAM_RESOURCE . $fileDate->format(self::DATE_FORMAT);

		$responseStream = $this->SendGetRequest($serviceUri, $merchantKey);

		return $responseStream;
	}

	public function GetBytes(DateTime $fileDate, $merchantKey = NULL) {

		if (is_null($merchantKey) == true) {

			$merchantKey = constant("MP_MERCHANT_KEY");
		}
		
		$serviceUri = $this->GetServiceUri() . self::GET_BYTES_RESOURCE . $fileDate->format(self::DATE_FORMAT);

		$responseStream = $this->SendGetRequest($serviceUri, $merchantKey);

		return $responseStream;
	}

	private function SendGetRequest($uri, $merchantKey, $isBinaryResponse = false) {

		$httpHeader = array('MerchantKey: ' . $merchantKey);

		$httpClient = $this->GetHttpClient();
		$httpClient->SetUri($uri);
		$httpClient->SetOperationTimeout($this->GetOperationTimeout());
		$httpClient->SetHttpHeader($httpHeader);

		$httpResponse = $httpClient->GetData(null, null, null, $isBinaryResponse);

		return $httpResponse->ResponseContent;
	}
}
