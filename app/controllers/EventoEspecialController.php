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
	 * Display the specified eventoespecial.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$eventoespecial = EventoEspecial::findOrFail($id);

		$hoteis = $this->removeHtmlDescricao($eventoespecial->hoteis);

		$apartamentos = $this->removeHtmlDescricao($eventoespecial->apartamentos);

		$passeios = $this->removeHtmlDescricao($eventoespecial->passeios);

		$snoturnos = $this->removeHtmlDescricao($eventoespecial->servicosnoturnos);

		$this->addVisita($eventoespecial);

		$similar = EventoEspecial::similares();

		return View::make('eventoespecial.show', compact('eventoespecial', 'hoteis', 'apartamentos', 'passeios', 'snoturnos'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/eventosespeciais/'));
	}

}
