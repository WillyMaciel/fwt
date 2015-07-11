<?php

class EventoEspecialController extends \BaseController {

	/**
	 * Display a listing of eventos
	 *
	 * @return Response
	 */
	public function getIndex()
	{


		$eventos = EventoEspecial::with('pais')->Where('publicado', '=', 1);

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

		$eventos = $this->removeHtmlDescricao($eventos);

		$pais = Pais::all();

		foreach($pais as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);


		return View::make('eventoespecial.index', compact('eventos', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new eventoespecial
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('eventoespecial.create');
	}

	/**
	 * Store a newly created eventoespecial in storage.
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

		EventoEspecial::create($data);

		return Redirect::route('eventoespecial.index');
	}

	/**
	 * Display the specified eventoespecial.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$eventoespecial = EventoEspecial::find($id);

		$this->addVisita($eventoespecial);

		$similar = EventoEspecial::similares();

		return View::make('eventoespecial.show', compact('eventoespecial'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/eventosespeciais/'));
	}

	/**
	 * Show the form for editing the specified eventoespecial.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$eventoespecial = EventoEspecial::find($id);

		return View::make('eventoespecial.edit', compact('eventoespecial'));
	}

	/**
	 * Update the specified eventoespecial in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$eventoespecial = EventoEspecial::findOrFail($id);

		$validator = Validator::make($data = Input::all(), EventoEspecial::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$eventoespecial->update($data);

		return Redirect::route('eventoespecial.index');
	}

	/**
	 * Remove the specified eventoespecial from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		EventoEspecial::destroy($id);

		return Redirect::route('eventoespecial.index');
	}

}
