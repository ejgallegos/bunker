<?php


class ComidaPedido extends StandardObject {
	
	function __construct() {
		$this->comidapedido_id = 0;
		$this->pedido = 0;
		$this->comida = 0;
        $this->cantidad = 0;
	}

}
?>