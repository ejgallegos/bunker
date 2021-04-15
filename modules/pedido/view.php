<?php


class PedidoView extends View {
	
	function panel($pedido_collection) {
		$gui = file_get_contents("static/modules/pedido/panel.html");
		$gui_tbl_pedidos = file_get_contents("static/modules/pedido/tbl_pedidos.html");

		foreach ($pedido_collection as $clave => $valor) {
			$temp_bebidas = $valor->descripcion_bebidas;
			$bebidas = implode("<br>", $temp_bebidas);
			$pedido_collection[$clave]->bebidas = $bebidas;
		}
		foreach ($pedido_collection as $clave => $valor) {
			$temp_comidas = $valor->descripcion_comidas;
			$comidas = implode("<br>", $temp_comidas);
			$pedido_collection[$clave]->comidas = $comidas;
		}
		
		foreach ($pedido_collection as $clave => $valor) {
			$pedido_estado[] = $valor->estado;
			foreach ($pedido_estado as $clave => $valor) {
				switch ($valor->estado_id) {
					case PENDIENTE:
						$valor->etiqueta = 'btn btn-round btn-danger';
						break;
					case GENERADO:
						$valor->etiqueta = 'btn btn-round btn-warning';
						break;
					case FINALIZADO:
						$valor->etiqueta = 'btn btn-round btn-success';
						break;
				}
				$pedido_collection->etiqueta = $valor->etiqueta;
			}
		}


		$gui_tbl_pedidos = $this->render_regex('TBL_PEDIDO', $gui_tbl_pedidos, $pedido_collection);
		$render = str_replace('{tbl_pedidos}', $gui_tbl_pedidos, $gui);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}
	
	function nuevoPedido($pedido_collection) {
		$gui_tbl_pedidos = file_get_contents("static/modules/pedido/tbl_pedidos.html");

		foreach ($pedido_collection as $clave => $valor) {
			$temp_bebidas = $valor->descripcion_bebidas;
			$bebidas = implode("<br>", $temp_bebidas);
			$pedido_collection[$clave]->bebidas = $bebidas;
		}
		foreach ($pedido_collection as $clave => $valor) {
			$temp_comidas = $valor->descripcion_comidas;
			$comidas = implode("<br>", $temp_comidas);
			$pedido_collection[$clave]->comidas = $comidas;
		}
		
		foreach ($pedido_collection as $clave => $valor) {
			$pedido_estado[] = $valor->estado;
			foreach ($pedido_estado as $clave => $valor) {
				switch ($valor->estado_id) {
					case PENDIENTE:
						$valor->etiqueta = 'btn btn-round btn-danger';
						break;
					case GENERADO:
						$valor->etiqueta = 'btn btn-round btn-warning';
						break;
					case FINALIZADO:
						$valor->etiqueta = 'btn btn-round btn-success';
						break;
				}
				$pedido_collection->etiqueta = $valor->etiqueta;
			}
		}

		$gui_tbl_pedidos = $this->render_regex('TBL_PEDIDO', $gui_tbl_pedidos, $pedido_collection);
		print $gui_tbl_pedidos;
	}
	
	/*function agregar($mesa_collection, $categoria_collection, $comida_collection) {
		$gui = file_get_contents("static/modules/pedido/agregar.html");
		$gui_slt_mesas = file_get_contents("static/modules/pedido/slt_mesas.html");
		$gui_img_categorias = file_get_contents("static/modules/pedido/img_categoria.html");
		$gui_img_comidas = file_get_contents("static/modules/pedido/img_comida.html");
		
		$gui_slt_mesas = $this->render_regex('SLT_MESA', $gui_slt_mesas, $mesa_collection);
		$gui_img_categorias = $this->render_regex('IMG_CATEGORIA', $gui_img_categorias, $categoria_collection);
		$gui_img_comidas = $this->render_regex('COMIDA', $gui_img_comidas, $comida_collection);

		
		$render = str_replace('{slt_mesa}', $gui_slt_mesas, $gui);
		$render = str_replace('{img_categoria}', $gui_img_categorias, $render);
		$render = str_replace('{img_comidas}', $gui_img_comidas, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}*/

	function agregar($mesa_collection, $categoria_collection) {
		$gui = file_get_contents("static/modules/pedido/agregar.html");
		$gui_slt_mesas = file_get_contents("static/modules/pedido/slt_mesas.html");
		$gui_img_categorias = file_get_contents("static/modules/pedido/img_categoria.html");
		
		$gui_slt_mesas = $this->render_regex('SLT_MESA', $gui_slt_mesas, $mesa_collection);
		$gui_img_categorias = $this->render_regex('IMG_CATEGORIA', $gui_img_categorias, $categoria_collection);

		
		$render = str_replace('{slt_mesa}', $gui_slt_mesas, $gui);
		$render = str_replace('{img_categoria}', $gui_img_categorias, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function agregarProducto($categoria_collection) {
		$gui = file_get_contents("static/modules/pedido/agregar_producto.html");
		$gui_img_categorias = file_get_contents("static/modules/pedido/img_categoria.html");
		
		$gui_img_categorias = $this->render_regex('IMG_CATEGORIA', $gui_img_categorias, $categoria_collection);

		$render = str_replace('{img_categoria}', $gui_img_categorias, $gui);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}
	
	function traerMarcas($marca_collection) {
		$gui_img_marcas = file_get_contents("static/modules/pedido/img_marca.html");
		$gui_img_marcas = $this->render_regex_dict('BEB', $gui_img_marcas, $marca_collection);
		print $gui_img_marcas;
	}
	
	function traerComidas($comida_collection) {
		$gui_img_comida = file_get_contents("static/modules/pedido/img_comida.html");
		$gui_img_comida = $this->render_regex('COMIDA', $gui_img_comida, $comida_collection);
		print $gui_img_comida;
	}
	
	function traerPromos($promo_collection) {
		$gui_img_promo = file_get_contents("static/modules/pedido/img_promo.html");
		$gui_img_promo = $this->render_regex('PROMO', $gui_img_promo, $promo_collection);
		print $gui_img_promo;
	}

	function mostrarPedidoBebida($bebida_collection) {
		$gui_tbl_pedido_bebida = file_get_contents("static/modules/pedido/tbl_pedido_bebida.html");
		$gui_tbl_pedido_bebida = $this->render_regex_dict('PEDIDO_BEBIDA', $gui_tbl_pedido_bebida, $bebida_collection);
		print $gui_tbl_pedido_bebida;
	}
	
	function mostrarPedidoComida($comida_collection) {
		$gui_tbl_pedido_comida = file_get_contents("static/modules/pedido/tbl_pedido_comida.html");
		$gui_tbl_pedido_comida = $this->render_regex_dict('PEDIDO_COMIDA', $gui_tbl_pedido_comida, $comida_collection);
		print $gui_tbl_pedido_comida;
	}
	
	function mostrarPedidoPromo($promo_collection) {
		$gui_tbl_pedido_promo = file_get_contents("static/modules/pedido/tbl_pedido_promo.html");
		$gui_tbl_pedido_promo = $this->render_regex_dict('PEDIDO_PROMO', $gui_tbl_pedido_promo, $promo_collection);
		print $gui_tbl_pedido_promo;
	}
	
	function calcularPedido($subTotales) {
		$gui_totales = file_get_contents("static/modules/pedido/totales.html");
		$gui_totales = $this->render($subTotales, $gui_totales);
		print $gui_totales;
	}

	function editar($bebida_collection, $obj_bebida) {
		$gui = file_get_contents("static/modules/bebida/editar.html");
		$obj_bebida = $this->set_dict($obj_bebida);
		$render = $this->render_regex('TBL_BEBIDA', $gui, $bebida_collection);
		$render = $this->render($obj_bebida, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>