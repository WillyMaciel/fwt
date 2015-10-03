<?php

class ViagemController extends BaseController {

	public function getComprar()
	{
		if(Input::has('param'))
		{
			if(Input::get('param') == 'nadim')
			{
				$this->comprar();
			}
		}
	}
	
}
