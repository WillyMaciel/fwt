<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		// if(Auth::check())
		// {
		// 	debug(Auth::user()->toArray());
		// }

		$destinos = Destino::all();

		$populares = Pacote::where('publicado', 1)->orderBy('visitas', 'DESC')->take(10)->get();

		$eventos = EventoEspecial::Where('destaque', 1)->take(3)->get();

		if($eventos->isEmpty())
		{
			$eventos = EventoEspecial::take(3)->get();
		}

		//$cotacao_dolar = Configuracao::where('param', 'cotacao_dolar')->first()->valor;

		//debug($populares);

		foreach($destinos as $destino)
		{
			$json[] = $destino->nome_br;
		}

		$json = json_encode($json);

		//debug(Session::get('carrinho'));


		return View::make('common.home2', compact('filter_hotel', 'json', 'populares', 'cotacao_dolar', 'eventos'));
	}

}
