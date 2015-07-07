<?php

class ServicoNoturnoController extends \BaseController {

	/**
	 * Display a listing of servicosnoturnos
	 *
	 * @return Response
	 */
	public function getIndex()
	{


		$servicosnoturnos = ServicoNoturno::with('pais')->Where('publicado', '=', 1);

		if(Input::has('pais'))
		{
			$string = Input::get('pais');
			$pais = Pais::Where('name', 'LIKE', "%$string%")->first();

			$servicosnoturnos = $servicosnoturnos->Where('pais_id', '=', $pais->id);
		}
		if(Input::has('tipo'))
		{
			$servicosnoturnos = $servicosnoturnos->Where('tipo', '=', Input::get('tipo'));
		}


		$count =  $servicosnoturnos->count();

		$servicosnoturnos = $servicosnoturnos->paginate(5);

		$pais = Pais::all();

		foreach($pais as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);


		return View::make('serviconoturno.index', compact('servicosnoturnos', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new serviconoturno
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('serviconoturno.create');
	}

	/**
	 * Store a newly created serviconoturno in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ServicoNoturno::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		ServicoNoturno::create($data);

		return Redirect::route('serviconoturno.index');
	}

	/**
	 * Display the specified serviconoturno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$serviconoturno = ServicoNoturno::find($id);

		$this->addVisita($serviconoturno);

		$similar = ServicoNoturno::similares();

		return View::make('serviconoturno.show', compact('serviconoturno'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/servicosnoturnos/'));
	}

	/**
	 * Show the form for editing the specified serviconoturno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$serviconoturno = ServicoNoturno::find($id);

		return View::make('serviconoturno.edit', compact('serviconoturno'));
	}

	/**
	 * Update the specified serviconoturno in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$serviconoturno = ServicoNoturno::findOrFail($id);

		$validator = Validator::make($data = Input::all(), ServicoNoturno::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$serviconoturno->update($data);

		return Redirect::route('serviconoturno.index');
	}

	/**
	 * Remove the specified serviconoturno from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ServicoNoturno::destroy($id);

		return Redirect::route('serviconoturno.index');
	}

}
