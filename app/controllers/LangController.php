<?php

class LangController extends BaseController
{
	public function index()
	{	
		$lang = Input::has('lang');

		if($lang)
		{
			$lang = Input::get('lang');
			switch ($lang) 
			{
				case 'English':
					Session::put('lang', 'en');
					break;
				case 'Portuguese':
					Session::put('lang', 'pt');
					break;
				default:
					Session::put('lang', 'pt');
					break;
			}

	
			 return Redirect::back();
		}
	}
}