<?php

class MundipaggController extends \BaseController
{

	public function postRetorno()
	{
		$input = Input::all();

		if($input)
		{
			$retorno = new Retorno;

			$retorno->serialize = serialize($input);
			$retorno->save();
		}
	}

}