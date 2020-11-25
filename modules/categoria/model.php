<?php
require_once "modules/archivo/model.php";

class Categoria extends StandardObject {
	
	function __construct() {
		$this->categoria_id = 0;
		$this->denominacion = '';
		$this->archivo_collection = array();
	}

	function add_archivo(Archivo $archivo) {
		$this->archivo_collection[] = $archivo;
    }
}

class ArchivoCategoria {
	
	function __construct(Categoria $categoria=null) {
        $this->archivocategoria_id = 0;
        $this->compuesto = $categoria;
        $this->compositor = $categoria->archivo_collection;
    }

    function get() {
        $sql = "SELECT compositor FROM archivocategoria WHERE compuesto=?";
        $datos = array($this->compuesto->categoria_id);
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
        $sql = "INSERT INTO archivocategoria (compuesto, compositor)
                VALUES ";
        foreach($this->compositor as $archivo) {
            $tuplas[] = "(?, ?)";
            $datos[] = $this->compuesto->categoria_id;
            $datos[] = $archivo->archivo_id;
        }
        $sql .= implode(', ', $tuplas);
        execute_query($sql, $datos);
    }

    function destroy() {
        $sql = "DELETE FROM archivocategoria WHERE compuesto=?";
        $datos = array($this->compuesto->categoria_id);
        execute_query($sql, $datos);
	}
}
?>