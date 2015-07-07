<?php

class ADMConfiguracoesController extends \BaseController {

	public function getIndex()
	{
		$configuracao = Configuracao::where('param', 'cotacao_dolar')->first();
		return View::make('admin.configuracao.index', compact('configuracao'));
	}

	public function postIndex()
	{
		if(Input::has('cotacao_dolar'))
		{
			$configuracao = Configuracao::find(Input::get('id'));

			$configuracao->valor = Input::get('cotacao_dolar');
			$configuracao->save();

			return Redirect::back()->with('success', array('Valor atualizado.'));
		}
		else
		{
			return Redirect::back()->with('danger', array('Nenhum valor inserido no campo.'));
		}
	}

}