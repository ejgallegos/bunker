<?php
require_once "modules/archivo/model.php";

class Marca extends StandardObject {
	
	function __construct() {
		$this->marca_id = 0;
		$this->denominacion = '';
		$this->archivo_collection = array();
	}

	function add_archivo(Archivo $archivo) {
		$this->archivo_collection[] = $archivo;
    }
}

class ArchivoMarca {
	
	function __construct(Marca $marca=null) {
        $this->archivomarca_id = 0;
        $this->compuesto = $marca;
        $this->compositor = $marca->archivo_collection;
    }

    function get() {
        $sql = "SELECT compositor FROM archivomarca WHERE compuesto=?";
        $datos = array($this->compuesto->marca_id);
        $resultados = execute_query($sql, $datos);
        if($resultados){
			foreach($resultados as $array) {
				$obj = new Archivo();
				$obj->archivo_id = $array['compositor'];
				$obj->get();
				$this->compuesto->add_archivo($obj);
			}
		}
    }

    function save() {
        $this->destroy();
        $tuplas = array();
        $datos = array();
        $sql = "INSERT INTO archivomarca (compuesto, compositor)
                VALUES ";
        foreach($this->compositor as $archivo) {
            $tuplas[] = "(?, ?)";
            $datos[] = $this->compuesto->marca_id;
            $datos[] = $archivo->archivo_id;
        }
        $sql .= implode(', ', $tuplas);
        execute_query($sql, $datos);
    }

    function destroy() {
        $sql = "DELETE FROM archivomarca WHERE compuesto=?";
        $datos = array($this->compuesto->marca_id);
        execute_query($sql, $datos);
	}
}
?>