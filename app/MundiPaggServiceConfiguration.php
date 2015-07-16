<?php
	////// THIS FILE MUST REMAIN ON THE ROOT DIRECTORY //////

	// PATH VARIABLES

	/**
	* @author Thomás Sieczkowski
	* http://www.thomashs.com.br
	* @desc I've updated this file do expand global access
	* to configuration variables :)
	*/

	define( "MP_DOCUMENT_ROOT" , __DIR__ );

	define( "MP_SDK", constant("MP_DOCUMENT_ROOT") . "/MundiPaggService" );

	define( "MP_DATA_CONTRACTS", constant("MP_SDK") . "/DataContracts/" );

	define( "MP_DATA_CONTRACTS_DEBIT" , constant("MP_DATA_CONTRACTS") . "/Debit/" );

	define( "MP_POST_NOTIFICATION" , constant("MP_SDK") . "/PostNotification/" );

	define( "MP_CONVERTERS" , constant("MP_SDK") . "/Converters/" );

	define( "MP_HELPERS" , constant("MP_SDK") . "/Helpers/" );

	define( "MP_SERVICE_CLIENT" , constant("MP_SDK") . "/ServiceClient/" );

	// CONFIGURATION VARIABLES

	define( "MP_MERCHANT_KEY", "0a31c3dc-f2f1-4327-841b-4feaf7db147d" );

	define( "MP_WSDL_URI_COLLECTION", serialize(array(
		"PRODUCTION" => "https://transaction.mundipaggone.com/MundiPaggService.svc?wsdl"
		,"LOCAL" => constant("MP_SDK") . "/LocalWSDL/wsdl.xml"
		// ,"SANDBOX" => "" // Not implemented yet.
	)));

	define( "MP_DEBIT_SERVICE_URI" , "https://api.mundipaggone.com" );

	define( "MP_REPORT_SERVICE_URI" , "https://api.mundipaggone.com" );

	define( "MP_DEFAULT_WSDL_URI" , "LOCAL" );

	define( "MP_OPERATION_TIME_OUT" , 30 );

	define( "MP_ENABLE_WSDL_CACHE" , true );

	define( "MP_TRACE_SOAP_XML" , false );

	define( "MP_ENABLE_AUTO_SAVE_MESSAGES" , false );

	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
		define( "MP_AUTO_SAVE_MESSAGES_PATH" , "C:/RequestResponseData/" );
	else
		define( "MP_AUTO_SAVE_MESSAGES_PATH" , "~/Desktop/" );

	define( "MP_STATUS_NOTIF_POST" , "xmlStatusNotification" );

