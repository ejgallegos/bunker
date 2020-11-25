<?php


class CategoriaView extends View {
	
	function panel($categoria_collection) {
		$gui = file_get_contents("static/modules/categoria/panel.html");
		$gui_tbl_categoria = file_get_contents("static/modules/categoria/tbl_categoria.html");

		$gui_tbl_categoria = $this->render_regex('TBL_CATEGORIA', $gui_tbl_categoria, $categoria_collection);

		$render = str_replace('{tbl_categoria}', $gui_tbl_categoria, $gui);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($categoria_collection, $obj_categoria) {
		$gui = file_get_contents("static/modules/categoria/editar.html");
		$obj_categoria = $this->set_dict($obj_categoria);
		$render = $this->render_regex('TBL_CATEGORIA', $gui, $categoria_collection);
		$render = $this->render($obj_categoria, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>