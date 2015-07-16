<?php
//include_once constant("MP_POST_NOTIFICATION") . "StatusNotification.php";

$_POST[$STATUS_NOTIF_POST] = GetXml();
// $_POST[$STATUS_NOTIF_POST] = GetCreditCardXml();
// $_POST[$STATUS_NOTIF_POST] = GetBoletoXml();
// $_POST[$STATUS_NOTIF_POST] = GetOnlineDebitXml();
// $_POST[$STATUS_NOTIF_POST] = GetNoTransactionsXml();
$xmlString = $_POST[$STATUS_NOTIF_POST];

// Converte o Xml para um objeto do tipo StatusNotification
$statusNotification = StatusNotification::ParseFromXml($xmlString);

// Exibe o conteúdo
var_dump($statusNotification);







function GetXml() {
	return utf8_encode( utf8_encode ('<StatusNotification xmlns="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract"
                    xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
                    i:schemaLocation="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract StatusNotificationXmlSchema.xsd">
  <AmountInCents>500</AmountInCents>
  <AmountPaidInCents>0</AmountPaidInCents>
  <BoletoTransaction>
    <AmountInCents>500</AmountInCents>
    <AmountPaidInCents>0</AmountPaidInCents>
    <BoletoExpirationDate>2013-02-08T00:00:00</BoletoExpirationDate>
    <NossoNumero>0123456789</NossoNumero>
    <StatusChangedDate>2012-11-06T08:55:49.753</StatusChangedDate>
    <TransactionKey>4111D523-9A83-4BE3-94D2-160F1BC9C4BD</TransactionKey>
    <TransactionReference>B2E32108</TransactionReference>
    <PreviousBoletoTransactionStatus>Generated</PreviousBoletoTransactionStatus>
    <BoletoTransactionStatus>Paid</BoletoTransactionStatus>
  </BoletoTransaction>
  <CreditCardTransaction>
    <Acquirer>Simulator</Acquirer>
    <AmountInCents>2000</AmountInCents>
    <AuthorizedAmountInCents>2000</AuthorizedAmountInCents>
    <CapturedAmountInCents>2000</CapturedAmountInCents>
    <CreditCardBrand>Visa</CreditCardBrand>
    <RefundedAmountInCents i:nil="true"/>
    <StatusChangedDate>2012-11-06T10:52:55.93</StatusChangedDate>
    <TransactionIdentifier>123456</TransactionIdentifier>
    <TransactionKey>351FC96A-7F42-4269-AF3C-1E3C179C1CD0</TransactionKey>
    <TransactionReference>24de0432</TransactionReference>
    <UniqueSequentialNumber>123456</UniqueSequentialNumber>
    <VoidedAmountInCents i:nil="true"/>
    <PreviousCreditCardTransactionStatus>AuthorizedPendingCapture</PreviousCreditCardTransactionStatus>
    <CreditCardTransactionStatus>Captured</CreditCardTransactionStatus>
  </CreditCardTransaction>
  <!--O nó OnlineDebitTransaction só é enviado caso uma transação de débito esteja sendo notificada-->
  <OnlineDebitTransaction>
    <AmountInCents>100</AmountInCents>
    <AmountPaidInCents>0</AmountPaidInCents>
    <StatusChangedDate>2013-06-27T19:46:46.87</StatusChangedDate>
    <TransactionKey>fb3f158a-0309-4ae3-b8ef-3c5ac2d603d2</TransactionKey>
    <TransactionReference>30bfee13-c908-4e3b-9f70-1f84dbe79fbf</TransactionReference>
    <PreviousOnlineDebitTransactionStatus>OpenedPendingPayment</PreviousOnlineDebitTransactionStatus>
    <OnlineDebitTransactionStatus>NotPaid</OnlineDebitTransactionStatus>
  </OnlineDebitTransaction>
  <!--O nó OnlineDebitTransaction só é enviado caso uma transação de débito esteja sendo notificada-->  
  <MerchantKey>B1B1092C-8681-40C2-A734-500F22683D9B</MerchantKey>
  <OrderKey>18471F05-9F6D-4497-9C24-D60D5BBB6BBE</OrderKey>
  <OrderReference>64a85875</OrderReference>
  <OrderStatus>Paid</OrderStatus>
</StatusNotification>') );
}

function GetCreditCardXml() {
	return utf8_encode( utf8_encode ('<StatusNotification xmlns="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract"
                    xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
                    i:schemaLocation="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract StatusNotificationXmlSchema.xsd">
  <AmountInCents>500</AmountInCents>
  <AmountPaidInCents>0</AmountPaidInCents>
  <CreditCardTransaction>
    <Acquirer>Simulator</Acquirer>
    <AmountInCents>2000</AmountInCents>
    <AuthorizedAmountInCents>2000</AuthorizedAmountInCents>
    <CapturedAmountInCents>2000</CapturedAmountInCents>
    <CreditCardBrand>Visa</CreditCardBrand>
    <RefundedAmountInCents i:nil="true"/>
    <StatusChangedDate>2012-11-06T10:52:55.93</StatusChangedDate>
    <TransactionIdentifier>123456</TransactionIdentifier>
    <TransactionKey>351FC96A-7F42-4269-AF3C-1E3C179C1CD0</TransactionKey>
    <TransactionReference>24de0432</TransactionReference>
    <UniqueSequentialNumber>123456</UniqueSequentialNumber>
    <VoidedAmountInCents i:nil="true"/>
    <PreviousCreditCardTransactionStatus>AuthorizedPendingCapture</PreviousCreditCardTransactionStatus>
    <CreditCardTransactionStatus>Captured</CreditCardTransactionStatus>
  </CreditCardTransaction>
  <MerchantKey>B1B1092C-8681-40C2-A734-500F22683D9B</MerchantKey>
  <OrderKey>18471F05-9F6D-4497-9C24-D60D5BBB6BBE</OrderKey>
  <OrderReference>64a85875</OrderReference>
  <OrderStatus>Paid</OrderStatus>
</StatusNotification>') );
}

function GetBoletoXml() {
	return utf8_encode( utf8_encode ('<StatusNotification xmlns="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract"
                    xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
                    i:schemaLocation="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract StatusNotificationXmlSchema.xsd">
  <AmountInCents>500</AmountInCents>
  <AmountPaidInCents>0</AmountPaidInCents>
  <BoletoTransaction>
    <AmountInCents>500</AmountInCents>
    <AmountPaidInCents>0</AmountPaidInCents>
    <BoletoExpirationDate>2013-02-08T00:00:00</BoletoExpirationDate>
    <NossoNumero>0123456789</NossoNumero>
    <StatusChangedDate>2012-11-06T08:55:49.753</StatusChangedDate>
    <TransactionKey>4111D523-9A83-4BE3-94D2-160F1BC9C4BD</TransactionKey>
    <TransactionReference>B2E32108</TransactionReference>
    <PreviousBoletoTransactionStatus>Generated</PreviousBoletoTransactionStatus>
    <BoletoTransactionStatus>Paid</BoletoTransactionStatus>
  </BoletoTransaction>
  <MerchantKey>B1B1092C-8681-40C2-A734-500F22683D9B</MerchantKey>
  <OrderKey>18471F05-9F6D-4497-9C24-D60D5BBB6BBE</OrderKey>
  <OrderReference>64a85875</OrderReference>
  <OrderStatus>Paid</OrderStatus>
</StatusNotification>') );
}

function GetOnlineDebitXml() {
	return utf8_encode( utf8_encode ('<StatusNotification xmlns="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract"
                    xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
                    i:schemaLocation="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract StatusNotificationXmlSchema.xsd">
  <AmountInCents>500</AmountInCents>
  <AmountPaidInCents>0</AmountPaidInCents>
  <OnlineDebitTransaction>
    <AmountInCents>100</AmountInCents>
    <AmountPaidInCents>0</AmountPaidInCents>
    <StatusChangedDate>2013-06-27T19:46:46.87</StatusChangedDate>
    <TransactionKey>fb3f158a-0309-4ae3-b8ef-3c5ac2d603d2</TransactionKey>
    <TransactionReference>30bfee13-c908-4e3b-9f70-1f84dbe79fbf</TransactionReference>
    <PreviousOnlineDebitTransactionStatus>OpenedPendingPayment</PreviousOnlineDebitTransactionStatus>
    <OnlineDebitTransactionStatus>NotPaid</OnlineDebitTransactionStatus>
  </OnlineDebitTransaction>
  <MerchantKey>B1B1092C-8681-40C2-A734-500F22683D9B</MerchantKey>
  <OrderKey>18471F05-9F6D-4497-9C24-D60D5BBB6BBE</OrderKey>
  <OrderReference>64a85875</OrderReference>
  <OrderStatus>Paid</OrderStatus>
</StatusNotification>') );
}

function GetNoTransactionsXml() {
	return utf8_encode( utf8_encode ('<StatusNotification xmlns="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract"
                    xmlns:i="http://www.w3.org/2001/XMLSchema-instance"
                    i:schemaLocation="http://schemas.datacontract.org/2004/07/MundiPagg.NotificationService.DataContract StatusNotificationXmlSchema.xsd">
  <AmountInCents>500</AmountInCents>
  <AmountPaidInCents>0</AmountPaidInCents>
  <BoletoTransaction />
  <CreditCardTransaction></CreditCardTransaction>
  <MerchantKey>B1B1092C-8681-40C2-A734-500F22683D9B</MerchantKey>
  <OrderKey>18471F05-9F6D-4497-9C24-D60D5BBB6BBE</OrderKey>
  <OrderReference>64a85875</OrderReference>
  <OrderStatus>Paid</OrderStatus>
</StatusNotification>') );
}

