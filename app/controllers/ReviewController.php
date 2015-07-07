<?php

class ReviewController extends \BaseController 
{
	/**
	 * Display a listing of destinos
	 *
	 * @return Response
	 */
	public function postIndex()
	{

		$input = Input::all();
		if(!empty($input))
		{

			$review = new Review;
			$review->cliente_id = Auth::user()->id;
			$review->produto_id  = $input['produto_id'];
			$review->titulo = $input['review-titulo'];
			$review->texto = $input['review-texto'];
			$review->nota = $input['review-nota'];			
			$review->save();
			return Redirect::back()->with('success', array('Sua avaliação foi enviada e em breve sera analisada.'));
			

		}
		else
		{
			return Redirect::back()->with('danger', array('preencha todos os campos da avaliação.'));
		}

	}

}
