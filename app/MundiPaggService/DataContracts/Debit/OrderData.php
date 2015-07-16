<?php

include_once "OnlineDebitTransactionData.php";

class OrderData {
    
    /*@var [List<OnlineDebitTransactionData>] Transaction collection*/
    public $OnlineDebitTransactionDataCollection;

    /*@var [String] Order creation date*/
    public $CreateDate;

    /*@var [Guid] Order key*/
    public $OrderKey;

    /*@var [String] Order reference*/
    public $OrderReference;

    /*@var [Guid] Request key*/
    public $RequestKey;

    /*@var [String] Order status*/
    public $OrderStatusEnum;

    /*@var [Long] Order amount in cents*/
    public $AmountInCents;

    /*@var [Nullable<Long>] Amount in cents to consider the order paid*/
    public $AmountInCentsToConsiderPaid;

    /*@var [Guid] Merchant key*/
    public $MerchantKey;

    function __construct() {

        $this->OnlineDebitTransactionDataCollection = null;
        $this->CreateDate = null;
        $this->OrderKey = null;
        $this->OrderReference = null;
        $this->RequestKey = null;
        $this->OrderStatusEnum = null;
        $this->AmountInCents = 0;
        $this->AmountInCentsToConsiderPaid = 0;
        $this->MerchantKey = null;
    }
}
