<?php

class ADMUserController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$filter = DataFilter::source(new User);
        $filter->add('nome','Nome completo', 'text');
        $filter->add('username','Login','text');
        $filter->add('email','E-mail','text');
        $filter->add('is_admin', 'Administrador', 'select')->options(array('' => 'Todos', 0 => 'Clientes', 1 => 'Administradores'));
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('nome','Nome completo', true); //field name, label, sortable
		$grid->add('email','E-mail', true); //relation.fieldname
		$grid->add('publicado', 'Habilitado', true);
		$grid->add('confirmed', 'Confirmado', true);

		$grid->edit('admin/usuario/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->link('admin/usuario/crud',"Adicionar Novo", "TR");  //add button
		$grid->orderBy('id','desc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));

		//Transforma TinyInteger de Publicado em Sim ou Não ao invez de 1 ou 0
		$grid->row(function($row)
		{
			if($row->cell('publicado')->value == 1)
			{
				$row->cell('publicado')->value = '<span class="label label-success"> Sim </span>';
			}
			else
			{
				$row->cell('publicado')->value = '<span class="label label-danger"> Não </span>';
			}

			if($row->cell('confirmed')->value == 1)
			{
				$row->cell('confirmed')->value = '<span class="label label-success"> Confirmado </span>';
			}
			else
			{
				$row->cell('confirmed')->value = '<span class="label label-danger"> Não Confirmado </span>';
			}
		});

		// $user = user::find(1);
		// echo $user->destino->{'nome_br'};
		// dd();

		return View::make('admin.user.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function Crud()
	{

		//simple crud for Article entity
	    $form = DataEdit::source(new User);
	    $form->link("admin/usuario/","Voltar para listagem", "TR")->back();
	    $form->text('nome', 'Nome', 'text')->rule('required');
	    $form->text('email', 'E-mail', 'text')->rule('required');
	    $form->text('cpf', 'CPF', 'text');
	    $form->text('telefone_residencial', 'Telefone Fixo', 'text');
	    $form->text('telefone_celular', 'Telefone Celular', 'text');
	    $form->text('telefone_comercial', 'Telefone Comercial', 'text');
	    $form->text('pais', 'País', 'text');
	    $form->text('estado', 'Estado', 'text');
	    $form->text('cidade', 'Cidade', 'text');
	    $form->radiogroup('publicado','Habilitado')
			 ->option(0,'Não')->option(1,'Sim');
     	$form->radiogroup('confirmed','Confirmado')
			 ->option(0,'Não')->option(1,'Sim');
		$form->radiogroup('is_admin','Administrador')
			 ->option(0,'Não')->option(1,'Sim');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))


		$form->saved(function () use ($form) {
            $form->message("ok record saved");
        });

	    $form->build();

	    return $form->view('admin.user.crud', compact('form'));
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), user::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		user::create($data);

		return Redirect::route('users.index');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = user::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = user::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = user::findOrFail($id);

		$validator = Validator::make($data = Input::all(), user::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		user::destroy($id);

		return Redirect::route('users.index');
	}

}
