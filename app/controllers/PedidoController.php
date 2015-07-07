<?php

class PedidoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /pedido
	 *
	 * @return Response
	 */
	public function index()
	{
		$pedidos = Auth::user()->pedidos()->paginate(10);

		//debug($pedidos);
		return View::make('cliente.pedido.index', compact('pedidos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /pedido/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /pedido
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /pedido/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pedido = Pedido::with('produtos')->find($id);

		if($pedido && $pedido->cliente_id == Auth::user()->id)
		{
			return View::make('cliente.pedido.show', compact('pedido'));
		}
		else
		{
			return Redirect::back()->with('danger', array('Pedido não encontrado'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /pedido/{id}/edit
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
	 * PUT /pedido/{id}
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
	 * DELETE /pedido/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}