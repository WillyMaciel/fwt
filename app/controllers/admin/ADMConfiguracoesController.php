<?php

class ADMConfiguracoesController extends \BaseController {

	public function getIndex()
	{
		$cotacao_dolar = Configuracao::where('param', 'cotacao_dolar')->first();
		$cotacao_euro = Configuracao::where('param', 'cotacao_euro')->first();
		return View::make('admin.configuracao.index', compact('cotacao_dolar', 'cotacao_euro'));
	}

	public function postIndex()
	{
		if(Input::has('cotacao_dolar') && Input::has('cotacao_euro'))
		{
			$cotacao_dolar = Configuracao::where('param', 'cotacao_dolar')->first();

			$cotacao_dolar->valor = Input::get('cotacao_dolar');

			$cotacao_dolar->save();


			$cotacao_euro = Configuracao::where('param', 'cotacao_euro')->first();

			$cotacao_euro->valor = Input::get('cotacao_euro');

			$cotacao_euro->save();

			return Redirect::back()->with('success', array('Valores atualizados.'));
		}
		else
		{
			return Redirect::back()->with('danger', array('Nenhum valor inserido no campo.'));
		}
	}

}