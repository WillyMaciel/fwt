<?php
/*@global Shopping Cart Item */
class ShoppingCartItem {
	/*@var [string] Description */
	public $Description;
	/*@var [string] Item Reference */
	public $ItemReference;
	/*@var [string] Name */
	public $Name;
	/*@var [integer] Quantity */
	public $Quantity;
	/*@var [integer] Total Cost In Cents */
	public $TotalCostInCents;
	/*@var [integer] Unit Cost In Cents */
	public $UnitCostInCents;
	
	function __construct() {
		$this->Description = "";
		$this->ItemReference = "";
		$this->Name = "";
		$this->Quantity = 0;
		$this->TotalCostInCents = 0;
		$this->UnitCostInCents = 0;
	}
}
