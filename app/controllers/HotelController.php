<?php

class HotelController extends \BaseController {

	/**
	 * Display a listing of hotels
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		if(Input::has('pais'))
		{
			$string = Input::get('pais');
			$pais 	= Pais::Where('name', 'LIKE', "%$string%")->first();

			if($pais)
			{
				$hoteis = Hotel::Where('pais_id', '=', $pais->id)->with('caracteristicas')->paginate(5);

				if(count($hoteis) > 0)
				{
					$hotels = $hoteis;

					$count =  $hoteis->count();
				}
			}
			else
			{
				$hotels = array();
				$count = 0;
			}
		}
		else
		{
			$hotels = Hotel::with('pais', 'caracteristicas')->Where('publicado', '=', 1)->paginate(5);

			$count  = Hotel::with('pais')->Where('publicado', '=', 1)->count();
		}

		$paises = Pais::has('hoteis')->get();

		foreach($paises as $pais)
		{
			$json[] = $pais->name;
		}

		$json = json_encode($json);

		return View::make('hotels.index', compact('hotels', 'count', 'json'));
	}

	/**
	 * Show the form for creating a new hotel
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('hotels.create');
	}

	/**
	 * Store a newly created hotel in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Hotel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Hotel::create($data);

		return Redirect::route('hotels.index');
	}

	/**
	 * Display the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$hotel = Hotel::with('imagens', 'caracteristicas')->find($id);

		$this->addVisita($hotel);

		$similar = Hotel::similares();

		return View::make('hotels.show', compact('hotel'))->nest('similar_listing', 'widgets.similar_listing', array('data' => $similar, 'caminho' => 'uploads/hoteis/'));
	}

	/**
	 * Show the form for editing the specified hotel.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$hotel = Hotel::find($id);

		return View::make('hotels.edit', compact('hotel'));
	}

	/**
	 * Update the specified hotel in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$hotel = Hotel::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Hotel::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$hotel->update($data);

		return Redirect::route('hotels.index');
	}

	/**
	 * Remove the specified hotel from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Hotel::destroy($id);

		return Redirect::route('hotels.index');
	}

}
