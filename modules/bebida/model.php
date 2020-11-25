<?php
require_once "modules/categoria/model.php";
require_once "modules/marca/model.php";

class Bebida extends StandardObject {
	
	function __construct(Categoria $categoria=NULL, Marca $marca=NULL) {
		$this->bebida_id = 0;
		$this->denominacion = '';
		$this->valor = 0.00;
		$this->stock = 0;
		$this->habilitado = 1;
		$this->eliminado = 0;
		$this->categoria = $categoria;
		$this->marca = $marca;
	}
}
?>