<?php

class ClienteController extends \BaseController {

	public function MyAccount()
	{
		$hotels = Hotel::where('publicado', '=', 1)->count();

		$translados = Translado::where('publicado', '=', 1)->count();

		$especiais = EventoEspecial::where('publicado', '=', 1)->count();

		$passeios = Passeio::where('publicado', '=', 1)->count();

		$produtos = Produto::Where('publicado', '=', 1)->orderBy('created_at', 'DESC')->take(6)->get();

		return View::make('cliente.minhaconta', compact('hotels', 'translados', 'especiais', 'passeios', 'produtos'));
	}

	public function updatePassword()
	{
		$input = Input::all();

		//debug($input);

		if($input['password_old'] && $input['password_new'] && $input['password_confirm'])
		{
			if($input['password_new'] == $input['password_confirm'])
			{
				if(Hash::check($input['password_old'], Auth::user()->password))
				{
					$password = Hash::make($input['password_new']);

					// $cliente = User::find(Auth::user()->id);
					// $cliente->password = '$password';
					// $cliente->save();

					DB::table('clientes')
		            ->where('id', Auth::user()->id)
		            ->update(array('password' => $password));

					return Redirect::back()->with('success', array('Sua senha foi alterada!'));
				}
				else
				{
					return Redirect::back()->with('danger', array('sua senha atual esta errada'));
				}
			}
			else
			{
				return Redirect::back()->with('danger', array('as senhas não conferem'));
			}
		}

	}

}