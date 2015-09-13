<?php

class ADMConfiguracoesController extends \BaseController {

	public function getIndex()
	{
		$cotacao_dolar = Configuracao::where('param', 'cotacao_dolar')->first();
		$cotacao_euro = Configuracao::where('param', 'cotacao_euro')->first();
		$sobre = Configuracao::where('param', 'sobre')->first();
		$termos = Configuracao::where('param', 'termos')->first();
		return View::make('admin.configuracao.index', compact('cotacao_dolar', 'cotacao_euro', 'sobre', 'termos'));
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

			$sobre = Configuracao::where('param', 'sobre')->first();

			$sobre->text_br = Input::get('sobre_br');
			$sobre->text_en = Input::get('sobre_en');

			$sobre->save();

			$termos = Configuracao::where('param', 'termos')->first();

			$termos->text_br = Input::get('termos_br');
			$termos->text_en = Input::get('termos_en');

			$termos->save();

			return Redirect::back()->with('success', array('Valores atualizados.'));
		}
		else
		{
			return Redirect::back()->with('danger', array('Nenhum valor inserido no campo.'));
		}
	}

}