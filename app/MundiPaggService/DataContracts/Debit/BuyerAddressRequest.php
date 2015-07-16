<?php
class BuyerAddressRequest {

    /*@var [CountryEnum] Coyntry*/
    public $CountryEnum;

    /*@var [String] State*/
    public $State;

    /*@var [String] City*/
    public $City;

    /*@var [String] District*/
    public $District;

    /*@var [String] Street*/
    public $Street;

    /*@var [String] Number*/
    public $Number;

    /*@var [String] Complement*/
    public $Complement;

    /*@var [String] Postal code*/
    public $ZipCode;

    /*@var [AddressTypeEnum] Address type*/
    public $AddressTypeEnum;

    function __construct() {

        $this->CountryEnum = CountryEnum::__default;
        $this->State = null;
        $this->City = null;
        $this->District = null;
        $this->Street = null;
        $this->Number = null;
        $this->Complement = null;
        $this->ZipCode = null;
        $this->AddressTypeEnum = AddressTypeEnum::__default;
    }
}
