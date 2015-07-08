<?php

class Hotel extends Produto
{

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	protected $guarded = [];

	public function destino()
	{
		return $this->belongsTo('Destino', 'destinos_id', 'id');
	}

	public function pais()
	{
		return $this->belongsTo('Pais', 'pais_id', 'id');
	}

	public function imagens()
    {
        return $this->morphMany('Imagem', 'imagemMorph');
    }

    public function caracteristicas()
    {
    	return $this->belongsToMany('Caracteristica', 'caracteristicas_produtos', 'produto_id', 'caracteristica_id');
    }

    public function pacotes()
    {
    	return $this->morphToMany('Pacote', 'pacote_relacoes');
    }

}