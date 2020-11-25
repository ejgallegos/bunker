<?php
require_once "modules/comida/model.php";
require_once "modules/comida/view.php";


class ComidaController {

	function __construct() {
		$this->model = new Comida();
		$this->view = new ComidaView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$comida_collection = Collector()->get('Comida');

		foreach ($comida_collection as $clave => $valor) {
			if ($valor->habilitado == 1 && $valor->eliminado == 0) {
				$comidas[] = $valor;
			}
		}
		$this->view->panel($comidas);
	}

	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = strtoupper($valor);
        $this->model->save();
		header("Location: " . URL_APP . "/comida/panel");
	}

	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->comida_id = $arg;
		$this->model->get();
		$comida_collection = Collector()->get('Comida');
		$this->view->editar($comida_collection, $this->model);
	}

	function anular($arg) {
		SessionHandler()->check_session();
		
		$this->model->comida_id = $arg;
		$this->model->get();
		$this->model->habilitado = 0;
		$this->model->eliminado = 1;
		$this->model->save();

		header("Location: " . URL_APP . "/comida/panel");
	}
}
?>