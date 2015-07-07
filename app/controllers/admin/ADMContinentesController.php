<?php

class ADMContinentesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admcontinentes
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = DataFilter::source(new Continente);
        $filter->add('name_pt','Nome - PT', 'text');
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('name_pt','Nome PT', true); //field name, label, sortable

		$grid->add('
					<a class="" title="Modificar" href="admin/continente/{{$code}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					', 'Ações');

		//$grid->edit('admin/hotel/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->orderBy('name_pt','desc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));

		// $hotel = Hotel::find(1);
		// echo $hotel->destino->{'nome_br'};
		// dd();

		return View::make('admin.continente.index', compact('filter', 'grid'));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admcontinentes/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admcontinentes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admcontinentes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admcontinentes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$continente = Continente::find($id);

		return View::make('admin.continente.edit', compact('continente'));
	}

	/**
	 * Update the specified continente in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$continente = Continente::findOrFail($id);

		$validator = Validator::make($data = Input::all(), continente::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'continentes');
			if($up_success)
			{
				$continente->imagem = 'uploads/continentes/' . utf8_encode($up_success['filename']);
			}
		}

		$continente->save();

		return Redirect::to('admin/continente/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admcontinentes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}