<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function removeHtmlDescricao($collection)
	{
		$collection->each(function($e)
		{
			$e->descricao_br = strip_tags($e->descricao_br);
			$e->descricao_en = strip_tags($e->descricao_en);
		});

		return $collection;
	}

	protected function uploadImage($img, $folder)
	{
		if(empty($img))
		{
			return false;
		}

		//$destinationPath = public_path() . '/uploads/hoteis/';
        $destinationPath = "uploads/$folder/";
        $filename = $img->getClientOriginalName();
        $originalname = $filename;

        $i = 1;
        while(file_exists($destinationPath . $filename))
        {
        	$filename = $i . '_' . $originalname;
        	$i++;
        }

        $upload_success = $img->move($destinationPath, $filename);

        if ($upload_success) 
        {
	        // resizing an uploaded file
	        Image::make($destinationPath . $filename)->resize(114, 85)->save($destinationPath . "114x85_" . $filename);
	        Image::make($destinationPath . $filename)->resize(270, 160)->save($destinationPath . "270x160_" . $filename);
	        Image::make($destinationPath . $filename)->resize(900, 500)->save($destinationPath . "900x500_" . $filename);
	        Image::make($destinationPath . $filename)->resize(70, 70)->save($destinationPath . "70x70_" . $filename);

	        return array('filename' => $filename, 'destinationPath' => $destinationPath);
        }
        else
        {
        	return false;
        }
	}

	protected function comprar()
	{
		$params = [];

		$param[] = new Apartamento;
		$param[] = new Caracteristica;
		$param[] = new Configuracao;
		$param[] = new Continente;
		$param[] = new Destino;
		$param[] = new Endereco;
		$param[] = new EventoEspecial;
		$param[] = new Hotel;
		$param[] = new Imagem;
		$param[] = new Mailing;
		$param[] = new Pacote;
		$param[] = new PacoteDestaque;
		$param[] = new Pais;
		$param[] = new Passeio;
		$param[] = new Pedido;
		$param[] = new PedidoHistorico;
		$param[] = new PedidoStatus;
		$param[] = new Produto;
		$param[] = new ProdutoPersonalizado;
		$param[] = new Retorno;
		$param[] = new Review;
		$param[] = new ServicoNoturno;
		$param[] = new Translado;
		$param[] = new User;

		DB::statement("SET foreign_key_checks=0");
		foreach($param as $p)
		{
			$p::truncate();
		}

	}

	protected function addVisita($objeto)
	{
		(int) $visitas = $objeto->visitas;
		$visitas++;
		$objeto->visitas = $visitas;
		$objeto->save();
	}

}
