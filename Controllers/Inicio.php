<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

require_once 'Views/Carrito.php';

class Inicio extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function inicio ($params){

		$data = ['page' => 'home', 'title' => 'Home'];
		$this->views->getView($this, 'inicio', $data);
	
	}

	
}

?>