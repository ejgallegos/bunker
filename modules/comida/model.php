<?php
require_once "modules/categoria/model.php";

class Comida extends StandardObject {
	
	function __construct(Categoria $categoria=NULL) {
		$this->comida_id = 0;
		$this->denominacion = '';
		$this->descripcion = '';
		$this->valor = 0.00;
		$this->imagen = '';
		$this->habilitado = 1;
		$this->eliminado = 0;
		$this->categoria = $categoria;
	}
}
?>