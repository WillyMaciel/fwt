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

	protected function addVisita($objeto)
	{
		(int) $visitas = $objeto->visitas;
		$visitas++;
		$objeto->visitas = $visitas;
		$objeto->save();
	}

}
