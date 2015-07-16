<?php
class OnlineDebitTransactionData {

		/*@var [Guid] Order creation date*/
		public $OnlineDebitTransactionKey;
		/*@var [String] Order creation date*/
		public $TransactionReference;
		/*@var [Long] Order creation date*/
		public $AmountInCents;
		/*@var [Nullable<Long>] Order creation date*/
		public $AmountPaidInCents;
		/*@var [String] Order creation date*/
		public $OnlineDebitStatusEnum;
		/*@var [String] Order creation date*/
		public $CreateDate;
		/*@var [String] Order creation date*/
		public $TransactionKeyToBank;
		/*@var [String] Order creation date*/
		public $TransactionIdentifier;
		/*@var [String] Order creation date*/
		public $Signature;
		/*@var [String] Order creation date*/
		public $BankPaymentDate;

		function __construct() {

			$this->OnlineDebitTransactionKey = null;
			$this->TransactionReference = null;
			$this->AmountInCents = 0;
			$this->AmountPaidInCents = 0;
			$this->OnlineDebitStatusEnum = null;
			$this->CreateDate = null;
			$this->TransactionKeyToBank = null;
			$this->TransactionIdentifier = null;
			$this->Signature = null;
			$this->BankPaymentDate = null;
		}
    }
