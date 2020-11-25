<?php

require_once "modules/bebida/model.php";

class BebidaPedido extends StandardObject {
	
	function __construct() {
		$this->bebidapedido_id = 0;
		$this->pedido = 0;
		$this->bebida = 0;
        $this->cantidad = 0;
	}

}
?>