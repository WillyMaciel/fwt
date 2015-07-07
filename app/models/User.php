<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use LaravelBook\Ardent\Ardent;

class User extends Eloquent implements ConfideUserInterface
{
	protected $table = 'clientes';

	public static $rules = array(
    'nome'                  => 'required|between:4,100',
    'email'                 => 'required|email',
    'telefone'				=> 'required',
    'password'              => 'required|alpha_num|between:4,8|confirmed',
    'password_confirmation' => 'required|alpha_num|between:4,8',
  );

    use ConfideUser;

    public function pedidos()
    {
    	return $this->hasMany('Pedido', 'cliente_id')->orderBy('created_at', 'DESC');
    }
}