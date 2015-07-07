<?php

class ADMHotelController extends \BaseController {

	/**
	 * Display a listing of hotels
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Hotel::with('pais'));
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
					<a class="" title="Visualizar" href="admin/hotel/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/hotel/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/hotel/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');

		//$grid->edit('admin/hotel/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/hotel/create',"Adicionar Novo", "TR");  //add button
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

		// $hotel = Hotel::find(1);
		// echo $hotel->destino->{'nome_br'};
		// dd();

		return View::make('admin.hotel.index', compact('filter', 'grid'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		$caracteristicas = Caracteristica::where('publicado', '=', 1)->get();

		return View::make('admin.hotel.create', compact('paises', 'caracteristicas'));
	}

	/**
	 * Show the form for creating a new hotel
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Hotel);
	    $form->link("admin/hotel/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->select('estrelas','Tipo de Hotel (Estrelas)')
     		 ->options(array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5));
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
     	$form->select('pais_id','Pais')
     		 ->options(Pais::lists("name", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/hoteis/')->fit(900, 500)->preview(260,180);
		//$form->image('imagens','Outra Imagem')->move('uploads/hoteis/')->fit(900, 500)->preview(260,180);
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

	    return $form->view('admin.hotel.crud', compact('form'));
	}

	/**
	 * Store a newly created hotel in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Hotel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$hotel = new Hotel;

		$hotel->nome_br = $data['nome_br'];
		$hotel->nome_en = $data['nome_en'];
		$hotel->descricao_br = $data['descricao_br'];
		$hotel->descricao_en = $data['descricao_en'];
		$hotel->estrelas = $data['estrelas'];
		$hotel->pais_id = $data['pais_id'];
		$hotel->valor   = $data['valor'];
		$hotel->cidade  = $data['cidade'];
		//$hotel->estado = $data['estado'];
		$hotel->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'hoteis');
			if($up_success)
			{
				$hotel->imagem = $up_success['filename'];
			}
		}

		$hotel->save();

		if(Input::has('caracteristicas'))
		{
			$hotel->caracteristicas()->sync(Input::get('caracteristicas'));
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'hoteis');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $hotel->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/hotel/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$hotel = Hotel::findOrFail($id);

		return View::make('hotels.show', compact('hotel'));
	}

	/**
	 * Show the form for editing the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$hotel = Hotel::with('caracteristicas')->find($id);
		$paises = Pais::lists("name", "id");
		$caracteristicas = Caracteristica::where('publicado', '=', 1)->get();

		return View::make('admin.hotel.edit', compact('hotel', 'paises', 'caracteristicas'));
	}

	/**
	 * Update the specified hotel in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$hotel = Hotel::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Hotel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$hotel->nome_br = $data['nome_br'];
		$hotel->nome_en = $data['nome_en'];
		$hotel->descricao_br = $data['descricao_br'];
		$hotel->descricao_en = $data['descricao_en'];
		$hotel->estrelas = $data['estrelas'];
		$hotel->pais_id = $data['pais_id'];
		$hotel->valor   = $data['valor'];
		$hotel->cidade  = $data['cidade'];
		//$hotel->estado = $data['estado'];
		$hotel->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'hoteis');
			if($up_success)
			{
				$hotel->imagem = $up_success['filename'];
			}
		}

		$hotel->save();

		if(Input::has('caracteristicas'))
		{
			$hotel->caracteristicas()->sync(Input::get('caracteristicas'));
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'hoteis');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $hotel->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/hotel/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified hotel from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$hotel = Hotel::find($id);

		$hotel->imagens()->delete();

		$hotel->delete();

		return Redirect::back()->with('success', array('Registro deletado.'));
	}

}
