<?php

class ADMPedidoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admpedido
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Pedido::with('cliente', 'status'));
        $filter->add('nome','Nome do Cliente', 'text');
        $filter->add('email','Email do Cliente', 'text');
        $filter->add('status.nome','Status do pedido','select')->options(PedidoStatus::lists("nome_br", "id"));;
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('id','Id Pedido', true); //field name, label, sortable
		$grid->add('nome','Nome do Cliente', true); //field name, label, sortable
		$grid->add('email','Email do Cliente'); //relation.fieldname
		$grid->add('status.nome_br','Status do Pedido'); //relation.fieldname
		$grid->add('total', 'Valor do Pedido');
		$grid->add('created_at', 'Data do Pedido', true);
		$grid->add('
					<a class="" title="Visualizar" href="admin/pedido/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/pedido/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/pedido/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/serviconoturno/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/pedido/create',"Adicionar Novo", "TR");  //add button
		$grid->orderBy('id','desc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));


		return View::make('admin.pedido.index', compact('filter', 'grid'));
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
		$pedido = Pedido::with('cliente', 'status', 'produtos', 'historico')->find($id);

		$status = PedidoStatus::all();

		return View::make('admin.pedido.edit', compact('pedido', 'status'));
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