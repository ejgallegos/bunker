<?php
require_once "modules/promo/model.php";
require_once "modules/categoria/model.php";
require_once "modules/promo/view.php";


class PromoController {

	function __construct() {
		$this->model = new Promo();
		$this->view = new PromoView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$promo_collection = Collector()->get('Promo');
		$categoria_collection = Collector()->get('Categoria');

		foreach ($promo_collection as $clave => $valor) {
			if ($valor->habilitado == 1 && $valor->eliminado == 0) {
				$promos[] = $valor;
			}
		}
		$this->view->panel($promos, $categoria_collection);
	}

	function guardar() {
		SessionHandler()->check_session();

		$categoria = filter_input(INPUT_POST, "categoria");
		$denominacion = filter_input(INPUT_POST, "denominacion");
		$descripcion = filter_input(INPUT_POST, "descripcion");
		$valor = filter_input(INPUT_POST, "valor");
		
		$this->model->categoria = strtoupper($categoria);
		$this->model->denominacion = strtoupper($denominacion);
		$this->model->descripcion = strtoupper($descripcion);
		$this->model->valor = $valor;
		$this->model->save();
		
		$promo_id = $this->model->promo_id;
		$archivo = $_FILES["archivo"]["tmp_name"];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime = $finfo->file($archivo);
		$formato = explode("/", $mime);
		$directorio = URL_APPIMAGES . "promo/{$promo_id}/";
		$name = trim(date("Ymd") . rand() . '.' . $formato[1]);
		print_r($name);exit;
		if(!file_exists($directorio)) {
			mkdir($directorio);
			chmod($directorio, 0777);
			move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
		} else {
			move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
		}
		
		$this->model->promo_id = $promo_id;
		$this->model->get();
		$this->model->imagen = $name . "." . $formato[1];
		$this->model->save();

		header("Location: " . URL_APP . "/promo/panel");
	}

	function actualizar() {
		SessionHandler()->check_session();
		
		$promo_id = filter_input(INPUT_POST, "promo_id");
		$categoria = filter_input(INPUT_POST, "categoria");
		$denominacion = filter_input(INPUT_POST, "denominacion");
		$descripcion = filter_input(INPUT_POST, "descripcion");
		$valor = filter_input(INPUT_POST, "valor");
		
		$this->model->promo_id = $promo_id;
		$this->model->get();
		$this->model->categoria = strtoupper($categoria);
		$this->model->denominacion = strtoupper($denominacion);
		$this->model->descripcion = strtoupper($descripcion);
		$this->model->valor = $valor;
		$this->model->save();
		header("Location: " . URL_APP . "/promo/panel");
	}

	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->promo_id = $arg;
		$this->model->get();
		$promo_collection = Collector()->get('Promo');
		$categoria_collection = Collector()->get('Categoria');
		$this->view->editar($promo_collection, $this->model, $categoria_collection);
	}

	function anular($arg) {
		SessionHandler()->check_session();
		
		$this->model->promo_id = $arg;
		$this->model->get();
		$this->model->habilitado = 0;
		$this->model->eliminado = 1;
		$this->model->save();

		header("Location: " . URL_APP . "/promo/panel");
	}
}
?>