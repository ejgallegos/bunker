<?php
require_once "modules/pedido/model.php";
require_once "modules/pedido/view.php";
require_once "modules/mesa/model.php";
require_once "modules/bebida/model.php";
require_once "modules/marca/model.php";
require_once "modules/comida/model.php";
require_once "modules/bebidapedido/model.php";
require_once "modules/comidapedido/model.php";
require_once "modules/historialpedido/model.php";
require_once "common/libs/vendor/autoload.php";


class PedidoController {

	function __construct() {
		$this->model = new Pedido();
		$this->view = new PedidoView();
	}

	function panel() {
		SessionHandler()->check_session();
		
		$options = array(
			'cluster' => 'us2',
			'useTLS' => true
		);
		$pusher = new Pusher\Pusher(
			'594823f1abf3ec29cbf9',
			'd21496dc0c3d4ba7eae4',
			'1114989',
			$options
		);

		$data['message'] = 'hello world';
		$pusher->trigger('my-channel', 'my-event', $data);
		
		$select = "bp.pedido PEDIDO, bp.cantidad CANT, m.denominacion MARCA, b.denominacion DENO, b.valor PRECIO";
		$from = "pedido p, bebidapedido bp, bebida b, marca m ";
		$where = "bp.bebida = b.bebida_id AND b.marca = m.marca_id AND p.pedido_id = bp.pedido AND p.estado = 2";
		$bebidas_collection = CollectorCondition()->get('BebidaPedido', $where, 4, $from, $select);

		$select = "cp.pedido PEDIDO, cp.comida COMIDAID, c.denominacion DENO, c.valor PRECIO, cp.cantidad CANT";
		$from = "pedido p, comida c, comidapedido cp";
		$where = "c.comida_id = cp.comida AND p.pedido_id = cp.pedido AND p.estado = 2";
		$comidas_collection = CollectorCondition()->get('ComidaPedido', $where, 4, $from, $select);

		$pedido_collection = Collector()->get('Pedido');
		foreach ($pedido_collection as $clave => $valor) {
			foreach ($bebidas_collection as $clave1 => $valor1) {
				if ($valor->pedido_id == $valor1['PEDIDO']) {
					$valor->descripcion_bebidas[] = $valor1['CANT'] . " " . $valor1['MARCA'] . " " . $valor1['DENO'];
				}
			}
			foreach ($comidas_collection as $clave2 => $valor2) {
				if ($valor->pedido_id == $valor2['PEDIDO']) {
					$valor->descripcion_comida[] = $valor2['CANT'] . " " . $valor2['DENO'];
				}
			}
		}
		$this->view->panel($pedido_collection);
	}

	function agregar() {
    	SessionHandler()->check_session();
		
		$mesa_collection = Collector()->get('Mesa');
		foreach ($mesa_collection as $clave => $valor) {
			if ($valor->disponible == 1) {
				$mesas_disponnibles[] = $valor;
			}
		}
		$categoria_collection = Collector()->get('Categoria');

		foreach ($categoria_collection as $clave => $valor) {
			$archivos[] = $valor->archivo_collection[0];
			foreach ($archivos as $key => $value) {
				$imagen = $value->url . "." . $value->formato;
				$valor->imagen = $imagen;
			}
			unset($valor->archivo_collection);
		}

		$comida_collection = Collector()->get('Comida');

		foreach ($comida_collection as $clave => $valor) {
			if ($valor->habilitado == 1 && $valor->eliminado == 0) {
				$comidas[] = $valor;
			}
		}
	
		$this->view->agregar($mesas_disponnibles, $categoria_collection, $comidas);
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
		//GUARDA EL PEDIDO DE BEBIDA
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

			$md = new Mesa();
			$md->mesa_id = $mesa;
			$md->get();
			$md->disponible = 2;
			$md->save();
			print($pedidoId);exit;
		}

		$this->model->fecha = date('Y-m-d');		
		$this->model->mesa = $mesa;		
		$this->model->estado = 1;		
		$this->model->save();
		
		$md = new Mesa();
		$md->mesa_id = $mesa;
		$md->get();
		$md->disponible = 2;
		$md->save();
		
		$pedido_id = $this->model->pedido_id;
		
		$bp = new BebidaPedido();
		$bp->pedido = $pedido_id;
		$bp->bebida = $bebida;
		$bp->cantidad = $cantidad;
		$bp->save();
		print($pedido_id);exit;

	}

	function guardarComida($arg) {
		//GUARDA EL PEDIDO DE COMIDA
		SessionHandler()->check_session();
		date_default_timezone_set('America/Argentina/La_Rioja');
		$ids = explode('@', $arg);
		$mesa = $ids[0];
		$comida = $ids[1];
		$cantidad = $ids[2];
		$pedidoId = $ids[3];
		
		if ($pedidoId != null || $pedidoId != 0 || $pedidoId != "") {
			$bp = new ComidaPedido();
			$bp->pedido = $pedidoId;
			$bp->comida = $comida;
			$bp->cantidad = $cantidad;
			$bp->save();
			
			$md = new Mesa();
			$md->mesa_id = $mesa;
			$md->get();
			$md->disponible = 2;
			$md->save();
			print($pedidoId);exit;
		}

		$this->model->fecha = date('Y-m-d');		
		$this->model->mesa = $mesa;		
		$this->model->estado = 1;		
        $this->model->save();
		
		$pedido_id = $this->model->pedido_id;

		$md = new Mesa();
		$md->mesa_id = $mesa;
		$md->get();
		$md->disponible = 2;
		$md->save();
		
		$bp = new ComidaPedido();
		$bp->pedido = $pedido_id;
		$bp->comida = $comida;
		$bp->cantidad = $cantidad;
		$bp->save();
		print($pedido_id);exit;

	}

	function mostrarPedidoBebida($arg){
		SessionHandler()->check_session();
		$select = "bp.pedido PEDIDO, m.denominacion MARCA, bp.bebida BEBIDAID, b.denominacion DENO, b.valor PRECIO, bp.cantidad CANT";
		$from = "bebidapedido bp, bebida b, marca m";
		$where = "bp.bebida = b.bebida_id AND b.marca = m.marca_id AND bp.pedido = {$arg}";
		$bebidas_collection = CollectorCondition()->get('BebidaPedido', $where, 4, $from, $select);
		$this->view->mostrarPedidoBebida($bebidas_collection);
	} 
	
	function mostrarPedidoComida($arg){
		SessionHandler()->check_session();
		$select = "cp.pedido PEDIDO, cp.comida COMIDAID, c.denominacion DENO, c.valor PRECIO, cp.cantidad CANT";
		$from = "comida c, comidapedido cp";
		$where = "c.comida_id = cp.comida AND cp.pedido = {$arg}";
		$comidas_collection = CollectorCondition()->get('ComidaPedido', $where, 4, $from, $select);
		$this->view->mostrarPedidoComida($comidas_collection);
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
	
	function eliminaPedidoComida($arg){
		SessionHandler()->check_session();
		$ids = explode('@', $arg);
		$pedidoId = $ids[0];
		$comidaId = $ids[1];
		$select = "comidapedido_id ID";
		$from = "comidapedido";
		$where = "pedido = {$pedidoId} AND comida = {$comidaId}";
		$comidaPedidoId = CollectorCondition()->get('ComidaPedido', $where, 4, $from, $select);
		$cpid = $comidaPedidoId[0]["ID"];
		$cp = new ComidaPedido();
		$cp->comidapedido_id = $cpid;
		$cp->get();
		$cp->delete();
	}

	function calcularPedido($arg){
		SessionHandler()->check_session();
		$select_bebida = "SUM(b.valor * bp.cantidad) SUBTOTALBEBIDA";
		$from_bebida = "bebida b, bebidapedido bp";
		$where_bebida = "b.bebida_id = bp.bebida AND bp.pedido = {$arg}";
		$subtotal_bebida = CollectorCondition()->get('BebidaPedido', $where_bebida, 4, $from_bebida, $select_bebida);
		
		$select_comida = "SUM(c.valor * cp.cantidad) SUBTOTALCOMIDA";
		$from_comida = "comida c, comidapedido cp";
		$where_comida = "c.comida_id = cp.comida AND cp.pedido = {$arg}";
		$subtotal_comida = CollectorCondition()->get('ComidaPedido', $where_comida, 4, $from_comida, $select_comida);
		$totalPedido = round($subtotal_bebida[0]["SUBTOTALBEBIDA"] + $subtotal_comida[0]["SUBTOTALCOMIDA"], 2);
		$totales = array('subtotalbebida' => $subtotal_bebida[0]["SUBTOTALBEBIDA"], 'subtotalcomida' => $subtotal_comida[0]["SUBTOTALCOMIDA"], 'totalpedido' => $totalPedido, 'id_pedido' => $arg);
		$this->view->calcularPedido($totales);
	}
	
	function finalizarPedido(){
		SessionHandler()->check_session();
		$pedidoId = filter_input(INPUT_POST, "idpedido");
		$subtbebida = filter_input(INPUT_POST, "subtbebida");
		$subtcomida = filter_input(INPUT_POST, "subtcomida");
		$tpedido = filter_input(INPUT_POST, "tpedido");
		$this->model->pedido_id = $pedidoId;
		$this->model->get();
		$this->model->estado = 2;
		$this->model->save();

		$hp = new HistorialPedido();
		$hp->pedido = $pedidoId;
		$hp->estado = 2;
		$hp->subtotalbebida = $subtbebida;
		$hp->subtotalcomida = $subtcomida;
		$hp->total = $tpedido;
		$hp->save();

		header("Location: " . URL_APP . "/pedido/agregar");
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