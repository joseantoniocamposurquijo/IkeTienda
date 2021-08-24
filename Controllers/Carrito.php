<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Carrito extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function carrito($params){
		$data = ['page' => 'carrito', 'title' => 'Carrito'];
		$this->views->getView($this, 'VerCarrito', $data);
	}

	
}

?>