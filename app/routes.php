<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Requer Login
Route::group(array('before' => 'auth'), function()
{

	Route::controller('checkout', 'CheckoutController');

	//Pedidos
	//Route::controller('cliente/pedido', 'PedidoController');
	Route::resource('cliente/pedido', 'PedidoController');

	//Review
	Route::controller('review', 'ReviewController');

	Route::get('cliente/minhaconta', 'ClienteController@MyAccount');
	Route::post('cliente/password', 'ClienteController@updatePassword');
	Route::get('users/logout', 'UsersController@logout');

	//Requer Admin
	Route::group(array('before' => 'admin'), function()
	{

		//API DO ADMIN PARA ANGULAR
		Route::get('admin/api/hotel', function()
		{
			return Hotel::select('id', 'pais_id', 'nome_br', 'class_name')->with('pais')->get();
		});
		Route::get('admin/api/hotel/{id}', function($id)
		{
			return Pacote::with('hoteis')->find($id)->hoteis;
		});
		Route::get('admin/api/apartamento', function()
		{
			return Apartamento::select('id', 'pais_id', 'nome_br', 'class_name')->with('pais')->get();
		});

		//API DO ADMIN PARA ANGULAR END

		//Hoteis
		//Route::any('admin/hotel/crud', 'ADMHotelController@Crud');
		Route::get('admin/hotel/delete/{id}', 'ADMHotelController@destroy');
		Route::resource('admin/hotel', 'ADMHotelController');

		//Hoteis
		Route::get('admin/apartamento/delete/{id}', 'ADMApartamentoController@destroy');
		Route::resource('admin/apartamento', 'ADMApartamentoController');

		//Destinos
		Route::any('admin/destino/crud', 'ADMDestinoController@Crud');
		Route::controller('admin/destino', 'ADMDestinoController');

		//Passeios
		//Route::any('admin/passeio/crud', 'ADMPasseioController@Crud');
		Route::get('admin/passeio/delete/{id}', 'ADMPasseioController@destroy');
		Route::resource('admin/passeio', 'ADMPasseioController');

		//Serviços Noturnos
		//Route::any('admin/serviconoturno/crud', 'ADMServicoNoturnoController@Crud');
		Route::get('admin/serviconoturno/delete/{id}', 'ADMServicoNoturnoController@destroy');
		Route::resource('admin/serviconoturno', 'ADMServicoNoturnoController');

		//Continente
		//Route::any('admin/serviconoturno/crud', 'ADMServicoNoturnoController@Crud');
		Route::get('admin/continente/delete/{id}', 'ADMContinentesController@destroy');
		Route::resource('admin/continente', 'ADMContinentesController');

		//Continente
		//Route::any('admin/serviconoturno/crud', 'ADMServicoNoturnoController@Crud');
		Route::get('admin/pais/delete/{id}', 'ADMPaisesController@destroy');
		Route::resource('admin/pais', 'ADMPaisesController');

		//Translado
		//Route::any('admin/translado/crud', 'ADMTransladoController@Crud');
		Route::get('admin/translado/delete/{id}', 'ADMTransladoController@destroy');
		Route::resource('admin/translado', 'ADMTransladoController');

		//Eventos Especiais
		//Route::any('admin/translado/crud', 'ADMTransladoController@Crud');
		Route::get('admin/eventoespecial/delete/{id}', 'ADMEventoEspecialController@destroy');
		Route::get('admin/eventoespecial/{id}/destaque', 'ADMEventoEspecialController@destaque');
		Route::resource('admin/eventoespecial', 'ADMEventoEspecialController');

		//Pacote Destaque
		Route::get('admin/pacote-destaque/delete/{id}', 'ADMPacoteDestaqueController@destroy');
		Route::resource('admin/pacote-destaque', 'ADMPacoteDestaqueController');

		//Pedidos
		Route::get('admin/pedido/delete/{id}', 'ADMPedidoController@destroy');
		Route::resource('admin/pedido', 'ADMPedidoController');

		//Produtos Personalizados
		Route::resource('admin/produto-personalizado', 'ADMProdutoPersonalizadoController');

		//Pacotes
		Route::get('admin/pacote/delete/{id}', 'ADMPacoteController@destroy');
		Route::resource('admin/pacote', 'ADMPacoteController');

		//Mailing
		Route::get('admin/mailing/delete/{id}', 'ADMMailingController@destroy');
		Route::post('admin/mailing/csv', 'ADMMailingController@postCsv');
		Route::resource('admin/mailing', 'ADMMailingController');

		//Usuários
		Route::any('admin/usuario/crud', 'ADMUserController@Crud');
		Route::controller('admin/usuario', 'ADMUserController');

		//Configurações
		Route::controller('admin/configuracao', 'ADMConfiguracoesController');

		//Manipulador de Imagens
		Route::post('admin/imagem/delete/{id}', 'ADMImagemController@postDelete');

		//Home
		Route::controller('admin', 'ADMHomeController');
	});
	//Requer Admin END

});
//Requer Login END

//Requer Guest
Route::group(array('before' => 'guest'), function()
{
	// Confide routes
	Route::get('users/create', 'UsersController@create');
	Route::post('users', 'UsersController@store');
	Route::get('users/login', 'UsersController@login');
	Route::post('users/login', 'UsersController@doLogin');
	Route::get('users/confirm/{code}', 'UsersController@confirm');
	Route::get('users/forgot_password', 'UsersController@forgotPassword');
	Route::post('users/forgot_password', 'UsersController@doForgotPassword');
	Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
	Route::post('users/reset_password', 'UsersController@doResetPassword');
});
//Requer Guest END

Route::controller('pacote-destaque', 'PacoteDestaqueController');
Route::controller('pacotedestaque', 'PacoteDestaqueController');
Route::controller('pacote', 'PacoteController');
Route::controller('carrinho', 'CarrinhoController');
Route::controller('price', 'PriceController');
Route::controller('hotel', 'HotelController');
Route::controller('apartamento', 'ApartamentoController');
Route::controller('passeio', 'PasseioController');
Route::controller('translado', 'TransladoController');
Route::controller('serviconoturno', 'ServicoNoturnoController');
Route::controller('eventoespecial', 'EventoEspecialController');
Route::controller('mailing', 'MailingController');
Route::controller('pages', 'PaginaController');

//Retorno Gateway Mundipagg
Route::post('gateway/mundipagg/retorno', 'MundipaggController@postRetorno');
Route::controller('mundipagg', 'MundipaggController');

//Linguagem
Route::get('lang', 'LangController@index');

//Home
Route::controller('/', 'HomeController');