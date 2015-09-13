<?php

class ApartamentoController extends \BaseController {

	
	/**
	 * Display the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$apartamento = Apartamento::with('imagens', 'caracteristicas')->find($id);

		$this->addVisita($apartamento);

		$similar = Apartamento::similares();

		return View::make('apartamentos.show', compact('apartamento'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/apartamentos/'));
	}

}
