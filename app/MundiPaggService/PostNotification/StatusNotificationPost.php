<?php
include_once "StatusNotification.php";

const NOTIF_POST_NAME = "xmlStatusNotification";
function GetNotificationXml($xmlStatusNotification) {
	return simplexml_load_string($xmlStatusNotification); // Retorna o objeto do Xml
}

/*@global Parse xml Status Notification */
function ParseXmlToStatusNotification($xml) {
	if (is_null($xml)) { return null; }
	
	$statusNotification = new StatusNotification();
	
	$statusNotification->AmountInCents = $xml->AmountInCents;
	if (isset($xml->AmountPaidInCents)) { $statusNotification->AmountPaidInCents = $xml->AmountPaidInCents; }
	if (isset($xml->OrderKey)) { $statusNotification->OrderKey = $xml->OrderKey; }
	$statusNotification->OrderReference = $xml->OrderReference;
	$statusNotification->OrderStatus = $xml->OrderStatus;
	
	if (isset($xml->BoletoTransaction)) {
		$boletoTrans = null;
		if (!is_null($xml->BoletoTransaction)) {
			$boletoTrans = new BoletoTransactionNotification();
			
			$boletoTrans->AmountInCents = $xml->AmountInCents;
			$boletoTrans->AmountPaidInCents = $xml->AmountPaidInCents;
			$boletoTrans->BoletoExpirationDate = $xml->BoletoExpirationDate;
			$boletoTrans->NossoNumero = $xml->NossoNumero;
			$boletoTrans->StatusChangedDate = $xml->StatusChangedDate;
			$boletoTrans->TransactionKey = $xml->TransactionKey;
			$boletoTrans->TransactionReference = $xml->TransactionReference;
			$boletoTrans->PreviousBoletoTransactionStatus = $xml->PreviousBoletoTransactionStatus;
			$boletoTrans->BoletoTransactionStatus = $xml->BoletoTransactionStatus;
		}
		
		$statusNotification->BoletoTransaction = $boletoTrans;
	}
	
	if (isset($xml->CreditCardTransaction)) {
		$ccTrans = null;
		if (!is_null($xml->CreditCardTransaction)) {
			$ccTrans = new CreditCardTransactionNotification();
			
			$ccTrans->Acquirer = $xml->Acquirer;
			$ccTrans->AmountInCents = $xml->AmountInCents;
			$ccTrans->AuthorizedAmountInCents = $xml->AuthorizedAmountInCents;
			$ccTrans->CapturedAmountInCents = $xml->CapturedAmountInCents;
			$ccTrans->CreditCardBrand = $xml->CreditCardBrand;
			$ccTrans->RefundedAmountInCents = $xml->RefundedAmountInCents;
			$ccTrans->StatusChangedDate = $xml->StatusChangedDate;
			$ccTrans->TransactionIdentifier = $xml->TransactionIdentifier;
			$ccTrans->TransactionKey = $xml->TransactionKey;
			$ccTrans->TransactionReference = $xml->TransactionReference;
			$ccTrans->UniqueSequentialNumber = $xml->UniqueSequentialNumber;
			$ccTrans->VoidedAmountInCents = $xml->VoidedAmountInCents;
			$ccTrans->PreviousCreditCardTransactionStatus = $xml->PreviousCreditCardTransactionStatus;
			$ccTrans->CreditCardTransactionStatus = $xml->CreditCardTransactionStatus;
		}
		
		$statusNotification->CreditCardTransaction = $ccTrans;
	}
	
	return $statusNotification;
}
