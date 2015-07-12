<?php

class ADMPacoteController extends \BaseController {

	/**
	 * Display a listing of pacotes
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(Pacote::with('pais'));
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
					<a class="" title="Visualizar" href="admin/pacote/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/pacote/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/pacote/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/pacote/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/pacote/create',"Adicionar Novo", "TR");  //add button
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

		// $pacote = Pacote::find(1);
		// echo $pacote->destino->{'nome_br'};
		// dd();

		return View::make('admin.pacote.index', compact('filter', 'grid'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		$hoteis = Hotel::with('pais')->get();

		$apartamentos = Apartamento::with('pais')->get();

		$passeios = Passeio::with('pais')->get();

		$servicosnoturnos = ServicoNoturno::with('pais')->get();

		return View::make('admin.pacote.create', compact('paises', 'hoteis', 'apartamentos', 'passeios', 'servicosnoturnos'));
	}

	/**
	 * Store a newly created pacote in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Pacote::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$pacote = new Pacote;

		$pacote->nome_br = $data['nome_br'];
		$pacote->nome_en = $data['nome_en'];
		$pacote->descricao_br = $data['descricao_br'];
		$pacote->descricao_en = $data['descricao_en'];
		$pacote->pais_id = $data['pais_id'];
		$pacote->cidade = $data['cidade'];
		$pacote->valor 	= $data['valor'];
		//$pacote->estado = $data['estado'];
		$pacote->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'pacotes');
			if($up_success)
			{
				$pacote->imagem = $up_success['filename'];
			}
		}

		$pacote->save();

		if(Input::has('hoteis'))
		{
			$hoteis = Input::get('hoteis');
			$pacote->hoteis()->sync($hoteis);

		}

		if(Input::has('apartamentos'))
		{
			$apartamentos = Input::get('apartamentos');
			$pacote->apartamentos()->sync($apartamentos);
		}

		if(Input::has('passeios'))
		{
			$passeios = Input::get('passeios');
			$pacote->passeios()->sync($passeios);
		}

		if(Input::has('servicosnoturnos'))
		{
			$servicosnoturnos = Input::get('servicosnoturnos');
			$pacote->servicosnoturnos()->sync($servicosnoturnos);
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'pacotes');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $pacote->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/pacote/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pacote = Pacote::findOrFail($id);

		return View::make('pacote.show', compact('pacote'));
	}

	/**
	 * Show the form for editing the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pacote = Pacote::with('hoteis', 'apartamentos', 'passeios', 'servicosnoturnos')->find($id);
		$paises = Pais::lists("name", "id");

		$hoteis = Hotel::with('pais')->get();

		$apartamentos = Apartamento::with('pais')->get();

		$passeios = Passeio::with('pais')->get();

		$servicosnoturnos = ServicoNoturno::with('pais')->get();

		return View::make('admin.pacote.edit', compact('pacote', 'paises', 'hoteis', 'apartamentos', 'passeios', 'servicosnoturnos'));
	}

	/**
	 * Update the specified pacote in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pacote = Pacote::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Pacote::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$pacote->nome_br = $data['nome_br'];
		$pacote->nome_en = $data['nome_en'];
		$pacote->descricao_br = $data['descricao_br'];
		$pacote->descricao_en = $data['descricao_en'];
		$pacote->pais_id = $data['pais_id'];
		$pacote->cidade = $data['cidade'];
		$pacote->valor 	= $data['valor'];
		//$pacote->estado = $data['estado'];
		$pacote->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'pacotes');
			if($up_success)
			{
				$pacote->imagem = $up_success['filename'];
			}
		}

		$pacote->save();

		if(Input::has('hoteis'))
		{
			$hoteis = Input::get('hoteis');
			$pacote->hoteis()->sync($hoteis);

		}

		if(Input::has('apartamentos'))
		{
			$apartamentos = Input::get('apartamentos');
			$pacote->apartamentos()->sync($apartamentos);
		}

		if(Input::has('passeios'))
		{
			$passeios = Input::get('passeios');
			$pacote->passeios()->sync($passeios);
		}

		if(Input::has('servicosnoturnos'))
		{
			$servicosnoturnos = Input::get('servicosnoturnos');
			$pacote->servicosnoturnos()->sync($servicosnoturnos);
		}

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'pacotes');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $pacote->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/pacote/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified pacote from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$pacote = Pacote::find($id);

		$pacote->imagens()->delete();

		$pacote->delete();

		return Redirect::to('admin/pacote/')->with('success', array('Registro deletado.'));
	}

}
