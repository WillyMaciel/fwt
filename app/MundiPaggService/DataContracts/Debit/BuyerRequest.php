<?php
class BuyerRequest {

    /*@var [String] Document number*/
    public $TaxDocumentNumber;

    /*@var [TaxDocumentTypeEnum] Document type (CPF/CNPJ)*/
    public $TaxDocumentTypeEnum;

    /*@var [Guid] Buyer key*/
    public $BuyerKey;

    /*@var [String] Buyer reference*/
    public $BuyerReference;

    /*@var [Nullable<PersonTypeEnum>] Person type (Person, Company)*/
    public $PersonTypeEnum;

    /*@var [String] Buyer name*/
    public $Name;

    /*@var [GenderEnum] Gender (M/F)*/
    public $GenderEnum;

    /*@var [String] Buyer's e-mail*/
    public $Email;

    /*@var [String] Buyer's facebook id*/
    public $FacebookId;

    /*@var [String] Buyer's twitter id*/
    public $TwitterId;

    /*@var [String] Buyer IP address*/
    public $IpAddress;

    /*@var [List<PhoneRequest>] Buyer phone collection*/
    public $PhoneRequestCollection;

    /*@var [List<BuyerAddressRequest>] Buyer address collection*/
    public $BuyerAddressCollection;

    function __construct() {

        $this->TaxDocumentNumber = null;
        $this->TaxDocumentTypeEnum = TaxDocumentTypeEnum::__default;
        $this->BuyerKey = null;
        $this->BuyerReference = null;
        $this->PersonTypeEnum = PersonTypeEnum::__default;
        $this->Name = null;
        $this->GenderEnum = GenderEnum::__default;
        $this->Email = null;
        $this->FacebookId = null;
        $this->TwitterId = null;
        $this->IpAddress = null;
        $this->PhoneRequestCollection = null;
        $this->BuyerAddressCollection = null;
    }
}
