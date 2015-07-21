<?php

class CarrinhoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /carrinho
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$produtos = false;

		if(Session::has('carrinho') && !empty(Session::get('carrinho')))
		{
			$carrinho = Session::get('carrinho');
			foreach($carrinho as $key => $p)
			{
				$carrinho[$key]['produto'] = Produto::find($key);
			}

		}
		else
		{
			$carrinho = false;
		}

		debug($carrinho);

		return View::make('carrinho.index', compact('carrinho'));
	}

	public function postAdd()
	{

		if(!Session::has('carrinho'))
		{
			Session::put('carrinho', array());
		}

		$carrinho = Session::get('carrinho');

		if(Input::has('produto'))
		{
			if(array_key_exists(Input::get('produto'), $carrinho))
			{
				return Redirect::back()->with('warning', array('Este evento/serviço ja se encontra no carrinho.'));
			}
			else
			{
				$produto = Produto::Find(Input::get('produto'));

				if(Input::has('quantidade'))
				{
					$quantidade = Input::get('quantidade');

					if($quantidade['masculino'])
					{
						if(isset($quantidade['masculino']['inteira']) && !empty($quantidade['masculino']['inteira']))
						{
							$carrinho[Input::get('produto')]['genero']['masculino']['inteira'] = $quantidade['masculino']['inteira'];
						}
						if(isset($quantidade['masculino']['meia']) && !empty($quantidade['masculino']['meia']))
						{
							$carrinho[Input::get('produto')]['genero']['masculino']['meia'] = $quantidade['masculino']['meia'];
						}

					}
					if($quantidade['feminino'])
					{
						if(isset($quantidade['feminino']['inteira']) && !empty($quantidade['feminino']['inteira']))
						{
							$carrinho[Input::get('produto')]['genero']['feminino']['inteira'] = $quantidade['feminino']['inteira'];
						}
						if(isset($quantidade['feminino']['meia']) && !empty($quantidade['feminino']['meia']))
						{
							$carrinho[Input::get('produto')]['genero']['feminino']['meia'] = $quantidade['feminino']['meia'];
						}
					}
				}

				$carrinho[Input::get('produto')]['quantidade'] = 1;

				if($produto->tipo)
				{
					$carrinho[Input::get('produto')]['tipo'] = $produto->tipo;
				}


				$carrinho[Input::get('produto')]['valor'] = $produto->valor;

				if(Input::has('extra'))
				{
					$extra = Input::get('extra');
					$carrinho[Input::get('produto')]['extra']['data'] 			= $extra['data'];
					$carrinho[Input::get('produto')]['extra']['numero_pessoas'] = $extra['numero_pessoas'];
					$carrinho[Input::get('produto')]['extra']['hotel'] 			= $extra['hotel'];
				}

				Session::put('carrinho', $carrinho);

				return Redirect::back()->with('success', array('item adicionado ao carrinho!.'));
			}
		}
		else
		{
			return Redirect::back()->with('danger', array('Id do produto não encontrado.'));
		}
	}

	public function getRemove($id)
	{
		$carrinho = Session::get('carrinho');
		if(array_key_exists($id, $carrinho))
		{
			unset($carrinho[$id]);

			Session::forget('carrinho');
			Session::put('carrinho', $carrinho);

			return Redirect::back()->with('success', array('Item removido do carrinho.'));
		}
		// debug($carrinho);
		// debug($id);
		// debug($key);

		// return View::make('hello');

		return Redirect::back()->with('warning', array('Item não encontrado.'));
	}

	public function getLimpar()
	{
		if(Session::has('carrinho'))
		{
			Session::forget('carrinho');
		}

		return Redirect::back()->with('success', array('Seu carrinho foi esvaziado.'));
	}

	public function getPag()
	{
		$client = new SoapClient('https://transaction.mundipaggone.com/MundiPaggService.svc?wsdl',
		array('trace' => true,
		'exceptions' => true,
		'style' => SOAP_DOCUMENT,
		'use' => SOAP_LITERAL,
		'encoding' => 'UTF-8'));

		$createOrderRequest = new stdClass();
		$createOrderRequest->createOrderRequest = new stdClass();
		//$createOrderRequest->createOrderRequest->AmountInCents = 105172;
		$createOrderRequest->createOrderRequest->AmountInCents = 10000;
		$createOrderRequest->createOrderRequest->CurrencyIsoEnum = 'BRL';
		$createOrderRequest->createOrderRequest->MerchantKey = '0a31c3dc-f2f1-4327-841b-4feaf7db147d';
		$createOrderRequest->createOrderRequest->OrderReference = 'novoteste2';
		$createOrderRequest->createOrderRequest->Buyer = new stdClass();
		$createOrderRequest->createOrderRequest->Buyer->Email = 'comprador@email.com';
		$createOrderRequest->createOrderRequest->Buyer->HomePhone = '(11) 12345678';
		$createOrderRequest->createOrderRequest->Buyer->Name = 'Fulano de Tal';
		$createOrderRequest->createOrderRequest->Buyer->PersonTypeEnum = 'Person';
		$createOrderRequest->createOrderRequest->Buyer->TaxDocumentNumber = '000.000.000-00';
		$createOrderRequest->createOrderRequest->Buyer->TaxDocumentTypeEnum = 'CPF';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection = [];
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0] = new stdClass();
		//$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->AmountInCents = 105172;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->AmountInCents = 10000;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CaptureDelayInMinutes = 0;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CreditCardBrandEnum = 'Mastercard';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->CreditCardNumber = '5555666677778884';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->ExpMonth = '1';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->ExpYear = '2018';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->HolderName = 'Fulano de Tal';
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->InstallmentCount = 1;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->PaymentMethodCode = 1;
		$createOrderRequest->createOrderRequest->CreditCardTransactionCollection[0]->SecurityCode = '123';

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