<?php

class ADMMailingController extends \BaseController {

	/**
	 * Display a listing of mailings
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = DataFilter::source(new Mailing);
        $filter->add('email','Email', 'text');
        $filter->add('nome','Nome', 'text');
        $filter->add('phone','Telefone', 'text');
        $filter->submit('Filtrar');
        $filter->reset('Limpar Filtro');
        $filter->build();

		$grid = DataGrid::source($filter);  //same source types of DataSet
		$grid->attributes(array("class"=>"table table-striped table-hover"));
		$grid->add('email','Email', true); //field name, label, sortable
		$grid->add('nome','Nome', true); //field name, label, sortable
		$grid->add('phone','Telefone', true); //field name, label, sortable		
		$grid->add('
					<a class="text-danger" title="Deletar" href="admin/mailing/delete/{{$id}}"><span class="glyphicon glyphicon-trash"> </span></a>
					', 'Ações');
		//$grid->edit('admin/mailing/crud', 'Ações','show|modify|delete'); //shortcut to link DataEdit actions
		$grid->orderBy('email','asc'); //default orderby
		$grid->paginate(10); //pagination
		$grid->attributes(array('class' => 'table table-striped table-hover'));

		// $mailing = Mailing::find(1);
		// echo $mailing->destino->{'nome_br'};
		// dd();

		return View::make('admin.mailing.index', compact('filter', 'grid'));
	}

	/**
	 * Show the form for creating a new mailing
	 *
	 * @return Response
	 */
	public function Crud()
	{
		//simple crud for Article entity
	    $form = DataEdit::source(new Mailing);
	    $form->link("admin/mailing/","Voltar para listagem", "TR")->back();
	    $form->text('nome_br', 'Nome PT', 'text')->rule('required');
	    $form->text('nome_en', 'Nome EN', 'text')->rule('required');
	    $form->textarea('descricao_br','Descricao PT');
	    $form->textarea('descricao_en','Descricao EN');
	    $form->select('destinos_id','Pertence ao Destino')
     		 ->options(Destino::lists("nome_br", "id"));
     	$form->radiogroup('publicado','Publicado')
		->option(0,'Não')->option(1,'Sim');
		$form->add('imagem','Imagem Principal', 'image')->move('uploads/mailings/')->fit(900, 500)->preview(260,180);
		//$form->text('valor_diaria', 'Valor da diária', 'text');
		//$form->text('deposito', 'Valor do depósito de segurança', 'text');
	    //$form->add('author.name','Author','autocomplete')->search(array('firstname','lastname'));
	    //$form->autocomplete('author.name','Author')->search(array('firstname','lastname'));

	    //->attributes(array('multiple'))

	    $form->build();

	    return $form->view('admin.mailing.crud', compact('form'));
	}

	public function create()
	{
		$paises = Pais::lists("name", "id");

		return View::make('admin.mailing.create', compact('paises'));
	}

	/**
	 * Store a newly created mailing in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Mailing::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mailing = new Mailing;

		$mailing->nome_br = $data['nome_br'];
		$mailing->nome_en = $data['nome_en'];
		$mailing->descricao_br = $data['descricao_br'];
		$mailing->descricao_en = $data['descricao_en'];
		$mailing->pais_id = $data['pais_id'];
		//$mailing->estado = $data['estado'];
		$mailing->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'mailings');
			if($up_success)
			{
				$mailing->imagem = $up_success['filename'];
			}
		}

		$mailing->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'mailings');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $mailing->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/mailing/')->with('success', array('Registro salvo.'));
	}

	/**
	 * Display the specified mailing.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$mailing = Mailing::findOrFail($id);

		return View::make('mailings.show', compact('mailing'));
	}

	/**
	 * Show the form for editing the specified mailing.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$mailing = Mailing::find($id);
		$paises = Pais::lists("name", "id");

		return View::make('admin.mailing.edit', compact('mailing', 'paises'));
	}

	/**
	 * Update the specified mailing in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$mailing = Mailing::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Mailing::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$mailing->nome_br = $data['nome_br'];
		$mailing->nome_en = $data['nome_en'];
		$mailing->descricao_br = $data['descricao_br'];
		$mailing->descricao_en = $data['descricao_en'];
		$mailing->pais_id = $data['pais_id'];
		//$mailing->estado = $data['estado'];
		$mailing->publicado = $data['publicado'];

		if(Input::hasFile('imagem'))
		{
			$up_success = $this->uploadImage(Input::file('imagem'), 'mailings');
			if($up_success)
			{
				$mailing->imagem = $up_success['filename'];
			}
		}

		$mailing->save();

		if(Input::hasFile('imagens'))
		{
			$imagens = Input::file('imagens');

			$imagens = array_filter($imagens);

			foreach($imagens as $img)
			{
		        $imginfo = $this->uploadImage($img, 'mailings');

		        if($imginfo)
		        {
			        $imagem = new Imagem;
			        $imagem->nome = $imginfo['filename'];
			        $imagem->caminho = $imginfo['destinationPath'];

			        $mailing->imagens()->save($imagem);
			    }
		    }
		}

		return Redirect::to('admin/mailing/')->with('success', array('Registro salvo.'));
	}

	public function postCsv()
	{
		$mailing = Mailing::all();

		$file_path = 'mailing.csv';

		$dados = '';

		$dados .= 'EMAIL';
		$dados .= "\n";

		foreach($mailing as $m)
		{
			$dados .= $m->email;
			$dados .= "\n";
		}

		if(fwrite($file=fopen($file_path,'w+'),$dados)) 
		{  
			fclose($file);  
			return Response::download($file_path);
		}
	}

	/**
	 * Remove the specified mailing from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$mailing = Mailing::find($id);

		$mailing->delete();

		return Redirect::to('admin/mailing/')->with('success', array('Registro deletado.'));
	}

}
