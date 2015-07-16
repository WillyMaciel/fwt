<?php
throw new Exception("This client is not implemented yet!<br>Use MundiPaggSoapServiceClient.<br>See the documentation for more details.");

//include_once constant("MP_DOCUMENT_ROOT") . "/MundiPaggServiceConfiguration.php";
include_once constant("MP_CONVERTERS") . "RestConverter.php"; // Also includes IRestConverter.php

/**
* @author: Matheus
* @version: 1.0
* revision: 2013/12/04
* 
* This client consumes the MundiPagg One Service, using Rest.
*/
class MundiPaggRestServiceClient {
	private $soapClient = null;
	private $converter = null;
	private $needToCloseClient = false;
	
	public $showXmlData = false; // For tests only. REMINDER: REMOVE THIS VARIABLE AFTER ALL TESTS ARE DONE.
		
	/**
	* @param string $wsdlUri WSDL contract location.
	* @param IRestConverter $converter The object used to convert data in requests and responses.
	* @param bool $traceSoapXml Indicates if the program must trace the Xml request and response.
	*/
	public function __construct(string $wsdlUri = NULL, IRestConverter $converter = NULL, $traceSoapXml = false) {
		// global $ENABLE_WSDL_CACHE; // Configuration Property
		
		$this->showXmlData = $traceSoapXml;
		$soap_opt = array();
		$soap_opt['encoding'] = 'UTF-8';
		$soap_opt['trace'] = $traceSoapXml;
		$soap_opt['exceptions'] = true;
		// WSDL_CACHE_NONE, WSDL_CACHE_DISK, WSDL_CACHE_MEMORY or WSDL_CACHE_BOTH
		if (constant("MP_ENABLE_WSDL_CACHE")) {
			$soap_opt['cache_wsdl'] = WSDL_CACHE_MEMORY;
		}
		else {
			$soap_opt['cache_wsdl'] = WSDL_CACHE_NONE;
		}
		//$soap_opt['soap_version'] = SOAP_1_1;
		
		global $PRODUCTION_WSDL, $SANDBOX_WSDL; // Configuration Properties
		
		if (is_null($wsdlUri)) { $wsdlUri = $PRODUCTION_WSDL; }
		if (strtoupper(trim($wsdlUri)) == 'SANDBOX') { $wsdlUri = $SANDBOX_WSDL; }
		if (strtoupper(trim($wsdlUri)) == 'PRODUCTION') { $wsdlUri = $PRODUCTION_WSDL; }
		if (is_null($converter)) { $converter = new SoapConverter(); }
		$this->converter = $converter;
		
		try {
			// Creates the soap client.
			$soapClient = new SoapClient($wsdlUri, $soap_opt);
		} catch(SoapFault $fault) {
			$this->soapClient = null;
			$this->isClosed = true;
			
			throw $fault;
		}
		
		$this->soapClient = $soapClient;
		$this->isClosed = false;
	}
		
	public function __destruct() {
		$this->Close();
	}
		
	/**
	* Closes the client.
	*/
	public function Close() {
		// If the connection is open, closes it.
		if ($this->isClosed == false) {
			try {
				$this->soapClient->close();
			} catch (Exception $ex) { }
			
			$this->soapClient = null;
			$this->converter = null;
			$this->isClosed = true;
		}
	}
	
	/**
	* Creates an order in MundiPagg One.
	* @param CreateOrderRequest $createOrderRequest The order to be created.
	*/
	public function CreateOrder(CreateOrderRequest $createOrderRequest) {
		$this->ThrowExceptionIfClosed();
		
		if (is_null($createOrderRequest)) { return null; }
		
		// Converts the request to be sent by the SoapClient.
		$request = $this->converter->ConvertOrderRequest($createOrderRequest);
		
		try {
			// Executes the method.
			$result = $this->soapClient->CreateOrder($request);
		} catch (SoapFault $fault) {
			throw $fault;
		}

		$this->WriteXml($this->soapClient);
		
		$createOrderResponse = $result->CreateOrderResult;
		
		// Converts and returns the response.
		return $this->converter->ConvertOrderResponse($createOrderResponse);
	}

	/**
	* Manages an order in MundiPagg One.
	* @param ManageOrderRequest $manageOrderRequest The order to be managed.
	*/
	public function ManageOrder(ManageOrderRequest $manageOrderRequest) {
		$this->ThrowExceptionIfClosed();

		if (is_null($manageOrderRequest)) { return null; }
		
		// Converts the request to be sent by the SoapClient.
		$request = $this->converter->ConvertManageOrderRequest($manageOrderRequest);
		
		try {
			// Executes the method.
			$result = $this->soapClient->ManageOrder($request);
		} catch (SoapFault $fault) {
			throw $fault;
		}

		$this->WriteXml($this->soapClient);
		
		$manageOrderResponse = $result->ManageOrderResult;
		
		// Converts and returns the response.
		return $this->converter->ConvertManageOrderResponse($manageOrderResponse);
	}
	
	/**
	* Retries an order in MundiPagg One.
	* @param RetryOrderRequest $retryOrderRequest The order to be retried.
	*/
	public function RetryOrder(RetryOrderRequest $retryOrderRequest) {
		$this->ThrowExceptionIfClosed();
		
		if (is_null($retryOrderRequest)) { return null; }
		
		// Converts the request to be sent by the SoapClient.
		$request = $this->converter->ConvertRetryOrderRequest($retryOrderRequest);
		
		try {
			// Executes the method.
			$result = $this->soapClient->RetryOrder($request);
		} catch (SoapFault $fault) {
			throw $fault;
		}

		$this->WriteXml($this->soapClient);
		
		$retryOrderResponse = $result->RetryOrderResult;
		
		// Converts and returns the response.
		return $this->converter->ConvertRetryOrderResponse($retryOrderResponse);
	}
	
	/**
	* Returns all information about an order in MundiPagg One.
	* @param QueryOrderRequest $queryOrderRequest The order to be returned.
	*/
	public function QueryOrder(QueryOrderRequest $queryOrderRequest) {
		$this->ThrowExceptionIfClosed();
		
		if (is_null($queryOrderRequest)) { return null; }
		
		// Converts the request to be sent by the SoapClient.
		$request = $this->converter->ConvertQueryOrderRequest($queryOrderRequest);
		
		try {
			// Executes the method.
			$result = $this->soapClient->QueryOrder($request);
		} catch (SoapFault $fault) {
			throw $fault;
		}

		$this->WriteXml($this->soapClient);
		
		$queryOrderResponse = $result->QueryOrderResult;
		
		// Converts and returns the response.
		return $this->converter->ConvertQueryOrderResponse($queryOrderResponse);
	}

	/**
	* Returns information about a buyer's credit cards.
	* @param GetInstantBuyDataRequest $getInstantBuyDataRequest The order to be created.
	*/
	public function GetInstantBuyData(GetInstantBuyDataRequest $getInstantBuyDataRequest) {
		$this->ThrowExceptionIfClosed();
		
		if (is_null($getInstantBuyDataRequest)) { return null; }
		
		// Converts the request to be sent by the SoapClient.
		$request = $this->converter->ConvertGetInstantBuyDataRequest($getInstantBuyDataRequest);
		
		try {
			// Executes the method.
			$result = $this->soapClient->GetInstantBuyData($request);
		} catch (SoapFault $fault) {
			throw $fault;
		}

		$this->WriteXml($this->soapClient);
		
		$getInstantBuyDataResponse = $result->GetInstantBuyDataResult;
		
		// Converts and returns the response.
		return $this->converter->ConvertGetInstantBuyDataResponse($getInstantBuyDataResponse);
	}
	
	/* For tests only. Writes the xml request in a file. REMINDER: Remove after all tests are done.*/
	private function WriteXml($soapClient) {
		if (!$this->showXmlData) { return; }
		$requestLocation = 'C:\Users\mriboli\Desktop\PHP_SoapRequest.xml';
		$responseLocation = 'C:\Users\mriboli\Desktop\PHP_SoapResponse.xml';
		$request = $soapClient->__getLastRequest();
		$response = $soapClient->__getLastResponse();
		
		unlink($requestLocation);
		$fr = fopen($requestLocation, 'w');
		fwrite($fr, $request);
		fclose($fr);
		
		unlink($responseLocation);
		$fr = fopen($responseLocation, 'w');
		fwrite($fr, $response);
		fclose($fr);
		
		echo "Request:" . NEWLINE;
		echo html_entity_decode( $request);
		echo NEWLINE . NEWLINE . "Response:" . NEWLINE;
		echo html_entity_decode( $response);
	}
	
	/**
	* Throws an exception if the client is closed.
	*/
	private function ThrowExceptionIfClosed() {
		if ($this->isClosed) { throw new Exception("The client is closed!"); }
	}
}
