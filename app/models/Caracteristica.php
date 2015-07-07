<?php

class Caracteristica extends \Eloquent {

	protected $table = 'produtos_caracteristicas';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}