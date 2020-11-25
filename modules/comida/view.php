<?php


class ComidaView extends View {
	
	function panel($comida_collection) {
		$gui = file_get_contents("static/modules/comida/panel.html");

		$render = $this->render_regex('TBL_COMIDA', $gui, $comida_collection);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($comida_collection, $obj_comida) {
		$gui = file_get_contents("static/modules/comida/editar.html");
		$obj_comida = $this->set_dict($obj_comida);
		$render = $this->render_regex('TBL_COMIDA', $gui, $comida_collection);
		$render = $this->render($obj_comida, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>