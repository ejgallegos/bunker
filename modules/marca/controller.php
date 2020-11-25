<?php
require_once "modules/marca/model.php";
require_once "modules/marca/view.php";
require_once "modules/archivo/model.php";


class MarcaController {

	function __construct() {
		$this->model = new Marca();
		$this->view = new MarcaView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$marca_collection = Collector()->get('Marca');
		foreach ($marca_collection as $clave => $valor) {
			$archivos[] = $valor->archivo_collection[0];
			foreach ($archivos as $key => $value) {
				$imagen = $value->url . "." . $value->formato;
				$valor->imagen = $imagen;
			}
			unset($valor->archivo_collection);
		}
		$this->view->panel($marca_collection);
	}
	
	function guardar() {
		SessionHandler()->check_session();
		
		foreach ($_POST as $clave=>$valor) $this->model->$clave = strtoupper($valor);
		$this->model->save();

		$marca_id = $this->model->marca_id;
		$denominacion = filter_input(INPUT_POST, "denominacion");
		$directorio = URL_APPIMAGES . "marca/{$marca_id}/";

		$archivo = $_FILES["archivo"]["tmp_name"];
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$mime = $finfo->file($archivo);
		$formato = explode("/", $mime);
		
		$name = $marca_id . date("Ymd") . rand();

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
			
			$this->model->marca_id = $marca_id;
			$this->model->get();
			$this->model->add_archivo($am);
			
			$avm = new ArchivoMarca($this->model);
			$avm->save(); 
		
		
		header("Location: " . URL_APP . "/marca/panel");
		
	}
	
	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->marca_id = $arg;
		$this->model->get();
		$marca_collection = Collector()->get('Marca');
		$this->view->editar($marca_collection, $this->model);
	}
}
?>