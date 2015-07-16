<?php
class ErrorReport {

	/** @var [String] Error category*/
	public $Category;

	/** @var [List<ErrorItem>] Error collection*/
	public $ErrorItemCollection;

	function __construct() {

		$this->Category = null;
		$this->ErrorItemCollection = null;
	}
}
