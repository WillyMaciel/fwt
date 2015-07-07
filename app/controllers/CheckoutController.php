<?php

class CheckoutController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /checkout
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function getFinalizar()
	{
		if(Auth::check())
		{
			if(Session::has('carrinho'))
			{
				$carrinho = Session::get('carrinho');
				if(count($carrinho) > 0)
				{
					$user = Auth::user();

					$pedido = new Pedido;

					$pedido->cliente_id 		= $user->id;
					$pedido->nome 				= $user->nome;
					$pedido->email 				= $user->email;
					$pedido->pedido_status_id 	= 2;

					$pedido->save();

					$historico = new PedidoHistorico();

					$historico->pedido_id = $pedido->id;
					$historico->pedido_status_id = 2;

					$historico->save();

					foreach($carrinho as $id => $produto)
					{
						$produto = Produto::find($id);
						$pedido_itens[$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en);
					}

					$pedido->produtos()->sync($pedido_itens);

					Session::forget('carrinho');
				}

				return Redirect::to('cliente/pedido')->with('success', array('Seu pedido foi feito e esta sendo analizado. Em breve você receberá o valor do seu pedido e poderá pagar online.'));
			}
		}
		else
		{
			return Redirect::to('users/login')->with('warning', array('Você precisa estar logado para fazer um pedido!'));
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /checkout/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /checkout
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /checkout/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /checkout/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /checkout/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /checkout/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}