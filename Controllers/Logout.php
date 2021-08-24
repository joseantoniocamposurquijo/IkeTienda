<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Este es un controlador sencillo del sistema de login
*/

class Logout extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function logout ($params){

		// Destruye la sesión
		@session_start();
		session_unset();
		session_destroy();

		die(header("Location: ".APPURL."Home/"));

	}

	
}

?>