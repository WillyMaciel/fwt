<?php
include_once "IHttpClient.php";
include_once "HttpResponse.php";

class BasicHttpClient implements IHttpClient {

	private $serviceUri = null;
	public function GetUri() {
		return $this->serviceUri;
	}
	public function SetUri($uri) {

		$this->ValidateUri($uri);

		$this->serviceUri = $uri;
	}

	private $operationTimeout = null;
	public function GetOperationTimeout() {
		return $this->operationTimeout;
	}
	public function SetOperationTimeout($operationTimeout) {

		$this->ValidateOperationTimeout($operationTimeout);

		$this->operationTimeout = $operationTimeout;
	}

	private $httpHeader = null;
	public function GetHttpHeader() {
		return $this->httpHeader;
	}
	public function SetHttpHeader(array $httpHeader) {

		$this->ValidateHttpHeader($httpHeader);

		$this->httpHeader = $httpHeader;
	}

	public function GetData($uri = null, $operationTimeout = null, $httpHeader = null, $isBinaryResponse = false) {

		if (is_null($uri) == true) { $uri = $this->GetUri(); }
		if (is_null($operationTimeout) == true) { $operationTimeout = $this->GetOperationTimeout(); }
		if (is_null($httpHeader) == true) { $httpHeader = $this->GetHttpHeader(); }

		$this->ValidateUri($uri);
		$this->ValidateOperationTimeout($operationTimeout);
		$this->ValidateHttpHeader($httpHeader);

		$client = curl_init();

		curl_setopt($client, CURLOPT_URL, $uri);
		curl_setopt($client, CURLOPT_HEADER, 0);
		if (is_null($httpHeader) == false) {
			curl_setopt($client, CURLOPT_HTTPHEADER, $httpHeader);
		}
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

		if ($isBinaryResponse == true) {
			curl_setopt($client, CURLOPT_BINARYTRANSFER, 1);
		}
		
		if (is_null($operationTimeout) == false) {
			curl_setopt($client, CURLOPT_CONNECTTIMEOUT, $operationTimeout);
		}
		curl_setopt($client, CURLOPT_FAILONERROR, 1);

		curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($client, CURLOPT_SSL_VERIFYHOST, false);

		$clientResponse = curl_exec($client);
		
		$httpStatusCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
		$effectiveUrl = curl_getinfo($client, CURLINFO_EFFECTIVE_URL);
		$totalTimeInSeconds = curl_getinfo($client, CURLINFO_TOTAL_TIME);

		if ($clientResponse === false) {

			$clientResponse = null;
		}

		curl_close($client);

		$httpResponse = new HttpResponse();
		$httpResponse->HttpStatusCode = $httpStatusCode;
		$httpResponse->ResponseContent = $clientResponse;
		$httpResponse->RequestUri = $uri;
		$httpResponse->EffectiveUri = $effectiveUrl;
		$httpResponse->TotalTimeInSeconds = $totalTimeInSeconds;

		return $httpResponse;
	}

	public function PostData($postData, $uri = null, $operationTimeout = null,  $httpHeader = null, $isBinaryResponse = false) {

		if (is_null($uri) == true) { $uri = $this->GetUri(); }
		if (is_null($operationTimeout) == true) { $operationTimeout = $this->GetOperationTimeout(); }
		if (is_null($httpHeader) == true) { $httpHeader = $this->GetHttpHeader(); }

		$this->ValidateUri($uri);
		$this->ValidateOperationTimeout($operationTimeout);
		$this->ValidateHttpHeader($httpHeader);

		$client = curl_init();

		curl_setopt($client, CURLOPT_URL, $uri);
		if (is_null($httpHeader) == false) {
			curl_setopt($client, CURLOPT_HTTPHEADER, $httpHeader);
		}
		curl_setopt($client, CURLOPT_POST, 1);
		curl_setopt($client, CURLOPT_HTTPHEADER, $httpHeader);
		curl_setopt($client, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
		
		if ($isBinaryResponse == true) {
			curl_setopt($resource, CURLOPT_BINARYTRANSFER, 1);
		}
		
		if (is_null($operationTimeout) == false) {
			curl_setopt($client, CURLOPT_CONNECTTIMEOUT, $operationTimeout);
		}
		curl_setopt($client, CURLOPT_FAILONERROR, 1);

		curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($client, CURLOPT_SSL_VERIFYHOST, false);

		$clientResponse = curl_exec($client);
		
		$httpStatusCode = curl_getinfo($client, CURLINFO_HTTP_CODE);
		$effectiveUrl = curl_getinfo($client, CURLINFO_EFFECTIVE_URL);
		$totalTimeInSeconds = curl_getinfo($client, CURLINFO_TOTAL_TIME);

		if ($clientResponse === false) {

			$clientResponse = null;
		}

		curl_close($client);

		$httpResponse = new HttpResponse();
		$httpResponse->HttpStatusCode = $httpStatusCode;
		$httpResponse->ResponseContent = $clientResponse;
		$httpResponse->RequestUri = $uri;
		$httpResponse->EffectiveUri = $effectiveUrl;
		$httpResponse->TotalTimeInSeconds = $totalTimeInSeconds;

		return $httpResponse;
	}

	private function ValidateUri($uri) {

		if (is_null($uri) == true) { throw new InvalidArgumentException("The service URI can not be null."); }

		if (is_string($uri) == false) { throw new InvalidArgumentException("The service URI must be a string."); }
	}
	private function ValidateOperationTimeout($operationTimeout) {

		if (is_integer($operationTimeout) == false) { throw new InvalidArgumentException("The OperationTimeout must be an integer."); }
	}
	private function ValidateHttpHeader($httpHeader) {

		if (is_null($httpHeader) == false) {

			if (is_array($httpHeader) == false) { throw new InvalidArgumentException("The HttpHeader must be an array."); }

			foreach ($httpHeader as $value) {

				if (is_null($value) == true || is_string($value) == false) { throw new InvalidArgumentException("The HttpHeader must be an array composed of strings."); }
			}
		}
	}
}
