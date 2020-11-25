<?php
require_once "modules/pedido/model.php";
require_once "modules/pedido/view.php";
require_once "modules/mesa/model.php";
require_once "modules/bebida/model.php";
require_once "modules/marca/model.php";
require_once "modules/bebidapedido/model.php";


class PedidoController {

	function __construct() {
		$this->model = new Pedido();
		$this->view = new PedidoView();
	}

	function panel() {
    	SessionHandler()->check_session();
		
		$bebida_collection = Collector()->get('Bebida');

		foreach ($bebida_collection as $clave => $valor) {
			if ($valor->habilitado == 1 && $valor->eliminado == 0) {
				$bebidas[] = $valor;
			}
		}
		$this->view->panel($bebidas);
	}

	function agregar() {
    	SessionHandler()->check_session();
		
		$mesa_collection = Collector()->get('Mesa');
		$categoria_collection = Collector()->get('Categoria');

		foreach ($categoria_collection as $clave => $valor) {
			$archivos[] = $valor->archivo_collection[0];
			foreach ($archivos as $key => $value) {
				$imagen = $value->url . "." . $value->formato;
				$valor->imagen = $imagen;
			}
			unset($valor->archivo_collection);
		}

		$this->view->agregar($mesa_collection, $categoria_collection);
	}

	function traerMarcas($arg) {
		SessionHandler()->check_session();
		$select = "b.bebida_id ID, b.denominacion DENO, b.valor PRECIO, ma.marca_id MRC, ma.denominacion MARCA, concat(ar.url, '.', ar.formato) IMG";
		$from = "marca ma, archivo ar, archivomarca am, bebida b, categoria c";
		$where = "am.compuesto = ma.marca_id AND am.compositor = ar.archivo_id AND b.categoria = c.categoria_id AND b.marca = ma.marca_id AND b.categoria = {$arg} AND b.habilitado = 1 ORDER BY ma.denominacion";
		$bebidas_collection = CollectorCondition()->get('Bebida', $where, 4, $from, $select);
		$this->view->traerMarcas($bebidas_collection);
	}

	function guardar($arg) {
		SessionHandler()->check_session();
		date_default_timezone_set('America/Argentina/La_Rioja');
		$ids = explode('@', $arg);
		$mesa = $ids[0];
		$bebida = $ids[1];
		$cantidad = $ids[2];
		$pedidoId = $ids[3];
		
		if ($pedidoId != null || $pedidoId != 0 || $pedidoId != "") {
			$bp = new BebidaPedido();
			$bp->pedido = $pedidoId;
			$bp->bebida = $bebida;
			$bp->cantidad = $cantidad;
			$bp->save();
			print($pedidoId);exit;
		}

		$this->model->fecha = date('Y-m-d');		
		$this->model->mesa = $mesa;		
		$this->model->estado = 1;		
        $this->model->save();
		
		$pedido_id = $this->model->pedido_id;
		
		$bp = new BebidaPedido();
		$bp->pedido = $pedido_id;
		$bp->bebida = $bebida;
		$bp->cantidad = $cantidad;
		$bp->save();
		print($pedido_id);exit;

	}

	function mostrarPedidoBebida($arg){
		SessionHandler()->check_session();
		$select = "bp.pedido PEDIDO, m.denominacion MARCA, b.bebida_id BEBIDAID, b.denominacion DENO, b.valor PRECIO, bp.cantidad CANT";
		$from = "bebidapedido bp, bebida b, marca m";
		$where = "bp.bebida = b.bebida_id AND b.marca = m.marca_id AND bp.pedido = {$arg}";
		$bebidas_collection = CollectorCondition()->get('BebidaPedido', $where, 4, $from, $select);
		$this->view->mostrarPedidoBebida($bebidas_collection);
	} 

	function eliminaPedidoBebida($arg){
		SessionHandler()->check_session();
		$ids = explode('@', $arg);
		$pedidoId = $ids[0];
		$bebidaId = $ids[1];
		$select = "bebidapedido_id ID";
		$from = "bebidapedido";
		$where = "pedido = {$pedidoId} AND bebida = {$bebidaId}";
		$bebidaPedidoId = CollectorCondition()->get('BebidaPedido', $where, 4, $from, $select);
		$bpid = $bebidaPedidoId[0]["ID"];
		$bp = new BebidaPedido();
		$bp->bebidapedido_id = $bpid;
		$bp->get();
		$bp->delete();
	}



	function editar($arg) {
		SessionHandler()->check_session();
		
		$this->model->bebida_id = $arg;
		$this->model->get();
		$bebida_collection = Collector()->get('Bebida');
		$this->view->editar($bebida_collection, $this->model);
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