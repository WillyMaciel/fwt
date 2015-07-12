<?php

class Pacote extends Produto {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function pais()
	{
		return $this->belongsTo('Pais');
	}

	public function imagens()
    {
        return $this->morphMany('Imagem', 'imagemMorph');
    }

    public function apartamentos()
    {
    	return $this->morphedByMany('Apartamento', 'pacote_relacoes', 'pacote_relacoes', 'pacote_id', 'produto_id');
    }

    public function hoteis()
    {
    	return $this->morphedByMany('Hotel', 'pacote_relacoes', 'pacote_relacoes', 'pacote_id', 'produto_id');
    }

    public function passeios()
    {
    	return $this->morphedByMany('Passeio', 'pacote_relacoes', 'pacote_relacoes', 'pacote_id', 'produto_id');
    }

    public function servicosnoturnos()
    {
    	return $this->morphedByMany('ServicoNoturno', 'pacote_relacoes', 'pacote_relacoes', 'pacote_id', 'produto_id');
    }

}