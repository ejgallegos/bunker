<?php


class ComidaView extends View {
	
	function panel($comida_collection, $categoria_collection) {
		$gui = file_get_contents("static/modules/comida/panel.html");
		$gui_slt_categoria = file_get_contents("static/modules/comida/slt_categoria.html");
		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$render = $this->render_regex('TBL_COMIDA', $gui, $comida_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($comida_collection, $obj_comida, $categoria_collection) {
		$gui = file_get_contents("static/modules/comida/editar.html");
		$gui_slt_categoria = file_get_contents("static/modules/comida/slt_categoria.html");
		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$obj_comida = $this->set_dict($obj_comida);
		$render = $this->render_regex('TBL_COMIDA', $gui, $comida_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = $this->render($obj_comida, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>