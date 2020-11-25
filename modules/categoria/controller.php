<?php
require_once "modules/categoria/model.php";
require_once "modules/categoria/view.php";
require_once "modules/archivo/model.php";


class CategoriaController {

	function __construct() {
		$this->model = new Categoria();
		$this->view = new CategoriaView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$categoria_collection = Collector()->get('Categoria');
		foreach ($categoria_collection as $clave => $valor) {
			$archivos[] = $valor->archivo_collection[0];
			foreach ($archivos as $key => $value) {
				$imagen = $value->url . "." . $value->formato;
				$valor->imagen = $imagen;
			}
			unset($valor->archivo_collection);
		}
		$this->view->panel($categoria_collection);
	}
	
	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = strtoupper($valor);
		$this->model->save();

		$categoria_id = $this->model->categoria_id;
		$denominacion = filter_input(INPUT_POST, "denominacion");
		$directorio = URL_APPIMAGES . "categoria/{$categoria_id}/";

		$archivo = $_FILES["archivo"]["tmp_name"];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime = $finfo->file($archivo);
		$formato = explode("/", $mime);
		
		$name = $categoria_id . date("Ymd") . rand();

			if(!file_exists($directorio)) {
				mkdir($directorio);
				chmod($directorio, 0777);
				move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
			} else {
				move_uploaded_file($archivo, "{$directorio}/{$name}.{$formato[1]}");
			}
			
			$am = new Archivo();
			$am->denominacion = $denominacion;
			$am->url = $name;
			$am->fecha_carga = date('Y-m-d');
			$am->formato = $formato[1];
			$am->save();
			
			$archivo_id = $am->archivo_id;
			$am = new Archivo();
			$am->archivo_id = $archivo_id;
			$am->get();
			
			$this->model->categoria_id = $categoria_id;
			$this->model->get();
			$this->model->add_archivo($am);
			
			$avm = new ArchivoCategoria($this->model);
			$avm->save(); 
		
		
		header("Location: " . URL_APP . "/categoria/panel");
		
	}
	
	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->categoria_id = $arg;
		$this->model->get();
		$categoria_collection = Collector()->get('Categoria');
		$this->view->editar($categoria_collection, $this->model);
	}
}
?>