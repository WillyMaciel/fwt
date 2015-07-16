<?php
include_once "Enum.php";

class BuyerAddress {
	/* @var [AddressTypeEnum] Address Type.*/
    /*@param Default: Residential*/
	public $AddressTypeEnum; 
	/*@var [String] City.*/
	public $City;
	/*@var [String] Address complement.*/
	public $Complement;
	/*var [CountryEnum] Address country.*/
	/*@param Default: Brazil*/
	public $CountryEnum;
	/*@var [String] District.*/
	public $District;
	/*@var [String] Address number.*/
	public $Number; 
	/*@var [String] Address state.*/
	public $State; 
	/*@var [String] Street*/
	public $Street;
	/*@var [String] Zip Code.*/
	public $ZipCode;
	
	function __construct() {
		$this->AddressTypeEnum = AddressTypeEnum::__default;
		$this->City = "";
		$this->Complement = "";
		$this->CountryEnum = CountryEnum::__default;
		$this->District = "";
		$this->Number = "";
		$this->State = "";
		$this->Street = "";
		$this->ZipCode = "";
	}
}
