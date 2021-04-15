<?php
require_once "modules/categoria/model.php";

class Promo extends StandardObject {
	
	function __construct(Categoria $categoria=NULL) {
		$this->promo_id = 0;
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