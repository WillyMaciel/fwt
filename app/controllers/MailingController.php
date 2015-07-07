<?php

class MailingController extends \BaseController 
{
	/**
	 * Display a listing of destinos
	 *
	 * @return Response
	 */
	public function postIndex()
	{

		if(Input::has('email') && Input::get('email'))
		{
			$check = Mailing::where('email', '=', Input::get('email'))->first();

			if(!$check)
			{
				$mailing = new Mailing;
				$mailing->email = Input::get('email');
				$mailing->nome  = Input::get('nome');
				$mailing->phone = Input::get('phone');
				$mailing->save();
				return Redirect::back()->with('success', array('Você foi registrado no Mailing.'));
			}
			else
			{
				return Redirect::back()->with('danger', array('Você ja esta registrado no mailing.'));
			}

		}
		else
		{
			return Redirect::back()->with('danger', array('Seu email esta incorreto.'));
		}

	}

}
