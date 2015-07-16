<?php
include_once "ISoapConverter.php";

/** Converters Interface
*
*/
class SoapConverter implements ISoapConverter {
	
	public function ConvertOrderRequest(CreateOrderRequest $orderRequest) {

		$order = array();
		

		$request = array(); 
		
		$order["MerchantKey"] = $orderRequest->MerchantKey; 
		$order["OrderReference"] = $orderRequest->OrderReference;
		$order["AmountInCents"] = $orderRequest->AmountInCents;
		$order["AmountInCentsToConsiderPaid"] = $orderRequest->AmountInCentsToConsiderPaid;
		$order["EmailUpdateToBuyerEnum"] = $orderRequest->EmailUpdateToBuyerEnum;
		$order["CurrencyIsoEnum"] = $orderRequest->CurrencyIsoEnum;
		$order["RequestKey"] = $orderRequest->RequestKey;
		$order["Retries"] = $orderRequest->Retries;


		if (!is_null($orderRequest->Buyer)) {
			$order["Buyer"] = $this->ConvertBuyerFromRequest($orderRequest->Buyer);
		}
		
		
		if (is_null($orderRequest->CreditCardTransactionCollection)) {
			$order["CreditCardTransactionCollection"] = null;
		}
		else if (is_array($orderRequest->CreditCardTransactionCollection)) {
			$order["CreditCardTransactionCollection"] = $this->ConvertCreditCardTransactionCollectionFromRequest($orderRequest->CreditCardTransactionCollection);
		}
		
		// Data from Boleto.
		if (is_null($orderRequest->BoletoTransactionCollection)) {
			$order["BoletoTransactionCollection"] = null;
		}
		else if (is_array($orderRequest->BoletoTransactionCollection)) {
			$order["BoletoTransactionCollection"] = $this->ConvertBoletoTransactionCollectionFromRequest($orderRequest->BoletoTransactionCollection);
		}
		
		// Data from Shopping Cart
		if (!is_null($orderRequest->ShoppingCartCollection)) {
			if (is_array($orderRequest->ShoppingCartCollection)) {
				$order["ShoppingCartCollection"] = $this->ConvertShoppingCartCollectionFromRequest($orderRequest->ShoppingCartCollection);
			}
		}
		
		$request["createOrderRequest"] = $order; // Adiciona o pedido na requisição

		return $request;
	}
	
	/* <b>Convert Order Response</b>
	* <ul>
	*<li> Create Order Response </li>
	*</ul>
	*/
	public function ConvertOrderResponse($orderResponse) {
		if (is_null($orderResponse)) { throw new Exception("Null response!"); }
		
		//Create Order Response
		$response = new CreateOrderResponse();
		
		$response->BuyerKey = $orderResponse->BuyerKey;
		$response->MerchantKey = $orderResponse->MerchantKey;
		$response->MundiPaggTimeInMilliseconds = $orderResponse->MundiPaggTimeInMilliseconds;
		$response->OrderKey = $orderResponse->OrderKey;
		$response->OrderReference = $orderResponse->OrderReference;
		$response->OrderStatusEnum = $orderResponse->OrderStatusEnum;
		$response->RequestKey = $orderResponse->RequestKey;
		$response->Success = $orderResponse->Success;
		$response->Version = $orderResponse->Version;
		
		// CreditCard Transaction Result Collection
		$response->CreditCardTransactionResultCollection = $this->ConvertCreditCardTransactionResultCollectionFromResponse($orderResponse->CreditCardTransactionResultCollection);

		// Boleto Transaction Result Collection
		$response->BoletoTransactionResultCollection = $this->ConvertBoletoTransactionResultCollectionFromResponse($orderResponse->BoletoTransactionResultCollection);
		
		// MundiPaggSuggestion
		$response->MundiPaggSuggestion = $this->ConvertMundiPaggSuggestionFromResponse($orderResponse->MundiPaggSuggestion);
		
		// ErrorReport
		$response->ErrorReport = $this->ConvertErrorReportFromResponse($orderResponse->ErrorReport);
		
		return $response;
	}
	
	/*<b>Convert Manage Order Request</b>
	* <ul>
	*<li> Create Order</li>
	*<li> Create Request</li>
	*</ul>
	*/
	public function ConvertManageOrderRequest(ManageOrderRequest $manageRequest) {
		//Create Order Request
		$request = array();
		//Create Order
		$order = array();
		
		$order["ManageOrderOperationEnum"] = $manageRequest->ManageOrderOperationEnum;
		$order["MerchantKey"] = $manageRequest->MerchantKey;
		$order["OrderKey"] = $manageRequest->OrderKey;
		$order["OrderReference"] = $manageRequest->OrderReference;
		$order["RequestKey"] = $manageRequest->RequestKey;
		
		//Manage Credit Card Transaction Collection
		if (!is_null($manageRequest->ManageCreditCardTransactionCollection)) {
			if (is_array($manageRequest->ManageCreditCardTransactionCollection)) {
				$order["ManageCreditCardTransactionCollection"] = $this->ConvertManageCreditCardTransactionCollectionFromRequest($manageRequest->ManageCreditCardTransactionCollection);
			}
		}
		
		// Add Order to request
		$request["manageOrderRequest"] = $order; 
		
		return $request;
	}
	
	//Convert Manage Order Response 
	public function ConvertManageOrderResponse($manageResponse) {
		if (is_null($manageResponse)) { throw new Exception("Null response!"); }
		
		// Create Manage Order Response 
		$response = new ManageOrderResponse();
		
		$response->ManageOrderOperationEnum = $manageResponse->ManageOrderOperationEnum;
		$response->MundiPaggTimeInMilliseconds = $manageResponse->MundiPaggTimeInMilliseconds;
		$response->OrderKey = $manageResponse->OrderKey;
		$response->OrderReference = $manageResponse->OrderReference;
		$response->OrderStatusEnum = $manageResponse->OrderStatusEnum;
		$response->RequestKey = $manageResponse->RequestKey;
		$response->Success = $manageResponse->Success;
		$response->Version = $manageResponse->Version;

		// MundiPagg Suggestion
		$response->MundiPaggSuggestion = $this->ConvertMundiPaggSuggestionFromResponse($manageResponse->MundiPaggSuggestion);
		
		// Error Report
		$response->ErrorReport = $this->ConvertErrorReportFromResponse($manageResponse->ErrorReport);
		
		// Credit Card Transaction Result Collection
		$response->CreditCardTransactionResultCollection = $this->ConvertCreditCardTransactionResultCollectionFromResponse($manageResponse->CreditCardTransactionResultCollection);
		
		// Boleto Transaction Result Collection
		$response->BoletoTransactionResultCollection = $this->ConvertBoletoTransactionResultCollectionFromResponse($manageResponse->BoletoTransactionResultCollection);

		return $response;
	}
	
	//Convert Retry Order Request 
	public function ConvertRetryOrderRequest(RetryOrderRequest $retryRequest) {
		//Create
		$request = array();
		$order = array();
		
		$order["MerchantKey"] = $retryRequest->MerchantKey;
		$order["OrderKey"] = $retryRequest->OrderKey;
		$order["OrderReference"] = $retryRequest->OrderReference;
		$order["RequestKey"] = $retryRequest->RequestKey;
		
		if (!is_null($retryRequest->RetryOrderCreditCardTransactionRequestCollection)) {
			if (is_array(RetryOrderCreditCardTransactionRequestCollection)) {
				$order["RetryOrderCreditCardTransactionRequestCollection"] = $this->ConvertRetryOrderCreditCardTransactionRequestCollectionFromRequest($retryRequest->RetryOrderCreditCardTransactionRequestCollection);
			}
		}
		
		$request["manualRetryRequest"] = $order;
		
		return $request;
	}
	public function ConvertRetryOrderResponse($retryResponse) {
		$response = new RetryOrderResponse();
		
		$response->MundiPaggTimeInMilliseconds = $retryResponse->MundiPaggTimeInMilliseconds;
		$response->OrderKey = $retryResponse->OrderKey;
		$response->OrderReference = $retryResponse->OrderReference;
		$response->OrderStatusEnum = $retryResponse->OrderStatusEnum;
		$response->RequestKey = $retryResponse->RequestKey;
		$response->Success = $retryResponse->Success;
		$response->Version = $retryResponse->Version;
		
		$response->MundiPaggSuggestion = $this->ConvertMundiPaggSuggestionFromResponse($retryResponse->MundiPaggSuggestion);
		$response->ErrorReport = $this->ConvertErrorReportFromResponse($retryResponse->ErrorReport);

		if (!isset($retryResponse->RetryOrderCreditCardTransactionResponse)) {
			$response->RetryOrderCreditCardTransactionResponse = null;
		}
		else {
			$response->RetryOrderCreditCardTransactionResponse = $this->ConvertCreditCardTransactionResultCollectionFromResponse($retryResponse->RetryOrderCreditCardTransactionResponse);
		}
		
		return $response;
	}

	public function ConvertQueryOrderRequest(QueryOrderRequest $queryRequest) {
		$request = array();
		$order = array();
		
		$order["MerchantKey"] = $queryRequest->MerchantKey;
		$order["OrderKey"] = $queryRequest->OrderKey;
		$order["OrderReference"] = $queryRequest->OrderReference;
		$order["RequestKey"] = $queryRequest->RequestKey;
		
		$request["queryOrderRequest"] = $order;
		
		return $request;
	}
	public function ConvertQueryOrderResponse($queryResponse) {
		$response = new QueryOrderResponse();
		
		$response->MundiPaggTimeInMilliseconds = $queryResponse->MundiPaggTimeInMilliseconds;
		$response->OrderDataCount = $queryResponse->OrderDataCount;
		$response->RequestKey = $queryResponse->RequestKey;
		$response->Success = $queryResponse->Success;
		
		// OrderDataCollection
		$response->OrderDataCollection = $this->ConvertOrderDataCollectionFromResponse($queryResponse->OrderDataCollection);

		// MundiPaggSuggestion
		$response->MundiPaggSuggestion = $this->ConvertMundiPaggSuggestionFromResponse($queryResponse->MundiPaggSuggestion);
		
		// ErrorReport
		$response->ErrorReport = $this->ConvertErrorReportFromResponse($queryResponse->ErrorReport);
		
		return $response;
	}

	public function ConvertGetInstantBuyDataRequest(GetInstantBuyDataRequest $instantBuyRequest) {
		$request = array();
		$order = array();
		
		$order["BuyerKey"] = $instantBuyRequest->BuyerKey;
		$order["InstantBuyKey"] = $instantBuyRequest->InstantBuyKey;
		$order["MerchantKey"] = $instantBuyRequest->MerchantKey;
		$order["RequestKey"] = $instantBuyRequest->RequestKey;
		
		$request["queryCreditCardDataRequest"] = $order;
		
		return $request;
	}
	public function ConvertGetInstantBuyDataResponse($instantBuyResponse) {
		$response = new GetInstantBuyDataResponse();
		
		$response->CreditCardDataCount = $instantBuyResponse->CreditCardDataCount;
		$response->MundiPaggTimeInMilliseconds = $instantBuyResponse->MundiPaggTimeInMilliseconds;
		$response->RequestKey = $instantBuyResponse->RequestKey;
		$response->Success = $instantBuyResponse->Success;
		
		// CreditCardDataCollection
		$response->CreditCardDataCollection = $this->ConvertCreditCardDataCollectionFromResponse($instantBuyResponse->CreditCardDataCollection);
		
		// MundiPaggSuggestion
		$response->MundiPaggSuggestion = $this->ConvertMundiPaggSuggestionFromResponse($instantBuyResponse->MundiPaggSuggestion);
		
		// ErrorReport
		$response->ErrorReport = $this->ConvertErrorReportFromResponse($instantBuyResponse->ErrorReport);
		
		return $response;
	}

	///////////////////////////////////////////////////////
	////// REQUEST CONVERTERS (Entities to Arrays) ////////
	///////////////////////////////////////////////////////
	public function ConvertBuyerFromRequest(Buyer $buyerRequest) {
		$newBuyer = array();
		$newBuyer["BuyerKey"] = $buyerRequest->BuyerKey;
		$newBuyer["BuyerReference"] = $buyerRequest->BuyerReference;
		if (!is_null($buyerRequest->CreateDateInMerchant)) {
			$newBuyer["CreateDateInMerchant"] = $buyerRequest->CreateDateInMerchant;
		}
		$newBuyer["Email"] = $buyerRequest->Email;
		$newBuyer["FacebookId"] = $buyerRequest->FacebookId;
		if (!is_null($buyerRequest->GenderEnum)) {
			$newBuyer["GenderEnum"] = $buyerRequest->GenderEnum;
		}
		$newBuyer["HomePhone"] = $buyerRequest->HomePhone;
		$newBuyer["IpAddress"] = $buyerRequest->IpAddress;
		if (!is_null($buyerRequest->LastBuyerUpdateInMerchant)) {
			$newBuyer["LastBuyerUpdateInMerchant"] = $buyerRequest->LastBuyerUpdateInMerchant;
		}
		$newBuyer["MobilePhone"] = $buyerRequest->MobilePhone;
		$newBuyer["Name"] = $buyerRequest->Name;
		if (!is_null($buyerRequest->PersonTypeEnum)) {
			$newBuyer["PersonTypeEnum"] = $buyerRequest->PersonTypeEnum;
		}
		$newBuyer["TaxDocumentNumber"] = $buyerRequest->TaxDocumentNumber;
		if (!is_null($buyerRequest->TaxDocumentTypeEnum)) {
			$newBuyer["TaxDocumentTypeEnum"] = $buyerRequest->TaxDocumentTypeEnum;
		}
		$newBuyer["TwitterId"] = $buyerRequest->TwitterId;
		$newBuyer["WorkPhone"] = $buyerRequest->WorkPhone;
		// Copia os objetos BuyerAddress
		if (!is_null($buyerRequest->BuyerAddressCollection)) {
			if (count($buyerRequest->BuyerAddressCollection) > 0) {
				$newAddrCollection = array(); // Coleção com os endereços do comprador

				$counter = 0;
				foreach($buyerRequest->BuyerAddressCollection as $buyAddress) {
					$newBuyAddress = array(); // Endereço do comprador
					$newBuyAddress["AddressTypeEnum"] = $buyAddress->AddressTypeEnum;
					$newBuyAddress["City"] = $buyAddress->City;
					$newBuyAddress["Complement"] = $buyAddress->Complement;
					$newBuyAddress["CountryEnum"] = $buyAddress->CountryEnum;
					$newBuyAddress["District"] = $buyAddress->District;
					$newBuyAddress["Number"] = $buyAddress->Number;
					$newBuyAddress["State"] = $buyAddress->State;
					$newBuyAddress["Street"] = $buyAddress->Street;
					$newBuyAddress["ZipCode"] = $buyAddress->ZipCode;

					$newAddressCollection[$counter] = $newBuyAddress;
					$counter += 1;
				}
				
				$newBuyer["BuyerAddressCollection"] = $newAddressCollection;
			}
		}
		
		return $newBuyer;
	}
	public function ConvertCreditCardTransactionCollectionFromRequest($creditCardTransactionCollectionRequest) {
		$newccTransactionCollection = array();
		$counter = 0;
		foreach($creditCardTransactionCollectionRequest as $ccTrans) {
			$newccTrans = array();
			
			$newccTrans["AmountInCents"] = $ccTrans->AmountInCents;
			$newccTrans["CaptureDelayInMinutes"] = $ccTrans->CaptureDelayInMinutes;
			$newccTrans["CreditCardNumber"] = $ccTrans->CreditCardNumber;
			$newccTrans["InstallmentCount"] = $ccTrans->InstallmentCount;
			$newccTrans["HolderName"] = $ccTrans->HolderName;
			$newccTrans["SecurityCode"] = $ccTrans->SecurityCode;
			$newccTrans["ExpMonth"] = $ccTrans->ExpMonth;
			$newccTrans["ExpYear"] = $ccTrans->ExpYear;
			$newccTrans["CreditCardBrandEnum"] = $ccTrans->CreditCardBrandEnum;
			$newccTrans["PaymentMethodCode"] = $ccTrans->PaymentMethodCode;
			$newccTrans["CreditCardOperationEnum"] = $ccTrans->CreditCardOperationEnum;
			$newccTrans["IataAmountInCents"] = $ccTrans->IataAmountInCents;
			$newccTrans["InstantBuyKey"] = $ccTrans->InstantBuyKey;
			$newccTrans["ThirdPartyMerchantKey"] = $ccTrans->ThirdPartyMerchantKey;
			$newccTrans["TransactionReference"] = $ccTrans->TransactionReference;
			if (!is_null($ccTrans->Recurrency)) {
				$newccTrans["Recurrency"] = $this->ConvertRecurrencyFromRequest($ccTrans->Recurrency);
			}
			
			$newccTransactionCollection["CreditCardTransaction"][$counter] = $newccTrans;
			$counter += 1;
		}
		
		return $newccTransactionCollection;
	}
	public function ConvertRecurrencyFromRequest($recurrency) {
		$newRecurrency = array();
		
		$newRecurrency["DateToStartBilling"] = $recurrency->DateToStartBilling;
		$newRecurrency["FrequencyEnum"] = $recurrency->FrequencyEnum;
		$newRecurrency["Interval"] = $recurrency->Interval;
		$newRecurrency["OneDollarAuth"] = $recurrency->OneDollarAuth;
		$newRecurrency["Recurrences"] = $recurrency->Recurrences;
		
		return $recurrency;
	}
	public function ConvertBoletoTransactionCollectionFromRequest($boletoTransactionCollectionRequest) {
		$newBoletoTransCollection = array();
		$counter = 0;
		foreach($boletoTransactionCollectionRequest as $boletoTransItem) {
			$boletoTrans = array();
			$boletoTrans["AmountInCents"] = $boletoTransItem->AmountInCents;
			$boletoTrans["BankNumber"] = $boletoTransItem->BankNumber;
			$boletoTrans["Instructions"] = $boletoTransItem->Instructions;
			$boletoTrans["NossoNumero"] = $boletoTransItem->NossoNumero;
			$boletoTrans["DaysToAddInBoletoExpirationDate"] = $boletoTransItem->DaysToAddInBoletoExpirationDate;
			
			$newBoletoTransCollection["BoletoTransaction"][$counter] = $boletoTrans;
			$counter += 1;
		}
		
		return $newBoletoTransCollection;
	}
	public function ConvertShoppingCartCollectionFromRequest($shoppingCartCollectionRequest) {
		$newShoppingCartCollection = array();
		$counter = 0;

		// Copia cada objeto ShoppingCart
		foreach ($shoppingCartCollectionRequest as $shopCart) {
			$newShopCart = array();
			$newShopCart["FreightCostInCents"] = $shopCart->FreightCostInCents;
			
			if (!is_null($shopCart->ShoppingCartItemCollection)) {
				if (is_array($shopCart->ShoppingCartItemCollection)) {
					$newShopCartItemCollection = array();
					$itemCounter = 0;
					// Copia cada objeto ShoppingCartItem
					foreach ($shopCart->ShoppingCartItemCollection as $shopCartItem) {
						$newShopCartItem["Description"] = $shopCartItem->Description;
						$newShopCartItem["ItemReference"] = $shopCartItem->ItemReference;
						$newShopCartItem["Name"] = $shopCartItem->Name;
						$newShopCartItem["Quantity"] = $shopCartItem->Quantity;
						$newShopCartItem["TotalCostInCents"] = $shopCartItem->TotalCostInCents;
						$newShopCartItem["UnitCostInCents"] = $shopCartItem->UnitCostInCents;
						
						$newShopCartItemCollection["ShoppingCartItem"][$itemCounter] = $newShopCartItem;
						$itemCounter += 1;
					} // foreach (shopCartItem)
					
					$newShopCart["ShoppingCartItemCollection"] = $newShopCartItemCollection;
				} // if is_array
			} // if is_null
			
			$newShopCartCollection["ShoppingCart"][$counter] = $newShopCart;
			$counter += 1;
		}
		
		return $newShopCartCollection;
	}
	public function ConvertManageCreditCardTransactionCollectionFromRequest($creditCardTransactionCollectionRequest) {
		$newCreditCardTransCollection = array();
		$counter = 0;
		foreach ($creditCardTransactionCollectionRequest as $ccTrans) {
			$newccTrans = array();
			
			$newccTrans["AmountInCents"] = $ccTrans->AmountInCents;
			$newccTrans["TransactionKey"] = $ccTrans->TransactionKey;
			$newccTrans["TransactionReference"] = $ccTrans->TransactionReference;
			
			$newCreditCardTransCollection[$counter] = $newccTrans;
			$counter += 1;
		}
		
		return $newCreditCardTransCollection;
	}
	public function ConvertRetryOrderCreditCardTransactionRequestCollectionFromRequest($creditCardTransactionRequestCollection) {
		$newccTransCollection = array();
		$counter = 0;
		foreach ($creditCardTransactionRequestCollection as $ccTransRequest) {
			$newccTransRequest = array();
			$newccTransRequest["SecurityCode"] = $ccTransRequest->SecurityCode;
			$newccTransRequest["TransactionKey"] = $ccTransRequest->TransactionKey;

			$newccTransCollection["RetryOrderCreditCardTransactionRequest"][$counter] = $newccTransRequest;
			$counter += 1;
		}
		
		return $newccTransCollection;
	}

	///////////////////////////////////////////////////////
	////// RESPONSE CONVERTERS (stdClasses to Entities) ///
	///////////////////////////////////////////////////////
	public function ConvertCreditCardTransactionResultCollectionFromResponse($creditCardTransactionResultCollection) {
		$newccTransResultCollection = array();
		
		if (isset($creditCardTransactionResultCollection->CreditCardTransactionResult)) {
			// If there are more than one item, it's an array.
			if (is_array($creditCardTransactionResultCollection->CreditCardTransactionResult)) {
				$counter = 0;
				
				foreach ($creditCardTransactionResultCollection->CreditCardTransactionResult as $ccTrans) {
					$newccTransResultCollection[$counter] = $this->ConvertCreditCardTransactionResult($ccTrans);
					$counter += 1;
				}
			}
			// If there is just one item, it's a stdclass.
			else {
				$newccTransResultCollection[0] = $this->ConvertCreditCardTransactionResult($creditCardTransactionResultCollection->CreditCardTransactionResult);
			}
		}
		
		return $newccTransResultCollection;
	}
	public function ConvertCreditCardTransactionResult($creditCardTransactionResult) {
	
		$newccTrans = new CreditCardTransactionResult;

		$newccTrans->AcquirerMessage = $creditCardTransactionResult->AcquirerMessage;
		$newccTrans->AcquirerReturnCode = $creditCardTransactionResult->AcquirerReturnCode;
		$newccTrans->AmountInCents = $creditCardTransactionResult->AmountInCents;
		$newccTrans->AuthorizationCode = $creditCardTransactionResult->AuthorizationCode;
		$newccTrans->AuthorizedAmountInCents = $creditCardTransactionResult->AuthorizedAmountInCents;
		$newccTrans->CapturedAmountInCents = $creditCardTransactionResult->CapturedAmountInCents;
		$newccTrans->CreditCardNumber = $creditCardTransactionResult->CreditCardNumber;
		$newccTrans->CreditCardOperationEnum = $creditCardTransactionResult->CreditCardOperationEnum;
		$newccTrans->CreditCardTransactionStatusEnum = $creditCardTransactionResult->CreditCardTransactionStatusEnum;
		$newccTrans->CustomStatus = $creditCardTransactionResult->CustomStatus;
		$newccTrans->DueDate = $creditCardTransactionResult->DueDate;
		$newccTrans->ExternalTimeInMilliseconds = $creditCardTransactionResult->ExternalTimeInMilliseconds;
		$newccTrans->InstantBuyKey = $creditCardTransactionResult->InstantBuyKey;
		$newccTrans->RefundedAmountInCents = $creditCardTransactionResult->RefundedAmountInCents;
		$newccTrans->Success = $creditCardTransactionResult->Success;
		$newccTrans->TransactionIdentifier = $creditCardTransactionResult->TransactionIdentifier;
		$newccTrans->TransactionKey = $creditCardTransactionResult->TransactionKey;
		$newccTrans->TransactionReference = $creditCardTransactionResult->TransactionReference;
		$newccTrans->UniqueSequentialNumber = $creditCardTransactionResult->UniqueSequentialNumber;
		$newccTrans->VoidedAmountInCents = $creditCardTransactionResult->VoidedAmountInCents;
		$newccTrans->OriginalAcquirerReturnCollection = $creditCardTransactionResult->OriginalAcquirerReturnCollection;
		
		return $newccTrans;
	}
	public function ConvertBoletoTransactionResultCollectionFromResponse($boletoTransactionResultCollection) {
		$newBoletoTransResultCollection = array();
		
		if (isset($boletoTransactionResultCollection->BoletoTransactionResult)) {
			// If there are more than one item, it's an array.
			if (is_array($boletoTransactionResultCollection->BoletoTransactionResult)) {
				$counter = 0;
				
				foreach ($boletoTransactionResultCollection->BoletoTransactionResult as $boletoTrans) {
					$newBoletoTransResultCollection[$counter] = $this->ConvertBoletoTransactionResult($boletoTrans);
					$counter += 1;
				}
			}
			// If there is just one item, it's a stdclass.
			else {
				$newBoletoTransResultCollection[0] = $this->ConvertBoletoTransactionResult($boletoTransactionResultCollection->BoletoTransactionResult);
			}
		}
		
		return $newBoletoTransResultCollection;
	}
	public function ConvertBoletoTransactionResult($boletoTransactionResult) {
	
		$newBoletoTrans = new BoletoTransactionResult();
			
		$newBoletoTrans->AmountInCents = $boletoTransactionResult->AmountInCents;
		$newBoletoTrans->Barcode = $boletoTransactionResult->Barcode;
		$newBoletoTrans->BoletoTransactionStatusEnum = $boletoTransactionResult->BoletoTransactionStatusEnum;
		$newBoletoTrans->BoletoUrl = $boletoTransactionResult->BoletoUrl;
		$newBoletoTrans->CustomStatus = $boletoTransactionResult->CustomStatus;
		$newBoletoTrans->NossoNumero = $boletoTransactionResult->NossoNumero;
		$newBoletoTrans->Success = $boletoTransactionResult->Success;
		$newBoletoTrans->TransactionKey = $boletoTransactionResult->TransactionKey;
		$newBoletoTrans->TransactionReference = $boletoTransactionResult->TransactionReference;
		
		return $newBoletoTrans;
	}
	public function ConvertMundiPaggSuggestionFromResponse($suggestionResponse) {
		$newSuggestion = null;
		if (is_null($suggestionResponse) == false) {
			$newSuggestion = new MundiPaggSuggestion();
			$newSuggestion->Code = $suggestionResponse->Code;
			$newSuggestion->Message = $suggestionResponse->Message;
		}
		
		return $newSuggestion;
	}	
	public function ConvertErrorReportFromResponse($errorReport) {
		$newErrorReport = null;
		if (!is_null($errorReport)) {
			$newErrorReport = new ErrorReport();
			$newErrorReport->Category = $errorReport->Category;
			
			$newErrorReport->ErrorItemCollection = null;
			if (!is_null($errorReport->ErrorItemCollection)) {
				if (is_array($errorReport->ErrorItemCollection->ErrorItem)) {

				$counter = 0;
					foreach($errorReport->ErrorItemCollection->ErrorItem as $errorItem) {

						$newErrorReport->ErrorItemCollection[$counter] = $this->ConvertErrorItem($errorItem);
						$counter += 1;
					}
				}
				// It's a stdclass.
				else {

				$newErrorReport->ErrorItemCollection[0] = $this->ConvertErrorItem($errorReport->ErrorItemCollection->ErrorItem);
				}
			}
		}
		
		return $newErrorReport;
	}
	public function ConvertErrorItem($errorItem) {
		$newErrorItem = new ErrorItem();
		
		$newErrorItem->Description = $errorItem->Description;
		$newErrorItem->ErrorCode = $errorItem->ErrorCode;
		$newErrorItem->ErrorField = $errorItem->ErrorField;
		$newErrorItem->SeverityCodeEnum = $errorItem->SeverityCodeEnum;
		
		return $newErrorItem;
	}
	public function ConvertOrderDataCollectionFromResponse($orderDataCollection) {
		$newOrderDataCollection = null;

		if (is_null($orderDataCollection) == false) {
			$newOrderDataCollection = array();
			
			if (isset($orderDataCollection->OrderData)) {
				// If there are more than one item, it's an array.
				if (is_array($orderDataCollection->OrderData)) {
					$counter = 0;
					
					foreach ($orderDataCollection->OrderData as $orderData) {
						$newOrderDataCollection[$counter] = $this->ConvertOrderData($orderData);
						$counter += 1;
					}
				}
				// If there is just one item, it's a stdclass.
				else {
					$newOrderDataCollection[0] = $this->ConvertOrderData($orderDataCollection->OrderData);
				}
			}
		}
		
		return $newOrderDataCollection;
	}
	public function ConvertOrderData($orderData) {
		$newOrderData = new OrderData();
				
		$newOrderData->CreateDate = $orderData->CreateDate;
		$newOrderData->OrderKey = $orderData->OrderKey;
		$newOrderData->OrderReference = $orderData->OrderReference;
		$newOrderData->OrderStatusEnum = $orderData->OrderStatusEnum;
		
		$newOrderData->CreditCardTransactionDataCollection = $this->ConvertCreditCardTransactionDataCollectionFromResponse($orderData->CreditCardTransactionDataCollection);
		$newOrderData->BoletoTransactionDataCollection = $this->ConvertBoletoTransactionDataCollectionFromResponse($orderData->BoletoTransactionDataCollection);
		
		return $newOrderData;
	}
	public function ConvertCreditCardTransactionDataCollectionFromResponse($creditCardTransactionDataCollection) {
		$newCreditCardTransactionDataCollection = array();
		
		if (isset($creditCardTransactionDataCollection->CreditCardTransactionData)) {
			// If there are more than one item, it's an array.
			if (is_array($creditCardTransactionDataCollection->CreditCardTransactionData)) {
				$counter = 0;
				
				foreach($creditCardTransactionDataCollection->CreditCardTransactionData as $ccTransData) {
					$newCreditCardTransactionDataCollection[$counter] = $this->ConvertCreditCardTransactionData($ccTransData);
					$counter += 1;
				}
			}
			// If there is just one item, it's a stdclass.
			else {
				$newCreditCardTransactionDataCollection[0] = $this->ConvertCreditCardTransactionData($creditCardTransactionDataCollection->CreditCardTransactionData);
			}
		}
		
		return $newCreditCardTransactionDataCollection;
	}
	public function ConvertCreditCardTransactionData($ccTransData) {
		$newccTransData = new CreditCardTransactionData();
			
		$newccTransData->AcquirerAuthorizationCode = $ccTransData->AcquirerAuthorizationCode;
		$newccTransData->AcquirerName = $ccTransData->AcquirerName;
		$newccTransData->AmountInCents = $ccTransData->AmountInCents;
		if (isset($ccTransData->AuthorizedAmountInCents)) {
			$newccTransData->AuthorizedAmountInCents = $ccTransData->AuthorizedAmountInCents;
		}
		if (isset($ccTransData->CapturedAmountInCents)) {
			$newccTransData->CapturedAmountInCents = $ccTransData->CapturedAmountInCents;
		}
		$newccTransData->CreateDate = $ccTransData->CreateDate;
		$newccTransData->CreditCardBrandEnum = $ccTransData->CreditCardBrandEnum;
		$newccTransData->CreditCardNumber = $ccTransData->CreditCardNumber;
		$newccTransData->CreditCardTransactionStatusEnum = $ccTransData->CreditCardTransactionStatusEnum;
		$newccTransData->CustomStatus = $ccTransData->CustomStatus;
		if (isset($ccTransData->DueDate)) {
			$newccTransData->DueDate = $ccTransData->DueDate;
		}
		$newccTransData->InstallmentCount = $ccTransData->InstallmentCount;
		$newccTransData->InstantBuyKey = $ccTransData->InstantBuyKey;
		if (isset($ccTransData->IsReccurrency)) {
			$newccTransData->IsReccurrency = $ccTransData->IsReccurrency;
		}
		if (isset($ccTransData->RefundedAmountInCents)) {
			$newccTransData->RefundedAmountInCents = $ccTransData->RefundedAmountInCents;
		}
		$newccTransData->TransactionIdentifier = $ccTransData->TransactionIdentifier;
		$newccTransData->TransactionKey = $ccTransData->TransactionKey;
		$newccTransData->TransactionReference = $ccTransData->TransactionReference;
		$newccTransData->UniqueSequentialNumber = $ccTransData->UniqueSequentialNumber;
		if (isset($ccTransData->VoidedAmountInCents)) {
			$newccTransData->VoidedAmountInCents = $ccTransData->VoidedAmountInCents;
		}
		
		return $newccTransData;
	}
	public function ConvertBoletoTransactionDataCollectionFromResponse($boletoTransactionDataCollection) {
		$newBoletoTransactionDataCollection = array();
		
		if (isset($boletoTransactionDataCollection->BoletoTransactionData)) {
			// If there are more than one item, it's an array.
			if (is_array($boletoTransactionDataCollection->BoletoTransactionData)) {
				$counter = 0;
				
				foreach($boletoTransactionDataCollection->BoletoTransactionData as $boletoTransData) {
					$newBoletoTransactionDataCollection[$counter] = $this->ConvertBoletoTransactionData($boletoTransData);
					$counter += 1;
				}
			}
			// If there is just one item, it's a stdclass.
			else {
				$newBoletoTransactionDataCollection[0] = $this->ConvertBoletoTransactionData($boletoTransactionDataCollection->BoletoTransactionData);
			}
		}
		
		return $newBoletoTransactionDataCollection;
	}
	public function ConvertBoletoTransactionData($boletoTransData) {
		$newBoletoTransData = new BoletoTransactionData();

		$newBoletoTransData->AmountInCents = $boletoTransData->AmountInCents;
		$newBoletoTransData->AmountPaidInCents = $boletoTransData->AmountPaidInCents;
		$newBoletoTransData->BankNumber = $boletoTransData->BankNumber;
		$newBoletoTransData->Barcode = $boletoTransData->Barcode;
		$newBoletoTransData->BoletoTransactionStatusEnum = $boletoTransData->BoletoTransactionStatusEnum;
		$newBoletoTransData->BoletoUrl = $boletoTransData->BoletoUrl;
		$newBoletoTransData->CreateDate = $boletoTransData->CreateDate;
		$newBoletoTransData->CustomStatus = $boletoTransData->CustomStatus;
		$newBoletoTransData->ExpirationDate = $boletoTransData->ExpirationDate;
		$newBoletoTransData->NossoNumero = $boletoTransData->NossoNumero;
		$newBoletoTransData->TransactionKey = $boletoTransData->TransactionKey;
		$newBoletoTransData->TransactionReference = $boletoTransData->TransactionReference;

		return $newBoletoTransData;
	}
	public function ConvertCreditCardDataCollectionFromResponse($creditCardDataCollection) {
		$newCreditCardDataCollection = array();

		if (is_null($creditCardDataCollection) == false) {
			if (isset($creditCardDataCollection->CreditCardData)) {
				// If there are more than one item, it's an array.
				if (is_array($creditCardDataCollection->CreditCardData)) {
					$counter = 0;
					
					foreach($creditCardDataCollection->CreditCardData as $ccData) {
						$newCreditCardDataCollection[$counter] = $this->ConvertCreditCardData($ccData);
						$counter += 1;
					}
				}
				// If there is just one item, it's a stdclass.
				else {
					$newCreditCardDataCollection[0] = $this->ConvertCreditCardData($creditCardDataCollection->CreditCardData);
				}
			}
		}
		
		return $newCreditCardDataCollection;
	}
	public function ConvertCreditCardData($ccData) {
		$newccData = new CreditCardData();

		$newccData->CreditCardBrandEnum = $ccData->CreditCardBrandEnum;
		$newccData->CreditCardNumber = $ccData->CreditCardNumber;
		$newccData->InstantBuyKey = $ccData->InstantBuyKey;
		$newccData->IsExpiredCreditCard = $ccData->IsExpiredCreditCard;

		return $newccData;
	}
}
