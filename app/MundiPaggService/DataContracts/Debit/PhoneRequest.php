<?php
class PhoneRequest {

    /*@var [String] Country code*/
    public $CountryCode;

    /*@var [String] Area code*/
    public $AreaCode;

    /*@var [String] Phone number*/
    public $PhoneNumber;

    /*@var [String] Phone extension*/
    public $Extension;

    /*@var [PhoneTypeEnum] Phone type*/
    public $PhoneTypeEnum;

    function __construct() {

        $this->CountryCode = null;
        $this->AreaCode = null;
        $this->PhoneNumber = null;
        $this->Extension = null;
        $this->PhoneTypeEnum = PhoneTypeEnum::__default;
    }
}
