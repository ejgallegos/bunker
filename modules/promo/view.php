<?php


class PromoView extends View {
	
	function panel($promo_collection, $categoria_collection) {
		$gui = file_get_contents("static/modules/promo/panel.html");
		$gui_slt_categoria = file_get_contents("static/modules/promo/slt_categoria.html");
		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$render = $this->render_regex('TBL_PROMO', $gui, $promo_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;
	}

	function editar($promo_collection, $obj_promo, $categoria_collection) {
		$gui = file_get_contents("static/modules/promo/editar.html");
		$gui_slt_categoria = file_get_contents("static/modules/promo/slt_categoria.html");
		$gui_slt_categoria = $this->render_regex('SLT_CATEGORIA', $gui_slt_categoria, $categoria_collection);
		$obj_promo = $this->set_dict($obj_promo);
		$render = $this->render_regex('TBL_PROMO', $gui, $promo_collection);
		$render = str_replace('{slt_categoria}', $gui_slt_categoria, $render);
		$render = $this->render($obj_promo, $render);
		$render = $this->render_breadcrumb($render);
		$template = $this->render_template($render);
		print $template;	
	}
}
?>