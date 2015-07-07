<?php

class Review extends \Eloquent
{

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	protected $guarded = [];

	public function cliente()
	{
		return $this->belongsTo('User', 'cliente_id');
	}

	public function produto()
	{
		return $this->belongsTo('Produto', 'produto_id');
	}

}