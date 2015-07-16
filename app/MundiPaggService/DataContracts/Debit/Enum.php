<?php
	const NEWLINE = '<br>';

	class AddressTypeEnum {
		const __default = self::Billing;

        const Billing = 'Billing';
        const Shipping = 'Shipping';
        const Comercial = 'Comercial';
        const Residential = 'Residential';
    }

    class CountryEnum {
    	const __default = self::Brazil;

        const Brazil = 'Brazil';
        const USA = 'USA';
        const Argentina = 'Argentina';
        const Bolivia = 'Bolivia';
        const Chile = 'Chile';
        const Colombia = 'Colombia';
        const Uruguay = 'Uruguay';
        const Mexico = 'Mexico';
        const Paraguay = 'Paraguay';
    }

	class GenderEnum {
		const __default = self::M;

        const M = 'M';
        const F = 'F';
    }

	class PaymentMethodEnum {
		const __default = self::Bradesco;

        const Bradesco = 'Bradesco';
        const Itau = 'Itau';
        const BancoDoBrasil = 'BancoDoBrasil';
        const VBV = 'VBV';
        const Sitef = 'Sitef';
    }


	class OnlineDebitTransactionStatusEnum {
		const __default = self::OpenedPendingPayment;

        const OpenedPendingPayment = 'OpenedPendingPayment';
        const NotPaid = 'NotPaid';
        const Paid = 'Paid';
        const UnderPaid = 'UnderPaid';
        const OverPaid = 'OverPaid';
        const NotFound = 'NotFound';
        const WithError = 'WithError';

    }

	class PersonTypeEnum {
		const __default = self::Person;

        const Person = 'Person';
        const Company = 'Company';

    }


	class PhoneTypeEnum {
		const __default = self::Mobile;

        const Mobile = 'Mobile';
        const Residential = 'Residential';
        const Comercial = 'Comercial';
    }

    class TaxDocumentTypeEnum {
    	const __default = self::CPF;

        const CPF = 'CPF';
        const CNPJ = 'CNPJ';
    }

    class SeverityCodeEnum {
        const __default = self::Error;

        const Error = 'Error';
        const Warning = 'Warning';
    }
