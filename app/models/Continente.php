<?php

class Continente extends \Eloquent {

	protected $table = 'continentes';

	protected $primaryKey = 'code';

	public $timestamps = false;

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function paises()
	{
		return $this->hasMany('Pais', 'continent_code', 'code');
	}

	public function pacotes()
    {
        return $this->hasManyThrough('Pacote', 'Pais', 'continent_code', 'pais_id');
    }

}