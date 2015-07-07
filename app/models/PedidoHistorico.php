<?php

class PedidoHistorico extends \Eloquent 
{
	protected $table = 'pedidos_historico';
	protected $fillable = [];

	public function pedido()
	{
		return $this->belongsTo('Pedido', 'pedido_id');
	}

	public function status()
	{
		return $this->belongsTo('PedidoStatus', 'pedido_status_id');
	}

}