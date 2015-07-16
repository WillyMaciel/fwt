<?php

interface IHttpClient {

	public function GetUri();
	public function SetUri($uri);

	public function GetOperationTimeout();
	public function SetOperationTimeout($operationTimeout);

	public function GetHttpHeader();
	public function SetHttpHeader(array $httpHeader);

	public function GetData($uri = null, $operationTimeout = null, $httpHeader = null, $isBinaryResponse = false);
	public function PostData($postData, $uri = null, $operationTimeout = null, $httpHeader = null, $isBinaryResponse = false);
}
