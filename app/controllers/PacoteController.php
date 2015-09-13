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

			$pais = (Input::has('pais')) ? Input::get('pais') : false;

			$pacotes = Pacote::whereHas('pais', function($q) use($string, $pais)
			{
				$q->whereHas('continente', function($q) use($string)
				{
					$q->where('name_pt', 'LIKE', "%$string%");
				})
				->where('pais_id', $pais);
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

		$continentes = Continente::has('pacotes');

		if(Input::has('continente'))
		{
			$continentes->where('name_en', 'LIKE', '%'.Input::get('continente').'%')->orWhere('name_pt', 'LIKE', '%'.Input::get('continente').'%')->has('pacotes');
		}

		$continentes = $continentes->get();

		$count =  $continentes->count();

		$json = [];
		foreach($continentes as $cont)
		{
			$json[] = $cont->name_pt;
		}

		$json = json_encode($json);


		return View::make('pacote.lista_continente', compact('continentes', 'count', 'json'));
	}


	/**
	 * Display the specified pacote.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$pacote = Pacote::with('reviews.cliente', 'hoteis.imagens', 'apartamentos.imagens', 'passeios.imagens', 'servicosnoturnos.imagens')->find($id);

		$this->addVisita($pacote);

		// $hoteis = Hotel::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		// $apartamentos = Apartamento::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		$hoteis = $this->removeHtmlDescricao($pacote->hoteis);

		$apartamentos = $this->removeHtmlDescricao($pacote->apartamentos);

		// $passeios = Passeio::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		// $snoturnos = ServicoNoturno::with('imagens')->where('pais_id', $pacote->pais_id)->where('cidade', 'LIKE', "%{$pacote->cidade}%")->where('publicado', 1)->get();

		$passeios = $this->removeHtmlDescricao($pacote->passeios);

		$snoturnos = $this->removeHtmlDescricao($pacote->servicosnoturnos);

		$similar = Pacote::similares();


		return View::make('pacote.show', compact('pacote', 'hoteis', 'apartamentos', 'passeios', 'snoturnos'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/pacotes/'));
	}

}
