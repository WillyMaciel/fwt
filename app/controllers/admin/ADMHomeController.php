<?php

class ADMHomeController extends \BaseController {

	/**
	 * Display a listing of destinos
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return Redirect::to('admin/pacote');		
		//return View::make('admin.home.index');
	}

	/**
	 * Show the form for creating a new hotel
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Destino);
	    $form->link("admin/destino/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br','Nome PT', 'text')->rule('required');
	    $form->text('nome_en','Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT')->rule('required');
	    $form->textarea('descricao_en','Descricao EN')->rule('required');
	    $form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    return $form->view('admin.destino.crud', compact('form'));
	}

	/**
	 * Store a newly created destino in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Destino::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Destino::create($data);

		return Redirect::route('destinos.index');
	}

	/**
	 * Display the specified destino.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$destino = Destino::findOrFail($id);

		return View::make('destinos.show', compact('destino'));
	}

	/**
	 * Show the form for editing the specified destino.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$destino = Destino::find($id);

		return View::make('destinos.edit', compact('destino'));
	}

	/**
	 * Update the specified destino in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$destino = Destino::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Destino::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$destino->update($data);

		return Redirect::route('destinos.index');
	}

	/**
	 * Remove the specified destino from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Destino::destroy($id);

		return Redirect::route('destinos.index');
	}

}
