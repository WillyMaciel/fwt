<?php

class PacoteController extends \BaseController {

	/**
	 * Display a listing of pacotes
	 *
	 * @return Response
	 */
	public function getIndex()
	{


		//$pacotes = new Pacote;

		if(Input::has('continente'))
		{
			$string = Input::get('continente');

			$string = urldecode($string);

			$pacotes = Pacote::whereHas('pais', function($q) use($string)
			{
				$q->whereHas('continente', function($q) use($string)
				{
					$q->where('name_pt', 'LIKE', "%$string%");
				});
			})->where('publicado', '=', 1);
		}
		else
		{
			$pacotes = Pacote::where('publicado', '=', 1);
		}
		// if(Input::has('tipo'))
		// {
		// 	$pacotes = $pacotes->Where('tipo', '=', Input::get('tipo'));
		// }

		if(!$pacotes)
		{
			return Redirect::back()->with('warning', array('Não foram encontrados resultados na busca.'));
		}

		$pacotes->with('pais.continente');

		$count =  $pacotes->count();

		$pacotes = $pacotes->paginate(5);

		$pacotes = $this->removeHtmlDescricao($pacotes);

		$continentes = Continente::all();

		foreach($continentes as $cont)
		{
			$json[] = $cont->name_pt;
		}

		$json = json_encode($json);

		//debug($pacotes->toArray());


		return View::make('pacote.index', compact('pacotes', 'count', 'json'));
	}

	public function getPaises()
	{

		if(Input::has('continente'))
		{
			$string = Input::get('continente');

			$string = urldecode($string);

			$continente = Continente::where('name_pt', 'LIKE', "%$string%")->first();

			if(!$continente)
			{
				return Redirect::back()->with('warning', array('Não foram encontrados resultados na busca.'));
			}

			$continentes = Continente::all();

			if($continente)
			{

				$paises = Pais::Has('pacotes')->with('continente')->where('continent_code', '=', $continente->code)->get();

			}
		}

		 $count =  $paises->count();


		foreach($continentes as $cont)
		{
			$json[] = $cont->name_pt;
		}

		$json = json_encode($json);


		return View::make('pacote.lista', compact('paises', 'count', 'continente', 'json'));
	}

	public function getContinentes()
	{

		$continentes = Continente::has('pacotes')->get();

		$count =  $continentes->count();


		foreach($continentes as $cont)
		{
			$json[] = $cont->name_pt;
		}

		$json = json_encode($json);


		return View::make('pacote.lista_continente', compact('continentes', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new pacote
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pacote.create');
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

		Pacote::create($data);

		return Redirect::route('pacote.index');
	}

	/**
	 * Display the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$pacote = Pacote::with('reviews.cliente', 'hoteis.imagens', 'apartamentos.imagens')->find($id);

		$this->addVisita($pacote);

		// $hoteis = Hotel::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		// $apartamentos = Apartamento::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		$hoteis = $pacote->hoteis;

		$apartamentos = $pacote->apartamentos;

		$passeios = Passeio::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		$snoturnos = ServicoNoturno::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		$similar = Pacote::similares();


		return View::make('pacote.show', compact('pacote', 'hoteis', 'apartamentos', 'passeios', 'snoturnos'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/pacotes/'));
	}

	/**
	 * Show the form for editing the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pacote = Pacote::find($id);

		return View::make('pacote.edit', compact('pacote'));
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

		$pacote->update($data);

		return Redirect::route('pacote.index');
	}

	/**
	 * Remove the specified pacote from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Pacote::destroy($id);

		return Redirect::route('pacote.index');
	}

}
