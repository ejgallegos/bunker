<?php


class MesaView extends View {
	
	function panel($mesa_collection) {
		$gui = file_get_contents("static/modules/mesa/panel.html");

		$render = $this->render_regex('TBL_MESA', $gui, $mesa_collection);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($mesa_collection, $obj_mesa) {
		$gui = file_get_contents("static/modules/mesa/editar.html");
		$obj_mesa = $this->set_dict($obj_mesa);
		$render = $this->render_regex('TBL_MESA', $gui, $mesa_collection);
		$render = $this->render($obj_mesa, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>