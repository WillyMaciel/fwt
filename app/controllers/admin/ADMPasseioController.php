<?php

class ADMPasseioController extends \BaseController {

	/**
	 * Display a listing of passeios
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Passeio::with('pais'));
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
					<a class="" title="Visualizar" href="admin/passeio/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/passeio/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/passeio/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/passeio/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/passeio/create',"Adicionar Novo", "TR");  //add button
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

		// $passeio = Passeio::find(1);
		// echo $passeio->destino->{'nome_br'};
		// dd();

		return View::make('admin.passeio.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new passeio
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Passeio);
	    $form->link("admin/passeio/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
	    $form->select('destinos_id','Pertence ao Destino')
     		 ->options(Destino::lists("nome_br", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/passeios/')->fit(900, 500)->preview(260,180);
		//$form->text('valor_diaria', 'Valor da diária', 'text');
		//$form->text('deposito', 'Valor do depósito de segurança', 'text');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    return $form->view('admin.passeio.crud', compact('form'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		return View::make('admin.passeio.create', compact('paises'));
	}

	/**
	 * Store a newly created passeio in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Passeio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$passeio = new Passeio;

		$passeio->nome_br = $data['nome_br'];
		$passeio->nome_en = $data['nome_en'];
		$passeio->descricao_br = $data['descricao_br'];
		$passeio->descricao_en = $data['descricao_en'];
		$passeio->pais_id = $data['pais_id'];
		$passeio->cidade = $data['cidade'];
		$passeio->valor  = $data['valor'];
		$passeio->tipo	 = $data['tipo'];
		//$passeio->estado = $data['estado'];
		$passeio->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'passeios');
			if($up_success)
			{
				$passeio->imagem = $up_success['filename'];
			}
		}

		$passeio->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'passeios');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $passeio->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/passeio/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified passeio.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$passeio = Passeio::findOrFail($id);

		return View::make('passeios.show', compact('passeio'));
	}

	/**
	 * Show the form for editing the specified passeio.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$passeio = Passeio::find($id);
		$paises = Pais::lists("name", "id");

		return View::make('admin.passeio.edit', compact('passeio', 'paises'));
	}

	/**
	 * Update the specified passeio in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$passeio = Passeio::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Passeio::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$passeio->nome_br = $data['nome_br'];
		$passeio->nome_en = $data['nome_en'];
		$passeio->descricao_br = $data['descricao_br'];
		$passeio->descricao_en = $data['descricao_en'];
		$passeio->pais_id = $data['pais_id'];
		$passeio->valor  = $data['valor'];
		$passeio->tipo	 = $data['tipo'];
		//$passeio->estado = $data['estado'];
		$passeio->cidade = $data['cidade'];
		$passeio->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'passeios');
			if($up_success)
			{
				$passeio->imagem = $up_success['filename'];
			}
		}

		$passeio->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'passeios');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $passeio->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/passeio/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified passeio from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$passeio = Passeio::find($id);

		$passeio->imagens()->delete();

		$passeio->delete();

		return Redirect::to('admin/passeio/')->with('success', array('Registro deletado.'));
	}

}
