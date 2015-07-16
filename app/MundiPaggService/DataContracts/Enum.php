<?php
	const NEWLINE = "<br>";
	
	/*@global Currency Iso Enum*/
	class CurrencyIsoEnum {
		const __default = BRL;
		
		const BRL = 'BRL'; //986;
		const EUR = 'EUR'; //978;
		const USD = 'USD'; //840;
		const ARS = 'ARS'; //32;
		const BOB = 'BOB'; //68;
		const CLP = 'CLP'; //152;
		const COP = 'COP'; //170;
		const UYU = 'UYU'; //858;
		const MXN = 'MXN'; //484;
		const PYG = 'PYG'; //600;
	}
	
	/*@global Email Update To Buyer Enum*/
	class EmailUpdateToBuyerEnum {
		const __default = EmailUpdateToBuyerEnum::No;

		const Yes = 'Yes'; //1;
		const No = 'No'; //0;
		const YesIfAuthorized = 'YesIfAuthorized'; //2;
		const YesIfNotAuthorized = 'YesIfNotAuthorized'; //3;
	}
	
	/*@global Credit Card Brand Enum*/
	class CreditCardBrandEnum {
		const __default = CreditCardBrandEnum::Visa;

		const Visa = 'Visa'; //1;
		const Mastercard = 'Mastercard'; //2;
		const Hipercard = 'Hipercard'; //3;
		const Amex = 'Amex'; //4;
		const Diners = 'Diners'; //5;
		const Elo = 'Elo'; //6;
		const Aura = 'Aura'; //7;
		const Discover = 'Discover'; //8;
		const CasaShow = 'CasaShow'; //9;
		const Havan = 'Havan'; //10;
	}
	
	/*@global CreditCard Operation Enum*/
	class CreditCardOperationEnum {
		const __default = CreditCardOperationEnum::AuthOnly;

		const AuthOnly = 'AuthOnly'; //1;
		const AuthAndCapture = 'AuthAndCapture'; //2;
		const AuthAndCaptureWithDelay = 'AuthAndCaptureWithDelay'; //3;
	}
	
	/*@global Frequency Enum*/
	class FrequencyEnum {
		const __default = FrequencyEnum::Weekly;

		const Weekly = 'Weekly'; //1;
		const Monthly = 'Monthly'; //2;
		const Yearly = 'Yearly'; //3;
		const Daily = 'Daily'; //4;
	}
	
	/*@global Gender Enum*/
	class GenderEnum {
		const __default = GenderEnum::M;

		const M = 'M'; //1;
		const F = 'F'; //2;
	}
	
	/*@global Person Type Enum*/
	class PersonTypeEnum {
		const __default = PersonTypeEnum::Person;

		const Person = 'Person'; //1;
		const Company = 'Company'; //2;
	}
	
	/*@global Tax Document Type Enum*/
	class TaxDocumentTypeEnum {
		const __default = TaxDocumentTypeEnum::CPF;

		const CPF = 'CPF'; //1;
		const CNPJ = 'CNPJ'; //2;
	}
	
	/*@global Address Type Enum*/
	class AddressTypeEnum {
		const __default = AddressTypeEnum::Billing;

		const Billing = 'Billing'; //1;
		const Shipping = 'Shipping'; //2;
		const Comercial = 'Comercial'; //3;
		const Residential = 'Residential'; //4;
	}
	
	/*@global Country Enum*/
	class CountryEnum {
		const __default = CountryEnum::Brazil;

		const Brazil = 'Brazil'; //1;
		const USA = 'USA'; //2;
		const Argentina = 'Argentina'; //3;
		const Bolivia = 'Bolivia'; //4;
		const Chile = 'Chile'; //5;
		const Colombia = 'Colombia'; //6;
		const Uruguay = 'Uruguay'; //7;
		const Mexico = 'Mexico'; //8;
		const Paraguay = 'Paraguay'; //9;
	}
	
	/*@global Order Status Enum */
	class OrderStatusEnum {
		const __default = OrderStatusEnum::Opened;
		
		const Opened = "Opened"; //1;
		const Closed = 'Closed'; //2;
		const Paid = 'Paid'; //3;
		const Overpaid = 'Overpaid'; //4;
		const Canceled = 'Canceled'; //5;
		const PartialPaid = 'PartialPaid'; //6;
		const WithError = 'WithError'; //7;
	}
	
	/*@global CreditCard Transaction Status Enum*/
	class CreditCardTransactionStatusEnum {
		const __default = CreditCardTransactionStatusEnum::AuthorizedPendingCapture;
		
		const AuthorizedPendingCapture = 'AuthorizedPendingCapture'; //1,
        const NotAuthorized = 'NotAuthorized'; //2,
        const ChargebackPreview = 'ChargebackPreview'; //3,
        const RefundPreview = 'RefundPreview'; //4,
        const DepositPreview = 'DepositPreview'; //5,
        const Captured = 'Captured'; //6,
        const PartialCapture = 'PartialCapture'; //7,
        const Refunded = 'Refunded'; //8,
        const Voided = 'Voided'; //9,
        const Deposited = 'Deposited'; //10,
        const OpenedPendindAuth = 'OpenedPendindAuth'; //11,
        const Chargedback = 'Chargedback'; //12,
        const PendingVoid = 'PendingVoid'; //13,
        const Invalid = 'Invalid'; //14,
        const PartialAuthorize = 'PartialAuthorize'; //15,
        const PartialRefunded = 'PartialRefunded'; //16,
        const OverCapture = 'OverCapture'; //17,
        const PartialVoid = 'PartialVoid'; //18,
        const PendingRefund = 'PendingRefund'; //19,
        const UnScheduled = 'UnScheduled'; //20,
        const WithError = 'WithError'; //99,
	}
	
	/*@global Severity Code Enum*/
	class SeverityCodeEnum {
		const __default = SeverityCodeEnum::Error;
		
		const Error = 'Error'; //1;
		const Warning = 'Warning'; //2;
	}
	
	/*@global Manage Order Operation Enum*/
	class ManageOrderOperationEnum {
		const __default = ManageOrderOperationEnum::Capture;
		
		const Capture = 'Capture'; //1,
		const Void = 'Void'; //2,
		const Authorize = 'Authorize'; //3,
	}
	
	/*@global Boleto Transaction Status Enum*/
	class BoletoTransactionStatusEnum {
		const __default = BoletoTransactionStatusEnum::Generated;
		
		const Generated = 'Generated'; //1,
		const Viewed = 'Viewed'; //2,
		const Underpaid = 'Underpaid'; //3,
		const Overpaid = 'Overpaid'; //4,
		const Paid = 'Paid'; //5,
		const Voided = 'Voided'; //6,
		const WithError = 'WithError'; //99,
	}
