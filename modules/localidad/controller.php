<?php
require_once "modules/localidad/model.php";
require_once "modules/localidad/view.php";


class LocalidadController {

	function __construct() {
		$this->model = new Localidad();
		$this->view = new LocalidadView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$localidad_collection = Collector()->get('Localidad');
		$this->view->panel($localidad_collection);
	}

	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = $valor;
        $this->model->save();
		header("Location: " . URL_APP . "/localidad/panel");
	}

	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->localidad_id = $arg;
		$this->model->get();
		$localidad_collection = Collector()->get('Localidad');
		$this->view->editar($localidad_collection, $this->model);
	}
}
?>