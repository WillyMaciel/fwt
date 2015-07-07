<?php

class ADMPaisesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admpais
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = DataFilter::source(new Pais);
        $filter->add('name','Nome', 'text');
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('name','Nome', true); //field name, label, sortable
		$grid->add('full_name','Nome Completo', true); //field name, label, sortable

		$grid->add('
					<a class="" title="Modificar" href="admin/pais/{{$id}}/edit"><span class="glyphicon glyphicon-edit"> </span></a>
					', 'Ações');

		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));


		return View::make('admin.pais.index', compact('filter', 'grid'));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admpais/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admpais
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admpais/{id}
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
	 * GET /admpais/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pais = Pais::find($id);

		return View::make('admin.pais.edit', compact('pais'));
	}

	/**
	 * Update the specified pais in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pais = Pais::findOrFail($id);

		$validator = Validator::make($data = Input::all(), pais::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'paises');
			if($up_success)
			{
				$pais->imagem = 'uploads/paises/' . utf8_encode($up_success['filename']);
			}
		}

		$pais->save();

		return Redirect::to('admin/pais/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admpais/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}