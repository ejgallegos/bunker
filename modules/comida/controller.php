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

		$denominacion = filter_input(INPUT_POST, "denominacion");
		$descripcion = filter_input(INPUT_POST, "descripcion");
		$valor = filter_input(INPUT_POST, "valor");
		
		$this->model->denominacion = strtoupper($denominacion);
		$this->model->descripcion = strtoupper($descripcion);
		$this->model->valor = $valor;
		$this->model->save();
		
		$comida_id = $this->model->comida_id;
		$archivo = $_FILES["archivo"]["tmp_name"];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime = $finfo->file($archivo);
		$formato = explode("/", $mime);
		$directorio = URL_APPIMAGES . "comida/{$comida_id}/";
		$name = $comida_id . date("Ymd") . rand();
		if(!file_exists($directorio)) {
			mkdir($directorio);
			chmod($directorio, 0777);
			move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
		} else {
			move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
		}
		
		$this->model->comida_id = $comida_id;
		$this->model->get();
		$this->model->imagen = $name . "." . $formato[1];
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