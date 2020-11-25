<?php


class BebidaView extends View {
	
	function panel($bebida_collection, $categoria_collection, $marca_collection) {
		$gui = file_get_contents("static/modules/bebida/panel.html");
		$gui_slt_categoria = file_get_contents("static/modules/bebida/slt_categoria.html");
		$gui_slt_marca = file_get_contents("static/modules/bebida/slt_marca.html");
		
		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$gui_slt_marca = $this->render_regex('SLT_MARCA', $gui_slt_marca, $marca_collection);
		
		$render = $this->render_regex('TBL_BEBIDA', $gui, $bebida_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = str_replace('{slt_marca}', $gui_slt_marca, $render);
		
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}
	
	function editar($bebida_collection, $obj_bebida, $categoria_collection, $marca_collection) {
		$gui = file_get_contents("static/modules/bebida/editar.html");
		$gui_slt_categoria = file_get_contents("static/modules/bebida/slt_categoria.html");
		$gui_slt_marca = file_get_contents("static/modules/bebida/slt_marca.html");

		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$gui_slt_marca = $this->render_regex('SLT_MARCA', $gui_slt_marca, $marca_collection);

		$obj_bebida = $this->set_dict($obj_bebida);
		$render = $this->render_regex('TBL_BEBIDA', $gui, $bebida_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = str_replace('{slt_marca}', $gui_slt_marca, $render);
		$render = $this->render($obj_bebida, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>