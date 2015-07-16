<?php

include_once "Enum.php";
include_once "OrderRequest.php";
include_once "BuyerRequest.php";
include_once "PhoneRequest.php";
include_once "BuyerAddressRequest.php";

class OnlineDebitRequest {

	/** @var [Guid] Merchant key*/
    public $MerchantKey;

	/** @var [Guid] Request key*/
    public $RequestKey;

	/** @var [String] Payment method*/
    public $PaymentMethod;

	/** @var [String] Payment type*/
    public $PaymentType;

	/** @var [Long] Transaction amount in cents*/
    public $AmountInCents;

	/** @var [String] Transaction reference*/
    public $TransactionReference;

	/** @var [Int] Intallment count*/
    public $InstallmentCount;

	/** @var [Guid] Order key*/
    public $OrderKey;

	/** @var [BuyerRequest] Buyer data*/
    public $Buyer;

	/** @var [OrderRequest] Order data*/
    public $OrderRequest;

    function __construct() {
    	$this->MerchantKey = constant("MP_MERCHANT_KEY");
    	$this->RequestKey = null;
    	$this->PaymentMethod = null;
    	$this->PaymentType = null;
    	$this->AmounInCents = 0;
    	$this->TransactionReference = null;
    	$this->InstallmentCount = 0;
    	$this->OrderKey = null;
    	$this->Buyer = null;
    	$this->OrderRequest = null;
    }
}
