<?php

class TransladoController extends \BaseController {

	/**
	 * Display a listing of translados
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		if(Input::has('pais'))
		{
			$string = Input::get('pais');
			$pais = Pais::Where('name', 'LIKE', "%$string%")->first();

			$translados = Translado::with('pais')
						   ->Where('pais_id', '=', $pais->id)
						   ->Where('publicado', '=', 1)
						   ->paginate(5);

			$count =  Translado::with('pais')
						   ->Where('pais_id', '=', $pais->id)
						   ->Where('publicado', '=', 1)
						   ->count();
		}
		else
		{
			$translados = Translado::with('pais')->Where('publicado', '=', 1)->paginate(5);

			$count  = Translado::with('pais')->Where('publicado', '=', 1)->count();
		}

		$paises = Pais::all();

		foreach($paises as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);


		return View::make('translado.index', compact('translados', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new translado
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('translados.create');
	}

	/**
	 * Store a newly created translado in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Translado::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Translado::create($data);

		return Redirect::route('translados.index');
	}

	/**
	 * Display the specified translado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$translado = Translado::find($id);

		$this->addVisita($translado);

		$similar = Translado::similares();

		return View::make('translado.show', compact('translado'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/translados/'));
	}

	/**
	 * Show the form for editing the specified translado.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$translado = Translado::find($id);

		return View::make('translados.edit', compact('translado'));
	}

	/**
	 * Update the specified translado in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$translado = Translado::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Translado::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$translado->update($data);

		return Redirect::route('translados.index');
	}

	/**
	 * Remove the specified translado from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Translado::destroy($id);

		return Redirect::route('translados.index');
	}

}
