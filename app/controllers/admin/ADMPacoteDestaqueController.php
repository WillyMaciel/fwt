<?php

class ADMPacoteDestaqueController extends \BaseController {

	/**
	 * Display a listing of evento
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(PacoteDestaque::with('pais'));
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
					<a class="" title="Visualizar" href="admin/pacote-destaque/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/pacote-destaque/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/pacote-destaque/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/pacote-destaque/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/pacote-destaque/create',"Adicionar Novo", "TR");  //add button
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

		// $evento = PacoteDestaque::find(1);
		// echo $evento->destino->{'nome_br'};
		// dd();

		return View::make('admin.pacotedestaque.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new evento
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new PacoteDestaque);
	    $form->link("admin/pacote-destaque/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
	    $form->select('destinos_id','Pertence ao Destino')
     		 ->options(Destino::lists("nome_br", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/pacote-destaque/')->fit(900, 500)->preview(260,180);
		//$form->text('valor_diaria', 'Valor da diária', 'text');
		//$form->text('deposito', 'Valor do depósito de segurança', 'text');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    return $form->view('admin.pacotedestaque.crud', compact('form'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		return View::make('admin.pacotedestaque.create', compact('paises'));
	}

	/**
	 * Store a newly created evento in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), PacoteDestaque::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$evento = new PacoteDestaque;

		$evento->nome_br = $data['nome_br'];
		$evento->nome_en = $data['nome_en'];
		$evento->descricao_br = $data['descricao_br'];
		$evento->descricao_en = $data['descricao_en'];
		$evento->pais_id = $data['pais_id'];
		$evento->tipo	= $data['tipo'];
		$evento->valor = $data['valor'];
		//$evento->estado = $data['estado'];
		$evento->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'eventosespeciais');
			if($up_success)
			{
				$evento->imagem = $up_success['filename'];
			}
		}

		$evento->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'eventosespeciais');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $evento->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/pacote-destaque/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified evento.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$evento = PacoteDestaque::findOrFail($id);

		return View::make('evento.show', compact('evento'));
	}

	/**
	 * Show the form for editing the specified evento.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$evento = PacoteDestaque::find($id);
		$paises = Pais::lists("name", "id");

		return View::make('admin.pacotedestaque.edit', compact('evento', 'paises'));
	}

	/**
	 * Update the specified evento in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$evento = PacoteDestaque::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PacoteDestaque::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$evento->nome_br = $data['nome_br'];
		$evento->nome_en = $data['nome_en'];
		$evento->descricao_br = $data['descricao_br'];
		$evento->descricao_en = $data['descricao_en'];
		$evento->pais_id = $data['pais_id'];
		//$evento->estado = $data['estado'];
		$evento->publicado = $data['publicado'];
		$evento->tipo	= $data['tipo'];
		$evento->valor = $data['valor'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'eventosespeciais');
			if($up_success)
			{
				$evento->imagem = $up_success['filename'];
			}
		}

		$evento->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'eventosespeciais');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $evento->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/pacote-destaque/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified evento from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$evento = PacoteDestaque::find($id);

		$evento->imagens()->delete();

		$evento->delete();

		return Redirect::to('admin/pacote-destaque/')->with('success', array('Registro deletado.'));
	}

}
