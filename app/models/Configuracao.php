<?php

class Configuracao extends \Eloquent {

	protected $table = 'configuracoes';

	public $timestamps = false;

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}