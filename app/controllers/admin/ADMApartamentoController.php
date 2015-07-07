<?php

class ADMApartamentoController extends \BaseController {

	/**
	 * Display a listing of apts
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Apartamento::with('pais'));
        $filter->add('nome_br','Nome - PT', 'text');
        $filter->add('pais.name','Paises','text');
        $filter->add('estrelas', 'Tipo (Estrelas)', 'select')->options(array('' => 'Tipo (Estrelas)', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5));
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('nome_br','Nome PT', true); //field name, label, sortable
		$grid->add('nome_en','Nome EN'); //relation.fieldname 
		$grid->add('publicado', 'Publicado', true);
		$grid->add('pais.name', 'Pais');

		$grid->add('<div title="" class="five-stars-container" data-toggle="tooltip" data-placement="bottom" data-original-title="{{$estrelas or 0}} Estrelas">
					   		<span class="five-stars" style="width: {{$estrelas * 20}}%;"></span>
					</div>', 
					'Estrelas');

		$grid->add('
					<a class="" title="Visualizar" href="admin/apartamento/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/apartamento/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/apartamento/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');

		//$grid->edit('admin/apartamento/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/apartamento/create',"Adicionar Novo", "TR");  //add button
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

		// $apt = Apartamento::find(1);
		// echo $apt->destino->{'nome_br'};
		// dd();

		return View::make('admin.apartamento.index', compact('filter', 'grid'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		$caracteristicas = Caracteristica::where('publicado', '=', 1)->get();

		return View::make('admin.apartamento.create', compact('paises', 'caracteristicas'));
	}

	/**
	 * Show the form for creating a new apt
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Apartamento);
	    $form->link("admin/apartamento/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    // $form->select('estrelas','Tipo de Apartamento (Estrelas)')
     // 		 ->options(array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5));
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
     	$form->select('pais_id','Pais')
     		 ->options(Pais::lists("name", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/apartamentos/')->fit(900, 500)->preview(260,180);
		//$form->image('imagens','Outra Imagem')->move('uploads/apartamentos/')->fit(900, 500)->preview(260,180);
		$form->text('valor_diaria', 'Valor da diária', 'text');
		$form->text('deposito', 'Valor do depósito de segurança', 'text');

		$form->submit('Salvar');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    $form->passed(function()
		{
		    dd(Input::all());
		});

	    return $form->view('admin.apartamento.crud', compact('form'));
	}

	/**
	 * Store a newly created apt in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Apartamento::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$apt = new Apartamento;

		$apt->nome_br = $data['nome_br'];
		$apt->nome_en = $data['nome_en'];
		$apt->descricao_br = $data['descricao_br'];
		$apt->descricao_en = $data['descricao_en'];
		$apt->estrelas = $data['estrelas'];
		$apt->pais_id = $data['pais_id'];
		$apt->valor   = $data['valor'];
		$apt->cidade  = $data['cidade'];
		//$apt->estado = $data['estado'];
		$apt->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'apartamentos');
			if($up_success)
			{
				$apt->imagem = $up_success['filename'];
			}
		}

		$apt->save();

		if(Input::has('caracteristicas'))
		{
			$apt->caracteristicas()->sync(Input::get('caracteristicas'));
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'apartamentos');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $apt->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/apartamento/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified apt.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$apt = Apartamento::findOrFail($id);

		return View::make('apts.show', compact('apt'));
	}

	/**
	 * Show the form for editing the specified apt.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$apartamento = Apartamento::with('caracteristicas')->find($id);
		$paises = Pais::lists("name", "id");
		$caracteristicas = Caracteristica::where('publicado', '=', 1)->get();

		return View::make('admin.apartamento.edit', compact('apartamento', 'paises', 'caracteristicas'));
	}

	/**
	 * Update the specified apt in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$apt = Apartamento::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Apartamento::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$apt->nome_br = $data['nome_br'];
		$apt->nome_en = $data['nome_en'];
		$apt->descricao_br = $data['descricao_br'];
		$apt->descricao_en = $data['descricao_en'];
		$apt->estrelas = $data['estrelas'];
		$apt->pais_id = $data['pais_id'];
		$apt->valor   = $data['valor'];
		$apt->cidade  = $data['cidade'];
		//$apt->estado = $data['estado'];
		$apt->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'apartamentos');
			if($up_success)
			{
				$apt->imagem = $up_success['filename'];
			}
		}

		$apt->save();

		if(Input::has('caracteristicas'))
		{
			$apt->caracteristicas()->sync(Input::get('caracteristicas'));
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'apartamentos');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $apt->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/apartamento/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified apt from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$apt = Apartamento::find($id);

		$apt->imagens()->delete();

		$apt->delete();

		return Redirect::back()->with('success', array('Registro deletado.'));
	}

}
