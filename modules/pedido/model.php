<?php
require_once "modules/mesa/model.php";
require_once "modules/estado/model.php";
require_once "modules/bebida/model.php";

class Pedido extends StandardObject {
	
	function __construct(Bebida $bebida=NULL) {
		$this->pedido_id = 0;
		$this->fecha = '';
		$this->mesa = 0;
		$this->estado = 0;
		
	}

}
?>