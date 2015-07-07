<?php

class ADMTransladoController extends \BaseController {

	/**
	 * Display a listing of translados
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Translado::with('pais'));
        $filter->add('nome_br','Nome - PT', 'text');
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
		$grid->add('
					<a class="" title="Visualizar" href="admin/translado/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/translado/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/translado/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/translado/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/translado/create',"Adicionar Novo", "TR");  //add button
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

		// $translado = Translado::find(1);
		// echo $translado->destino->{'nome_br'};
		// dd();

		return View::make('admin.translado.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new translado
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Translado);
	    $form->link("admin/translado/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
	    $form->select('destinos_id','Pertence ao Destino')
     		 ->options(Destino::lists("nome_br", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/translados/')->fit(900, 500)->preview(260,180);
		//$form->text('valor_diaria', 'Valor da diária', 'text');
		//$form->text('deposito', 'Valor do depósito de segurança', 'text');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    return $form->view('admin.translado.crud', compact('form'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		return View::make('admin.translado.create', compact('paises'));
	}

	/**
	 * Store a newly created translado in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Translado::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$translado = new Translado;

		$translado->nome_br = $data['nome_br'];
		$translado->nome_en = $data['nome_en'];
		$translado->descricao_br = $data['descricao_br'];
		$translado->descricao_en = $data['descricao_en'];
		$translado->pais_id = $data['pais_id'];
		$translado->valor   = $data['valor'];
		//$translado->estado = $data['estado'];
		$translado->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'translados');
			if($up_success)
			{
				$translado->imagem = $up_success['filename'];
			}
		}

		$translado->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'translados');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $translado->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/translado/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified translado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$translado = Translado::findOrFail($id);

		return View::make('translados.show', compact('translado'));
	}

	/**
	 * Show the form for editing the specified translado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$translado = Translado::find($id);
		$paises = Pais::lists("name", "id");

		return View::make('admin.translado.edit', compact('translado', 'paises'));
	}

	/**
	 * Update the specified translado in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$translado = Translado::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Translado::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$translado->nome_br = $data['nome_br'];
		$translado->nome_en = $data['nome_en'];
		$translado->descricao_br = $data['descricao_br'];
		$translado->descricao_en = $data['descricao_en'];
		$translado->pais_id = $data['pais_id'];
		$translado->valor   = $data['valor'];
		//$translado->estado = $data['estado'];
		$translado->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'translados');
			if($up_success)
			{
				$translado->imagem = $up_success['filename'];
			}
		}

		$translado->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'translados');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $translado->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/translado/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified translado from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$translado = Translado::find($id);

		$translado->imagens()->delete();

		$translado->delete();

		return Redirect::to('admin/translado/')->with('success', array('Registro deletado.'));
	}

}
