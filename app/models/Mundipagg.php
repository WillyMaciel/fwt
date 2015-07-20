<?php

class Mundipagg
{
	private $client;

	const MerchantKey = '0a31c3dc-f2f1-4327-841b-4feaf7db147d';

	public function __construct()
	{
		include_once app_path() . "/MundiPaggServiceConfiguration.php";
		include_once  constant("MP_SERVICE_CLIENT") . "MundiPaggSoapServiceClient.php";
		$ENABLE_WSDL_CACHE = false; // In MundiPaggServiceConfiguration.php
		$this->client = new MundiPaggSoapServiceClient('LOCAL',null,true);
	}

	public function printTeste()
	{
		echo 'PRINT';
	}

	public function postRetorno()
	{
		$input = Input::all();

		if($input)
		{
			$retorno = new Retorno;

			$retorno->serialize = serialize($input);
			$retorno->save();
		}
	}

	public function getView()
	{
		return View::make('checkout.checkout');
	}

	public function createOrder($input, Pedido $pedido)
	{
		$orderRequest = $this->createCreateOrder($input, $pedido);
		$orderResponse = $this->client->CreateOrder($orderRequest);

		// return $orderRequest;

		return $orderResponse;
		// echo '<pre>';
		// var_dump($orderResponse);
		// echo '</pre>';
	}

	public function getManageOrder()
	{
		$manageRequest = $this->manageOrder('e62aa19f-e221-4f13-a758-f9ba5aa8591b');
		$orderResponse = $this->client->ManageOrder($manageRequest);

		// $manageRequest = CreateManageOrder("fde8193b-583c-41b8-8479-a91ddd70ae00");
// $manageResponse = $client->ManageOrder($manageRequest);
// var_dump ($manageResponse);

		echo '<pre>';
		var_dump($orderResponse);
		echo '</pre>';
	}

	private function manageOrder($orderKey)
	{
		$manageRequest = new ManageOrderRequest();

		$manageRequest->OrderKey = $orderKey;

		//$manageRequest->ManageOrderOperationEnum = ManageOrderOperationEnum::Capture;
		$manageRequest->ManageOrderOperationEnum = ManageOrderOperationEnum::Void;

		return $manageRequest;
	}


	public function createCreateOrder($input, Pedido $pedido)
	{

		$tcents = $pedido->total * 100;

		$orderRequest = new CreateOrderRequest();
		//$orderRequest = new stdClass();
		// Campos principais do objeto CreateOrderRequest
	    $orderRequest->CurrencyIsoEnum = "BRL";
		$orderRequest->AmountInCents = $tcents;
		$orderRequest->AmountInCentsToConsiderPaid = $tcents;
		$orderRequest->Retries = 0;
		//$orderRequest->OrderReference = "SDK-PHP - Teste de Integracao - Matheus AR " . rand(0, 100000) ;
		$orderRequest->OrderReference = $pedido->id;
		//$orderRequest->EmailUpdateToBuyerEnum = "No";

		$cliente = Auth::user();

		$buyer = new Buyer();
		$buyer->BuyerReference = $cliente->id;
		$buyer->Email = $cliente->email;
		if($cliente->sexo)
		{
			$buyer->GenderEnum = $cliente->sexo;
		}
		$buyer->MobilePhone = $input['telefonetitular'];
		$buyer->Name = $cliente->nome;
		$buyer->PersonTypeEnum = 'Person';
		$buyer->TaxDocumentNumber = $input['cpftitular'];
		$buyer->TaxDocumentTypeEnum = 'CPF';

		if($cliente->endereco)
		{
			$endereco = $cliente->endereco;

			$addr1 = new BuyerAddress();
			$addr1->AddressTypeEnum = AddressTypeEnum::Residential;
			$addr1->City = $endereco->cidade;
			$addr1->Complement = $endereco->complemento;
			$addr1->CountryEnum = CountryEnum::Brazil;
			$addr1->Number = $endereco->numero;
			$addr1->State = $endereco->estado;
			$addr1->Street = $endereco->rua;
			$addr1->ZipCode = $endereco->cep;
		}

		// $addr2 = new BuyerAddress();
		// $addr2->AddressTypeEnum = AddressTypeEnum::Residential;
		// $addr2->City = 'Sao Paulo';
		// $addr2->Complement = 'Apto 501';
		// $addr2->CountryEnum = CountryEnum::Brazil;
		// $addr2->Number = 348;
		// $addr2->State = 'SP';
		// $addr2->Street = 'Rua da Qualquer Coisa';
		if(isset($addr1))
		{
			$buyer->BuyerAddressCollection = array($addr1);
		}

		$orderRequest->Buyer = $buyer;

		//// CARTÃO 1
		// Criação de uma transação de cartão de crédito
		// $ccTransaction1 = new CreditCardTransaction();
		// $ccTransaction1->AmountInCents = 9;
		// $ccTransaction1->CreditCardNumber = "518294741544019";
		// // Número do cartão de crédito
		// $ccTransaction1->HolderName = "Maria do Carmo";
		// $ccTransaction1->SecurityCode = 197;
		// $ccTransaction1->ExpMonth = 10;
		// $ccTransaction1->ExpYear = 17;
		// $ccTransaction1->CreditCardBrandEnum = 'Visa';
		// $ccTransaction1->PaymentMethodCode = 1;
		// // Define o tipo da autorização
		// $ccTransaction1->CreditCardOperationEnum = "AuthOnly";

		// //// CARTÃO 2
		// // Criação de uma transação de cartão de crédito
		// $ccTransaction2 = new CreditCardTransaction();
		// $ccTransaction2->AmountInCents = 20;
		// $ccTransaction2->CreditCardNumber = "65444454544112";
		// // Número do cartão de crédito
		// $ccTransaction2->HolderName = "Jose Farias";
		// $ccTransaction2->SecurityCode = 546;
		// $ccTransaction2->ExpMonth = 8;
		// $ccTransaction2->ExpYear = 19;
		// $ccTransaction2->CreditCardBrandEnum = 'Mastercard';
		// $ccTransaction2->PaymentMethodCode = 1;
		// // Define o tipo da autorização
		// $ccTransaction1->CreditCardOperationEnum = "AuthOnly";

		//// CARTÃO 3
		// Criação de uma transação de cartão de crédito
		$ccTransaction3 = new CreditCardTransaction();
		$ccTransaction3->AmountInCents = $tcents;
		$ccTransaction3->CreditCardNumber = $input['card_number'];
		// Número do cartão de crédito
		$ccTransaction3->HolderName = $input['nometitular'];
		$ccTransaction3->SecurityCode = $input['cvv'];
		$ccTransaction3->ExpMonth = $input['mes_cartao'];
		$ccTransaction3->ExpYear = $input['ano_cartao'];
		$ccTransaction3->CreditCardBrandEnum = $input['card_brand'];
		$ccTransaction3->InstallmentCount = $input['parcelas'];
		$ccTransaction3->PaymentMethodCode = 1;
		// Define o tipo da autorização
		$ccTransaction3->CreditCardOperationEnum = "AuthAndCapture";

		// /// BOLETO 1
		// // Criação de uma transação por boleto
		// $boletoTransaction1 = new BoletoTransaction();
		// $boletoTransaction1->AmountInCents = 3000;
		// $boletoTransaction1->BankNumber = 789;
		// $boletoTransaction1->Instructions = "Nao receber apos vencimento.";
		// $boletoTransaction1->NossoNumero = 47826;
		// $boletoTransaction1->DaysToAddInBoletoExpirationDate = 5;

		// /// BOLETO 2
		// // Criação de uma transação por boleto
		// $boletoTransaction2 = new BoletoTransaction();
		// $boletoTransaction2->AmountInCents = 5000;
		// $boletoTransaction2->BankNumber = 641;
		// $boletoTransaction2->Instructions = "Nao receber apos vencimento.";
		// $boletoTransaction2->NossoNumero = 55411;
		// $boletoTransaction2->DaysToAddInBoletoExpirationDate = 9;
		// Adiciona as transações no OrderRequest
		$orderRequest->CreditCardTransactionCollection = array ($ccTransaction3);
		//$orderRequest->BoletoTransactionCollection = array ( $boletoTransaction1/*, $boletoTransaction2*/ );
		$shopCart = new ShoppingCart();
		$shopCart->FreighCostInCents = $tcents;

		$itens_carrinho = array();

		foreach($pedido->produtos as $p)
		{
			$shopCartItem = new ShoppingCartItem();
			$shopCartItem->Name = $p->nome_br;
			$shopCartItem->Quantity = $p->pivot->quantidade;
			$shopCartItem->TotalCostInCents = $p->pivot->quantidade * $p->pivot->preco;
			$shopCartItem->UnitCostInCents = $p->pivot->preco * 100;
			$shopCartItem->ItemReference = $p->id;

			$itens_carrinho[] = $shopCartItem;
		}

		$shopCart->ShoppingCartItemCollection = $itens_carrinho;

		$orderRequest->ShoppingCartCollection = array ( $shopCart );

		return $orderRequest;
	}


	public function createOrderBasico($id)
	{

		$pedido = Pedido::findOrFail($id);

		$cliente = Auth::user();

		if($pedido->usuario->id != $cliente->id)
		{
			return false;
		}

		$valor_centavos = $pedido->total * 100;

		$input = Input::all();

		if($input['parcelas'] < 1 || $input['parcelas'] > 6)
		{
			return false;
		}

		$client = new SoapClient('https://transaction.mundipaggone.com/MundiPaggService.svc?wsdl',
		array('trace' => true,
		'exceptions' => true,
		'style' => SOAP_DOCUMENT,
		'use' => SOAP_LITERAL,
		'encoding' => 'UTF-8'));

		$createOrderRequest = new stdClass();
		$createOrderRequest->createOrderRequest = new stdClass();
		//$createOrderRequest->createOrderRequest->AmountInCents = 105172;
		$createOrderRequest->createOrderRequest->AmountInCents = $valor_centavos;
		$createOrderRequest->createOrderRequest->CurrencyIsoEnum = 'BRL';
		$createOrderRequest->createOrderRequest->MerchantKey = self::MerchantKey;
		$createOrderRequest->createOrderRequest->OrderReference = $pedido->id;
		$createOrderRequest->createOrderRequest->Buyer = new stdClass();
		$createOrderRequest->createOrderRequest->Buyer->Email = $cliente->email;
		$createOrderRequest->createOrderRequest->Buyer->HomePhone = '(11) 12345678';
		$createOrderRequest->createOrderRequest->Buyer->Name = $cliente->nome;
		$createOrderRequest->createOrderRequest->Buyer->PersonTypeEnum = 'Person';
		$createOrderRequest->createOrderRequest->Buyer->TaxDocumentNumber = $cliente->cpf;
		$createOrderRequest->createOrderRequest->Buyer->TaxDocumentTypeEnum = 'CPF';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection = [];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0] = new stdClass();
		//$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->AmountInCents = 105172;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->AmountInCents = $valor_centavos;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CaptureDelayInMinutes = 0;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CreditCardBrandEnum = $input['cartao_marca'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CreditCardNumber = $input['cartao_num'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->ExpMonth = $input['mes_exp'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->ExpYear = $input['ano_exp'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->HolderName = $input['nome_titular'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->InstallmentCount = $input['parcelas'];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->PaymentMethodCode = 1;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->SecurityCode = $input['cod_seguranca'];

		try {
		$auth = $client->CreateOrder($createOrderRequest);
		$result = $auth->CreateOrderResult;
		$cctResult = $result->CreditCardTransactionResultCollection->CreditCardTransactionResult;

		printf("Exemplo de integração Mundipagg com PHP - CreateOrder\n\n");
		printf("\t[%s -> %s] %s\n\n", $result->OrderStatusEnum,
		$cctResult->CreditCardTransactionStatusEnum,
		$cctResult->AcquirerMessage);

		} catch (SoapFault $e) {
		printf("Erro[%s]: %s\n%s\n\n", $e->getCode(), $e->getMessage(), $e->getTraceAsString());
		}
	}

}