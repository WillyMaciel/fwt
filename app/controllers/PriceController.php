<?php

class PriceController extends \BaseController 
{

	private $rules;

	public function __construct()
	{
		$this->rules = array(
								'firstname'			=>	'required',
								'lastname'			=>	'required',
								'email'				=>	'email|required',
								'telefone'			=>	'required',
								'departure_city'	=>	'required',
								'departure_date'	=>	'required'
							);
	}

	/**
	 * Display a listing of destinos
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//$destinos = Destino::all();

		return View::make('price.index');
	}

	public function postIndex()
	{
		$validator = Validator::make(Input::all(), $this->rules);

		if($validator->fails())
		{
			return Redirect::back()->with('danger', $validator->messages()->toArray());
		}
		

		Mail::send('emails.price', Input::all(), function($message)
		{
			//$message->from('leads@funworldtours.com', 'Fun World Tours');



		    $message->to('leads@funworldtours.com', 'Willy Maciel')
		    		->cc(array('willy_maciel@live.com', 'escritoriododesign@gmail.com' ))
		    		->subject('Get Price Fun World Tours');
		});


		return Redirect::to('price')->with('success', array('Thank You! Your request was successfully sent! we will contact you as soon as possible.'));
	}

	/**
	 * Show the form for creating a new destino
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('destinos.create');
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
