<?php


class PromoPedido extends StandardObject {
	
	function __construct() {
		$this->promopedido_id = 0;
		$this->pedido = 0;
		$this->promo = 0;
        $this->cantidad = 0;
	}

}
?>