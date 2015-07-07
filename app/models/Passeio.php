<?php

class Passeio extends Produto
{

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function imagens()
    {
        return $this->morphMany('Imagem', 'imagemMorph');
    }

    public function pais()
	{
		return $this->belongsTo('Pais', 'pais_id', 'id');
	}

	public function destino()
	{
		return $this->belongsTo('Destino', 'destinos_id', 'id');
	}

}