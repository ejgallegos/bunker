<?php


class MarcaView extends View {
	
	function panel($marca_collection) {
		$gui = file_get_contents("static/modules/marca/panel.html");
		$gui_tbl_marca = file_get_contents("static/modules/marca/tbl_marca.html");

		$gui_tbl_marca = $this->render_regex('TBL_MARCA', $gui_tbl_marca, $marca_collection);

		$render = str_replace('{tbl_marca}', $gui_tbl_marca, $gui);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($marca_collection, $obj_marca) {
		$gui = file_get_contents("static/modules/marca/editar.html");
		$obj_marca = $this->set_dict($obj_marca);
		$render = $this->render_regex('TBL_MARCA', $gui, $marca_collection);
		$render = $this->render($obj_marca, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>