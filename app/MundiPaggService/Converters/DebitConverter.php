<?php

include_once "IDebitConverter.php";

class DebitConverter implements IDebitConverter {

	// Request Converters
	public function ConvertFromOnlineDebitRequest(OnlineDebitRequest $onlineDebitRequest) {

		$requestArray = array();
		$requestArray["MerchantKey"] = $onlineDebitRequest->MerchantKey;
		$requestArray["PaymentMethod"] = $onlineDebitRequest->PaymentMethod;
		$requestArray["AmountInCents"] = $onlineDebitRequest->AmountInCents;
		$requestArray["TransactionReference"] = $onlineDebitRequest->TransactionReference;
		if(is_null($onlineDebitRequest->InstallmentCount) == false) {

			$requestArray["InstallmentCount"] = $onlineDebitRequest->InstallmentCount;
		}

		if (is_null($onlineDebitRequest->OrderRequest) == false) {

			$requestArray["OrderRequest"] = $this->ConvertFromOrderRequest($onlineDebitRequest->OrderRequest);
		}

		if (is_null($onlineDebitRequest->Buyer) == false) {

			$requestArray["Buyer"] = $this->ConvertFromBuyerRequest($onlineDebitRequest->Buyer);
		}

		return $requestArray;
	}

	public function ConvertFromOrderRequest(OrderRequest $orderRequest) {

		$requestArray = array();
		if(is_null($orderRequest->AmountInCents) == false) {

			$requestArray["AmountInCents"] = $orderRequest->AmountInCents;
		}

		$requestArray["OrderReference"] = $orderRequest->OrderReference;

		return $requestArray;
	}

	public function ConvertFromBuyerRequest(BuyerRequest $buyerRequest) {

		$requestArray = array();
		$requestArray["TaxDocumentNumber"] = $buyerRequest->TaxDocumentNumber;
		$requestArray["TaxDocumentTypeEnum"] = $buyerRequest->TaxDocumentTypeEnum;
		$requestArray["BuyerReference"] = $buyerRequest->BuyerReference;

		if(is_null($buyerRequest->PersonTypeEnum) == false) {

			$requestArray["PersonTypeEnum"] = $buyerRequest->PersonTypeEnum;
		}


		$requestArray["Name"] = $buyerRequest->Name;

		if(is_null($buyerRequest->GenderEnum) == false) {

			$requestArray["GenderEnum"] = $buyerRequest->GenderEnum;
		}

		$requestArray["Email"] = $buyerRequest->Email;
		$requestArray["FacebookId"] = $buyerRequest->FacebookId;
		$requestArray["TwitterId"] = $buyerRequest->TwitterId;

		if(is_null($buyerRequest->IpAddress) == false) {

			$requestArray["IpAddress"] = $buyerRequest->IpAddress;
		}

		if (is_null($buyerRequest->PhoneRequestCollection) == false && count($buyerRequest->PhoneRequestCollection) > 0) {

			$requestArray["PhoneRequestCollection"] = $this->ConvertFromPhoneRequestCollection($buyerRequest->PhoneRequestCollection);
		}

		if (is_null($buyerRequest->BuyerAddressCollection) == false && count($buyerRequest->BuyerAddressCollection) > 0) {

			$requestArray["BuyerAddressCollection"] = $this->ConvertFromBuyerAddressRequestCollection($buyerRequest->BuyerAddressCollection);
		}

		return $requestArray;
	}

	public function ConvertFromPhoneRequestCollection(array $phoneRequestCollection) {

		$requestArray = array();

		$counter = 0;

		foreach($phoneRequestCollection as $key => $value) {

			if (is_a($value, 'PhoneRequest') == false) { throw new InvalidArgumentException("The collection can only contain objects of type PhoneRequest."); }

			$phoneRequest = $this->ConvertFromPhoneRequest($value);
			$requestArray[$counter] = $phoneRequest;

			$counter++;
		}

		return $requestArray;
	}

	public function ConvertFromPhoneRequest(PhoneRequest $phoneRequest) {

		$requestArray = array();
		$requestArray["CountryCode"] = $phoneRequest->CountryCode;
		$requestArray["AreaCode"] = $phoneRequest->AreaCode;
		$requestArray["PhoneNumber"] = $phoneRequest->PhoneNumber;
		$requestArray["Extension"] = $phoneRequest->Extension;

		if(is_null($phoneRequest->PhoneTypeEnum) == false) {

			$requestArray["PhoneTypeEnum"] = $phoneRequest->PhoneTypeEnum;
		}

		return $requestArray;
	}

	public function ConvertFromBuyerAddressRequestCollection(array $buyerAddressCollection) {

		$requestArray = array();

		$counter = 0;

		foreach($buyerAddressCollection as $key => $value) {

			if (is_a($value, 'BuyerAddressRequest') == false) { throw new InvalidArgumentException("The collection can only contain objects of type BuyerAddressRequest."); }

			$buyerAddressRequest = $this->ConvertFromBuyerAddressRequest($value);
			$requestArray[$counter] = $buyerAddressRequest;

			$counter++;
		}

		return $requestArray;
	}

	public function ConvertFromBuyerAddressRequest(BuyerAddressRequest $buyerAddressRequest) {

		$requestArray = array();

		if(is_null($buyerAddressRequest->CountryEnum) == false) {

			$requestArray["CountryEnum"] = $buyerAddressRequest->CountryEnum;
		}

		$requestArray["State"] = $buyerAddressRequest->State;
		$requestArray["City"] = $buyerAddressRequest->City;
		$requestArray["District"] = $buyerAddressRequest->District;
		$requestArray["Street"] = $buyerAddressRequest->Street;
		$requestArray["Number"] = $buyerAddressRequest->Number;
		$requestArray["Complement"] = $buyerAddressRequest->Complement;
		$requestArray["ZipCode"] = $buyerAddressRequest->ZipCode;

		if(is_null($buyerAddressRequest->AddressTypeEnum) == false) {

			$requestArray["AddressTypeEnum"] = $buyerAddressRequest->AddressTypeEnum;
		}

		return $requestArray;
	}


	// Response Converters
	public function ConvertToOnlineDebitResult($response) {

		$onlineDebitResult = new OnlineDebitResult();

		if (isset($response->OnlineDebitStatus) == true) {

			$onlineDebitResult->OnlineDebitStatus = $response->OnlineDebitStatus;
		}

		if (isset($response->MerchantKey) == true) {

			$onlineDebitResult->MerchantKey = $response->MerchantKey;
		}

		if (isset($response->OrderKey) == true) {

			$onlineDebitResult->OrderKey = $response->OrderKey;
		}

		if (isset($response->TransactionReference) == true) {

			$onlineDebitResult->TransactionReference = $response->TransactionReference;
		}

		if (isset($response->TransactionKey) == true) {

			$onlineDebitResult->TransactionKey = $response->TransactionKey;
		}

		if (isset($response->BankRedirectUrl) == true) {

			$onlineDebitResult->BankRedirectUrl = $response->BankRedirectUrl;
		}

		if (isset($response->Version) == true) {

			$onlineDebitResult->Version = $response->Version;
		}

		if (isset($response->ProcessTimeInMilliseconds) == true) {

			$onlineDebitResult->ProcessTimeInMilliseconds = $response->ProcessTimeInMilliseconds;
		}

		if (isset($response->ErrorReport) == true && is_null($response->ErrorReport) == false) {

			$onlineDebitResult->ErrorReport = $response->ErrorReport;
		}

		if (isset($response->Success) == true) {

			$onlineDebitResult->Success = $response->Success;
		}

		if (isset($response->TransactionKeyToBank) == true) {

			$onlineDebitResult->TransactionKeyToBank = $response->TransactionKeyToBank;
		}

		return $onlineDebitResult;
	}

	public function ConvertToErrorReport($response) {

		$errorReport = new ErrorReport();

		if (isset($response->Category) == true) {

			$errorReport->Category = $response->Category;
		}

		if (isset($response->ErrorItemCollection) == true && is_null($response->ErrorItemCollection) == false && count($response->ErrorItemCollection) > 0) {

			$errorReport->ErrorItemCollection = $this->ConvertToErrorItemCollection($response->ErrorItemCollection);
		}

		return $errorReport;
	}

	public function ConvertToErrorItemCollection(array $responseArray) {

		$errorItemCollection = array();

		$counter = 0;

		foreach($responseArray as $key => $value) {

			if (is_null($value) == false) {

				$errorItem = $this->ConvertToErrorItem($value);
				$errorItemCollection[$counter] = $errorItem;

				$counter++;
			}
		}

		return $errorItemCollection;
	}

	public function ConvertToErrorItem($response) {

		$errorItem = new ErrorItem();

		if (isset($response->ErrorCode) == true) {

			$errorItem->ErrorCode = $response->ErrorCode;
		}

		if (isset($response->ErrorField) == true) {

			$errorItem->ErrorField = $response->ErrorField;
		}

		if (isset($response->Description) == true) {

			$errorItem->Description = $response->Description;
		}

		if (isset($response->SeverityCode) == true) {

			$errorItem->SeverityCode = $response->SeverityCode;
		}

		return $errorItem;
	}

	public function ConvertToQueryOrderResponse($response) {

		$queryOrderResponse = new QueryOrderResponse();

		if (isset($response->OrderDataCollection) && count($response->OrderDataCollection) > 0) { 

			$queryOrderResponse->OrderDataCollection = $this->ConvertToOrderDataCollection($response->OrderDataCollection);
		}

		if (isset($response->MundiPaggTimeInMilliseconds)) {

			$queryOrderResponse->MundiPaggTimeInMilliseconds = $response->MundiPaggTimeInMilliseconds;
		}

		if (isset($response->Success)) {

			$queryOrderResponse->Success = $response->Success;
		}

		if (isset($response->ErrorReport)) {

			$queryOrderResponse->ErrorReport = $this->ConvertToErrorReport($response->ErrorReport);
		}

		return $queryOrderResponse;
	}

	public function ConvertToOrderDataCollection(array $responseArray) {

		$orderDataCollection = array();

		$counter = 0;

		foreach($responseArray as $key => $value) {

			if (is_null($value) == false) {

				$orderData = $this->ConvertToOrderData($value);
				$orderDataCollection[$counter] = $orderData;

				$counter++;
			}
		}

		return $orderDataCollection;
	}

	public function ConvertToOrderData($response) {

		$orderData = new OrderData();

		if (isset($response->OnlineDebitTransactionDataCollection) && count($response->OnlineDebitTransactionDataCollection) > 0) {

			$orderData->OnlineDebitTransactionDataCollection = $this->ConvertToOnlineDebitTransactionDataCollection($response->OnlineDebitTransactionDataCollection);
		}

		if (isset($response->CreateDate)) {

			$orderData->CreateDate = $response->CreateDate;
		}

		if (isset($response->OrderKey)) {

			$orderData->OrderKey = $response->OrderKey;
		}

		if (isset($response->OrderReference)) {

			$orderData->OrderReference = $response->OrderReference;
		}

		if (isset($response->RequestKey)) {

			$orderData->RequestKey = $response->RequestKey;
		}

		if (isset($response->OrderStatusEnum)) {

			$orderData->OrderStatusEnum = $response->OrderStatusEnum;
		}

		if (isset($response->AmountInCents)) {

			$orderData->AmountInCents = $response->AmountInCents;
		}

		if (isset($response->AmountInCentsToConsiderPaid)) {

			$orderData->AmountInCentsToConsiderPaid = $response->AmountInCentsToConsiderPaid;
		}

		if (isset($response->MerchantKey)) {

			$orderData->MerchantKey = $response->MerchantKey;
		}

		return $orderData;
	}

	public function ConvertToOnlineDebitTransactionDataCollection(array $responseArray) {

		$onlineDebitTransactionDataCollection = array();

		$counter = 0;

		foreach($responseArray as $key => $value) {

			if (is_null($value) == false) {

				$onlineDebitTransactionData = $this->ConvertToOnlineDebitTransactionData($value);
				$onlineDebitTransactionDataCollection[$counter] = $onlineDebitTransactionData;

				$counter++;
			}
		}

		return $onlineDebitTransactionDataCollection;
	}

	public function ConvertToOnlineDebitTransactionData($response) {

		$onlineDebitTransactionData = new OnlineDebitTransactionData();

		if (isset($response->OnlineDebitTransactionKey)) {

			$onlineDebitTransactionData->OnlineDebitTransactionKey = $response->OnlineDebitTransactionKey;
		}

		if (isset($response->TransactionReference)) {

			$onlineDebitTransactionData->TransactionReference = $response->TransactionReference;
		}

		if (isset($response->AmountInCents)) {

			$onlineDebitTransactionData->AmountInCents = $response->AmountInCents;
		}

		if (isset($response->AmountPaidInCents)) {

			$onlineDebitTransactionData->AmountPaidInCents = $response->AmountPaidInCents;
		}

		if (isset($response->OnlineDebitStatusEnum)) {

			$onlineDebitTransactionData->OnlineDebitStatusEnum = $response->OnlineDebitStatusEnum;
		}

		if (isset($response->CreateDate)) {

			$onlineDebitTransactionData->CreateDate = $response->CreateDate;
		}

		if (isset($response->TransactionKeyToBank)) {

			$onlineDebitTransactionData->TransactionKeyToBank = $response->TransactionKeyToBank;
		}

		if (isset($response->TransactionIdentifier)) {

			$onlineDebitTransactionData->TransactionIdentifier = $response->TransactionIdentifier;
		}

		if (isset($response->Signature)) {

			$onlineDebitTransactionData->Signature = $response->Signature;
		}

		if (isset($response->BankPaymentDate)) {

			$onlineDebitTransactionData->BankPaymentDate = $response->BankPaymentDate;
		}

		return $onlineDebitTransactionData;
	}
}
