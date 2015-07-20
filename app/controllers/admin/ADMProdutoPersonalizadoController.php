<?php

class ADMProdutoPersonalizadoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admpedido
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(new User);
        $filter->add('nome','Nome do Cliente', 'text');
        $filter->add('email','Email do Cliente', 'text');
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('id','Id Cliente', true); //field name, label, sortable
		$grid->add('nome','Nome do Cliente', true); //field name, label, sortable
		$grid->add('email','Email do Cliente'); //relation.fieldname
		$grid->add('					
					<a class="" title="Criar Produtos" href="admin/produto-personalizado/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>					
					', 'Ações');
		//$grid->edit('admin/serviconoturno/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->orderBy('id','desc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));


		return View::make('admin.produtopersonalizado.index', compact('filter', 'grid'));
	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /admpedido/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cliente = User::findOrFail($id);

		$status = PedidoStatus::all();

		return View::make('admin.produtopersonalizado.edit', compact('cliente', 'status'));
	}

	public function store()
	{
		$user = User::findOrFail(Input::get('cliente_id'));

		$input = Input::all();

		$pedido = new Pedido;

		$pedido->cliente_id 		= $user->id;
		$pedido->nome 				= $user->nome;
		$pedido->email 				= $user->email;
		$pedido->pedido_status_id 	= $input['status'];

		$produtos = $input['produtos'];

		foreach($produtos as $id => $produto)
		{

			$pedido_itens[][63] = array('nome_br' => $produto['nome'], 'nome_en' => $produto['nome'], 'preco' => $produto['preco'], 'tipo' => '', 'quantidade' => $produto['quantidade']);
			$pedido->total += $produto['preco'] * $produto['quantidade'];
		}

		$pedido->save();

		$historico = new PedidoHistorico();

		$historico->pedido_id = $pedido->id;
		$historico->pedido_status_id = 12;

		$historico->save();

		if(isset($pedido_itens))
		{
			foreach($pedido_itens as $key => $iten)
			{
				$pedido->produtos()->attach($iten);
			}			
		}

		return Redirect::to("admin/pedido/$pedido->id/edit")->with('success', array('Pedido gerado com produtos personalizados.'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admpedido/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pedido = Pedido::find($id);

		if(Input::has('status'))
		{
			$pedido->pedido_status_id = Input::get('status');

			if(Input::has('produtos'))
			{
				$total = 0;

				foreach(Input::get('produtos') as $key => $produto)
				{
					$total += $produto['preco'] * $produto['quantidade'];

					DB::table('pedidos_produtos')->where('id', $key)->update(array('preco' => $produto['preco'], 'quantidade' => $produto['quantidade']));
				}

				$pedido->total = $total;
			}
			$pedido->save();

			$historico = new PedidoHistorico();

			$historico->pedido_id = $pedido->id;
			$historico->pedido_status_id = $pedido->pedido_status_id;
			$historico->observacao = (Input::has('observacao')) ? Input::get('observacao') : '';

			$historico->save();
		}


		return Redirect::to('admin/pedido')->with('success', array('Pedido alterado.'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admpedido/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Pedido::destroy($id);

		return Redirect::back()->with('success', array('pedido deletado'));
	}

}