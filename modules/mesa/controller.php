<?php
require_once "modules/mesa/model.php";
require_once "modules/mesa/view.php";


class MesaController {

	function __construct() {
		$this->model = new Mesa();
		$this->view = new MesaView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$mesa_collection = Collector()->get('Mesa');
		$this->view->panel($mesa_collection);
	}

	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = strtoupper($valor);
        $this->model->save();
		header("Location: " . URL_APP . "/mesa/panel");
	}

	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->mesa_id = $arg;
		$this->model->get();
		$mesa_collection = Collector()->get('Mesa');
		$this->view->editar($mesa_collection, $this->model);
	}
}
?>