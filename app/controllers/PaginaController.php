<?php

class PaginaController extends \BaseController {

	
	/**
	 * Display the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getAboutUs()
	{
		$sobre = Configuracao::where('param', 'sobre')->first();

		if(Session::get('lang') == 'pt')
		{ 
			$sobre = $sobre->text_br;
		}
		else
		{
			$sobre = $sobre->text_en;
		}

		return View::make('paginas.sobre', compact('sobre'));
	}

	public function getTermsOfService()
	{
		$termos = Configuracao::where('param', 'termos')->first();

		if(Session::get('lang') == 'pt')
		{ 
			$termos = $termos->text_br;
		}
		else
		{
			$termos = $termos->text_en;
		}

		return View::make('paginas.termos', compact('termos'));
	}

}
