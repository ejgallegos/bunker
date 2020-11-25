<?php
require_once "modules/bebida/model.php";
require_once "modules/bebida/view.php";


class BebidaController {

	function __construct() {
		$this->model = new Bebida();
		$this->view = new BebidaView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$bebida_collection = Collector()->get('Bebida');
		$categoria_collection = Collector()->get('Categoria');
		$marca_collection = Collector()->get('Marca');

		foreach ($bebida_collection as $clave => $valor) {
			if ($valor->habilitado == 1 && $valor->eliminado == 0) {
				$bebidas[] = $valor;
			}
		}
		$this->view->panel($bebidas, $categoria_collection, $marca_collection);
	}

	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = strtoupper($valor);
        $this->model->save();
		header("Location: " . URL_APP . "/bebida/panel");
	}

	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->bebida_id = $arg;
		$this->model->get();
		$bebida_collection = Collector()->get('Bebida');
		$categoria_collection = Collector()->get('Categoria');
		$marca_collection = Collector()->get('Marca');
		$this->view->editar($bebida_collection, $this->model, $categoria_collection, $marca_collection);
	}

	function anular($arg) {
		SessionHandler()->check_session();
		
		$this->model->bebida_id = $arg;
		$this->model->get();
		$this->model->habilitado = 0;
		$this->model->eliminado = 1;
		$this->model->save();

		header("Location: " . URL_APP . "/bebida/panel");
	}
}
?>