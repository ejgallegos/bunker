<?php


class HistorialPedido extends StandardObject {
	
	function __construct() {
		$this->historialpedido_id = 0;
		$this->pedido = 0;
		$this->estado = 0;
		$this->subtotalbebida = 0.00;
		$this->subtotalcomida = 0.00;
		$this->total = 0.00;
	}
}
?>