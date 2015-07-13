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

					foreach($carrinho as $id => $p)
					{
						$produto = Produto::find($id);

						if($produto['tipo'] != 'Boate')
						{
							$pedido_itens[$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en, 'preco' => $produto->valor, 'tipo' => $produto['tipo'], 'quantidade' => 1);
							$pedido->total += $produto->valor;
						}
						else
						{
							if(isset($p['genero']))
							{
								if(isset($p['genero']['masculino']))
								{
									if(isset($p['genero']['masculino']['inteira']))
									{
										$pedido_itens2['masculino']['inteira'][$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en, 'preco' => $produto->valor_masculino, 'tipo' => 'Masculino - Inteira', 'quantidade' => $p['genero']['masculino']['inteira']);
										$pedido->total += $produto->valor_masculino * $p['genero']['masculino']['inteira'];
									}

									if(isset($p['genero']['masculino']['meia']))
									{
										$pedido_itens2['masculino']['meia'][$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en, 'preco' => $produto->valor_masculino_meia, 'tipo' => 'Masculino - Meia', 'quantidade' => $p['genero']['masculino']['meia']);
										$pedido->total += $produto->valor_masculino_meia * $p['genero']['masculino']['meia'];
									}
								}

								if(isset($p['genero']['feminino']))
								{
									if(isset($p['genero']['feminino']['inteira']))
									{
										$pedido_itens2['feminino']['inteira'][$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en, 'preco' => $produto->valor_feminino, 'tipo' => 'Feminino - Inteira', 'quantidade' => $p['genero']['feminino']['inteira']);
										$pedido->total += $produto->valor_feminino * $p['genero']['feminino']['inteira'];
									}

									if(isset($p['genero']['feminino']['meia']))
									{
										$pedido_itens2['feminino']['meia'][$id] = array('nome_br' => $produto->nome_br, 'nome_en' => $produto->nome_en, 'preco' => $produto->valor_feminino_meia, 'tipo' => 'Feminino - Meia', 'quantidade' => $p['genero']['feminino']['meia']);
										$pedido->total += $produto->valor_feminino_meia * $p['genero']['feminino']['meia'];
									}
								}

							}
						}
					}

					$pedido->save();

					$historico = new PedidoHistorico();

					$historico->pedido_id = $pedido->id;
					$historico->pedido_status_id = 2;

					$historico->save();

					if(isset($pedido_itens))
					{
						$pedido->produtos()->sync($pedido_itens);
					}

					if(isset($pedido_itens2))
					{
						if(isset($pedido_itens2['masculino']['inteira']))
						{
							$pedido->produtos()->attach($pedido_itens2['masculino']['inteira']);
						}
						if(isset($pedido_itens2['masculino']['meia']))
						{
							$pedido->produtos()->attach($pedido_itens2['masculino']['meia']);
						}
						if(isset($pedido_itens2['feminino']['inteira']))
						{
							$pedido->produtos()->attach($pedido_itens2['feminino']['inteira']);
						}
						if(isset($pedido_itens2['feminino']['meia']))
						{
							$pedido->produtos()->attach($pedido_itens2['feminino']['meia']);
						}
					}


				//	Session::forget('carrinho');



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