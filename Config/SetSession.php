<?php 

@session_start();

if(!isset($_SESSION['UserSession']['UsRol'])){

	// Destruye la sesión
	@session_start();
	session_unset();
	session_destroy();

	die(header("Location: ".APPURL."Home/"));

}


?>