<?php


class Comida extends StandardObject {
	
	function __construct() {
		$this->comida_id = 0;
		$this->denominacion = '';
		$this->descripcion = '';
		$this->valor = 0.00;
		$this->habilitado = 1;
		$this->eliminado = 0;
	}
}
?>