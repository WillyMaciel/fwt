<?php

class Endereco extends \Eloquent {

	protected $table = 'clientes_enderecos';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];




}