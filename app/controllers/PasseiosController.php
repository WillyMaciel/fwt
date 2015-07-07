<?php

class PasseioController extends \BaseController {

	/**
	 * Display a listing of passeios
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		if(Input::has('pais'))
		{
			$string = Input::get('pais');
			$pais = Pais::Where('name', 'LIKE', "%$string%")->first();

			$passeios = Passeio::with('pais')
						   ->Where('pais_id', '=', $pais->id)
						   ->Where('publicado', '=', 1);					

			$count =  Passeio::with('pais')
						   ->Where('pais_id', '=', $pais->id)
						   ->Where('publicado', '=', 1)
						   ->count();
		}
		else
		{
			$passeios = Passeio::with('pais')->Where('publicado', '=', 1);

			$count  = Passeio::with('pais')->Where('publicado', '=', 1)->count();
		}

		if(Input::has('tipo'))
		{
			$passeios = $passeios->Where('tipo', '=', Input::get('tipo'));
		}

		$passeios = $passeios->paginate(5);

		$pais = Pais::all();

		foreach($pais as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);


		return View::make('passeios.index', compact('passeios', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new passeio
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('passeios.create');
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

		Passeio::create($data);

		return Redirect::route('passeios.index');
	}

	/**
	 * Display the specified passeio.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$passeio = Passeio::find($id);

		$this->addVisita($passeio);

		$similar = Passeio::similares();

		return View::make('passeios.show', compact('passeio'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/passeios/'));
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

		return View::make('passeios.edit', compact('passeio'));
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

		$passeio->update($data);

		return Redirect::route('passeios.index');
	}

	/**
	 * Remove the specified passeio from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Passeio::destroy($id);

		return Redirect::route('passeios.index');
	}

}
