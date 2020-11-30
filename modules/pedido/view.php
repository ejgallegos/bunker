<?php


class PedidoView extends View {
	
	function panel($pedido_collection) {
		$gui = file_get_contents("static/modules/pedido/panel.html");
		
		$render = $this->render_regex('TBL_PEDIDO', $gui, $pedido_collection);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}
	
	function agregar($mesa_collection, $categoria_collection, $comida_collection) {
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
	}
	
	function traerMarcas($marca_collection) {
		$gui_img_marcas = file_get_contents("static/modules/pedido/img_marca.html");
		$gui_img_marcas = $this->render_regex_dict('BEB', $gui_img_marcas, $marca_collection);
		print $gui_img_marcas;
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