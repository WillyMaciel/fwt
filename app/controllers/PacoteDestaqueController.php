<?php

class PacoteDestaqueController extends \BaseController {

	/**
	 * Display a listing of eventos
	 *
	 * @return Response
	 */
	public function getIndex()
	{


		$eventos = PacoteDestaque::with('pais')->Where('publicado', '=', 1);

		if(Input::has('pais'))
		{
			$string = Input::get('pais');
			$pais = Pais::Where('name', 'LIKE', "%$string%")->first();

			$eventos = $eventos->Where('pais_id', '=', $pais->id);
		}
		if(Input::has('tipo'))
		{
			$eventos = $eventos->Where('tipo', '=', Input::get('tipo'));
		}


		$count =  $eventos->count();

		$eventos = $eventos->paginate(5);

		$pais = Pais::all();

		foreach($pais as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);


		return View::make('pacotedestaque.index', compact('eventos', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new eventoespecial
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pacotedestaque.create');
	}

	/**
	 * Store a newly created eventoespecial in storage.
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

		PacoteDestaque::create($data);

		return Redirect::route('pacotedestaque.index');
	}

	/**
	 * Display the specified pacotedestaque.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$eventoespecial = PacoteDestaque::find($id);

		$this->addVisita($eventoespecial);

		$similar = PacoteDestaque::similares();

		return View::make('pacotedestaque.show', compact('eventoespecial'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/eventosespeciais/'));
	}

	/**
	 * Show the form for editing the specified pacotedestaque.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eventoespecial = PacoteDestaque::find($id);

		return View::make('pacotedestaque.edit', compact('eventoespecial'));
	}

	/**
	 * Update the specified eventoespecial in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$eventoespecial = PacoteDestaque::findOrFail($id);

		$validator = Validator::make($data = Input::all(), PacoteDestaque::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$eventoespecial->update($data);

		return Redirect::route('pacotedestaque.index');
	}

	/**
	 * Remove the specified eventoespecial from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		PacoteDestaque::destroy($id);

		return Redirect::route('pacotedestaque.index');
	}

}
