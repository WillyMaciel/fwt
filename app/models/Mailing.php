<?php

class Mailing extends \Eloquent {

	protected $table = 'mailing';

	// Add your validation rules here
	public static $rules = [];

	// Don't forget to fill this array
	protected $fillable = [];
}