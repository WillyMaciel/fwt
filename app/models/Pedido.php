<?php

class Pedido extends \Eloquent
{
	protected $table = 'pedidos';
	protected $fillable = [];

	public function cliente()
	{
		return $this->belongsTo('User', 'cliente_id');
	}

	public function status()
	{
		return $this->belongsTo('PedidoStatus', 'pedido_status_id');
	}

	public function produtos()
	{
		return $this->belongsToMany('Produto', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'nome_br', 'nome_en', 'preco', 'quantidade', 'tipo');
	}

	public function historico()
	{
		return $this->hasMany('PedidoHistorico', 'pedido_id');
	}
}