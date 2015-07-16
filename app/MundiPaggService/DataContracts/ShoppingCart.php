<?php
include_once "ShoppingCartItem.php";

/*@global Shopping Cart */
class ShoppingCart {
	/*@var [integer] Freight Cost In Cents */
	public $FreightCostInCents;
	/*@var [ShoppingCartItem] Shopping Cart Item Collection */
	public $ShoppingCartItemCollection;

	function __construct() {
		$this->FreightCostInCents = 0;
		$this->ShoppingCartCollection = null;
	}
}
