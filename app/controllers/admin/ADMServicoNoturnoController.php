<?php

class ADMServicoNoturnoController extends \BaseController {

	/**
	 * Display a listing of serviconoturno
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(ServicoNoturno::with('pais'));
        $filter->add('nome_br','Nome - PT', 'text');
        $filter->add('tipo','Tipo','select')->options(array('' => 'Tipo', 'Restaurante' => 'Restaurante', 'Evento' => 'Evento', 'Boate' => 'Boate'));;
        $filter->add('pais.name','Paises','text');
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('nome_br','Nome PT', true); //field name, label, sortable
		$grid->add('nome_en','Nome EN'); //relation.fieldname
		$grid->add('publicado', 'Publicado', true);
		$grid->add('pais.name', 'Pais');
		$grid->add('tipo', 'Tipo');
		$grid->add('
					<a class="" title="Visualizar" href="admin/serviconoturno/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/serviconoturno/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/serviconoturno/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/serviconoturno/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/serviconoturno/create',"Adicionar Novo", "TR");  //add button
		$grid->orderBy('id','desc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));

		//Transforma TinyInteger de Publicado em Sim ou Não ao invez de 1 ou 0
		$grid->row(function($row)
		{
			if($row->cell('publicado')->value == 1)
			{
				$row->cell('publicado')->value = '<span class="label label-success"> Sim </span>';
			}
			else
			{
				$row->cell('publicado')->value = '<span class="label label-danger"> Não </span>';
			}
		});

		// $serviconoturno = ServicoNoturno::find(1);
		// echo $serviconoturno->destino->{'nome_br'};
		// dd();

		return View::make('admin.serviconoturno.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new serviconoturno
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new ServicoNoturno);
	    $form->link("admin/serviconoturno/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
	    $form->select('destinos_id','Pertence ao Destino')
     		 ->options(Destino::lists("nome_br", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/serviconoturno/')->fit(900, 500)->preview(260,180);
		//$form->text('valor_diaria', 'Valor da diária', 'text');
		//$form->text('deposito', 'Valor do depósito de segurança', 'text');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    return $form->view('admin.serviconoturno.crud', compact('form'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		return View::make('admin.serviconoturno.create', compact('paises'));
	}

	/**
	 * Store a newly created serviconoturno in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ServicoNoturno::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$serviconoturno = new ServicoNoturno;

		$serviconoturno->nome_br = $data['nome_br'];
		$serviconoturno->nome_en = $data['nome_en'];
		$serviconoturno->descricao_br = $data['descricao_br'];
		$serviconoturno->descricao_en = $data['descricao_en'];
		$serviconoturno->pais_id = $data['pais_id'];
		$serviconoturno->tipo	= $data['tipo'];
		$serviconoturno->valor = $data['valor'];
		$serviconoturno->valor_masculino = $data['valor_masculino'];
		$serviconoturno->valor_feminino = $data['valor_feminino'];
		//$serviconoturno->estado = $data['estado'];
		$serviconoturno->cidade = $data['cidade'];
		$serviconoturno->publicado = $data['publicado'];
		$serviconoturno->valor_masculino_meia = $data['valor_masculino_meia'];
		$serviconoturno->valor_feminino_meia = $data['valor_feminino_meia'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'servicosnoturnos');
			if($up_success)
			{
				$serviconoturno->imagem = $up_success['filename'];
			}
		}

		$serviconoturno->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'servicosnoturnos');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $serviconoturno->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/serviconoturno/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified serviconoturno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$serviconoturno = ServicoNoturno::findOrFail($id);

		return View::make('serviconoturno.show', compact('serviconoturno'));
	}

	/**
	 * Show the form for editing the specified serviconoturno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$serviconoturno = ServicoNoturno::find($id);
		$paises = Pais::lists("name", "id");

		return View::make('admin.serviconoturno.edit', compact('serviconoturno', 'paises'));
	}

	/**
	 * Update the specified serviconoturno in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$serviconoturno = ServicoNoturno::findOrFail($id);

		$validator = Validator::make($data = Input::all(), ServicoNoturno::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$serviconoturno->nome_br = $data['nome_br'];
		$serviconoturno->nome_en = $data['nome_en'];
		$serviconoturno->descricao_br = $data['descricao_br'];
		$serviconoturno->descricao_en = $data['descricao_en'];
		$serviconoturno->pais_id = $data['pais_id'];
		//$serviconoturno->estado = $data['estado'];
		$serviconoturno->cidade = $data['cidade'];
		$serviconoturno->publicado = $data['publicado'];
		$serviconoturno->tipo	= $data['tipo'];
		$serviconoturno->valor_masculino = $data['valor_masculino'];
		$serviconoturno->valor_feminino = $data['valor_feminino'];
		$serviconoturno->valor_masculino_meia = $data['valor_masculino_meia'];
		$serviconoturno->valor_feminino_meia = $data['valor_feminino_meia'];
		$serviconoturno->valor = $data['valor'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'servicosnoturnos');
			if($up_success)
			{
				$serviconoturno->imagem = $up_success['filename'];
			}
		}

		$serviconoturno->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'servicosnoturnos');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $serviconoturno->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/serviconoturno/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified serviconoturno from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$serviconoturno = ServicoNoturno::find($id);

		$serviconoturno->imagens()->delete();

		$serviconoturno->delete();

		return Redirect::to('admin/serviconoturno/')->with('success', array('Registro deletado.'));
	}

}
