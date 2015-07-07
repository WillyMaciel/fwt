<?php

class Pais extends \Eloquent {

	protected $table = 'paises';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public $timestamps = false;


	public function hoteis()
	{
		return $this->hasMany('Hotel', 'pais_id', 'id');
	}

	public function pacotes()
	{
		return $this->hasMany('Pacote', 'pais_id');
	}

	public function continente()
	{
		return $this->belongsTo('Continente', 'continent_code');
	}

}