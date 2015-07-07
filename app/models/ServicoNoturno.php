<?php

class ServicoNoturno extends Produto {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	//protected $fillable = [];

	protected $guarded = ['id'];

	public function pais()
	{
		return $this->belongsTo('Pais', 'pais_id', 'id');
	}

	public function imagens()
    {
        return $this->morphMany('Imagem', 'imagemMorph');
    }

}