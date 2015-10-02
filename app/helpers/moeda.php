<?php
namespace App\Helpers;

class Moeda
{
	public $moeda;
	public $simbolo;

	public function __construct()
	{
		$lang = \Session::get('lang');

		// switch ($lang) 
		// {
		// 	case 'pt':
		// 		$this->moeda = 'BRL';
		// 		$this->simbolo = 'R$';
		// 		break;
		// 	case 'en':
		// 		$this->moeda = 'USD';
		// 		$this->simbolo = '$';
		// 		break;
		// }

		$this->moeda = 'BRL';
		$this->simbolo = 'R$';

	}
}