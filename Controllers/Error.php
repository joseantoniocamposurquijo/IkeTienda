<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador para mostrar errores de rutas
*/

class Errors extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function notFound (){
		$this->views->getView($this, 'error');
	}

}

// Instancio la clase para mostrar el error
$notFound = new Errors();
$notFound->notFound();

?>