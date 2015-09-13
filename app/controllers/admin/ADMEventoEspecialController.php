<?php

class ADMEventoEspecialController extends \BaseController {

	/**
	 * Display a listing of eventosespeciais
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(EventoEspecial::with('pais'));
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
					<a class="" title="Visualizar" href="admin/eventoespecial/{{$id}}"><span class="glyphicon glyphicon-eye-open"> </span></a>
					<a class="" title="Modificar" href="admin/eventoespecial/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					<a class="text-danger" title="Deletar" href="admin/eventoespecial/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/eventoespecial/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/eventoespecial/create',"Adicionar Novo", "TR");  //add button
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

		// $evento = EventoEspecial::find(1);
		// echo $evento->destino->{'nome_br'};
		// dd();

		return View::make('admin.eventoespecial.index', compact('filter', 'grid'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		$hoteis = Hotel::with('pais')->get();

		$apartamentos = Apartamento::with('pais')->get();

		$passeios = Passeio::with('pais')->get();

		$servicosnoturnos = ServicoNoturno::with('pais')->get();

		return View::make('admin.eventoespecial.create', compact('paises', 'hoteis', 'apartamentos', 'passeios', 'servicosnoturnos'));
	}

	/**
	 * Store a newly created pacote in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), EventoEspecial::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$evento = new EventoEspecial;

		$evento->nome_br = $data['nome_br'];
		$evento->nome_en = $data['nome_en'];
		$evento->descricao_br = $data['descricao_br'];
		$evento->descricao_en = $data['descricao_en'];
		$evento->whytravel_br = $data['whytravel_br'];
		$evento->whytravel_en = $data['whytravel_en'];
		$evento->pais_id = $data['pais_id'];
		$evento->cidade = $data['cidade'];
		$evento->valor 	= $data['valor'];
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

		$hoteis = (Input::get('hoteis'))? Input::get('hoteis') : [];
		$evento->hoteis()->sync($hoteis);

		$apartamentos = (Input::get('apartamentos')) ? Input::get('apartamentos') : [];
		$evento->apartamentos()->sync($apartamentos);

		$passeios = (Input::get('passeios')) ? Input::get('passeios') : [];
		$evento->passeios()->sync($passeios);
		
		$servicosnoturnos = (Input::get('servicosnoturnos')) ? Input::get('servicosnoturnos') : [];
		$evento->servicosnoturnos()->sync($servicosnoturnos);

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

		return Redirect::to('admin/eventoespecial/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$evento = EventoEspecial::findOrFail($id);

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
		$evento = EventoEspecial::with('hoteis', 'apartamentos', 'passeios', 'servicosnoturnos')->find($id);
		$paises = Pais::lists("name", "id");

		$hoteis = Hotel::with('pais')->get();

		$apartamentos = Apartamento::with('pais')->get();

		$passeios = Passeio::with('pais')->get();

		$servicosnoturnos = ServicoNoturno::with('pais')->get();

		return View::make('admin.eventoespecial.edit', compact('evento', 'paises', 'hoteis', 'apartamentos', 'passeios', 'servicosnoturnos'));
	}

	/**
	 * Update the specified pacote in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$evento = EventoEspecial::findOrFail($id);

		$validator = Validator::make($data = Input::all(), EventoEspecial::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$evento->nome_br = $data['nome_br'];
		$evento->nome_en = $data['nome_en'];
		$evento->descricao_br = $data['descricao_br'];
		$evento->descricao_en = $data['descricao_en'];
		$evento->whytravel_br = $data['whytravel_br'];
		$evento->whytravel_en = $data['whytravel_en'];
		$evento->pais_id = $data['pais_id'];
		$evento->cidade = $data['cidade'];
		$evento->valor 	= $data['valor'];
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


		$hoteis = (Input::get('hoteis'))? Input::get('hoteis') : [];
		$evento->hoteis()->sync($hoteis);

		$apartamentos = (Input::get('apartamentos')) ? Input::get('apartamentos') : [];
		$evento->apartamentos()->sync($apartamentos);

		$passeios = (Input::get('passeios')) ? Input::get('passeios') : [];
		$evento->passeios()->sync($passeios);
		
		$servicosnoturnos = (Input::get('servicosnoturnos')) ? Input::get('servicosnoturnos') : [];
		$evento->servicosnoturnos()->sync($servicosnoturnos);
		

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

		return Redirect::to('admin/eventoespecial/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified pacote from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$evento = EventoEspecial::find($id);

		$evento->imagens()->delete();

		$evento->delete();

		return Redirect::to('admin/eventoespecial/')->with('success', array('Registro deletado.'));
	}

}
