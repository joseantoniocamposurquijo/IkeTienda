<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Este es un controlador sencillo del sistema de login
*/

class Login extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function login ($params){

		$usuario = new LoginModel();
		$result = $usuario->comprobarUsuario($_POST['username'], Encrypt($_POST['password']));

		if($result['rowCount'] == 0){
			die('Usuario y contrasenia invalidos');
		}

		// Inicia la sesion
		session_start();
		$_SESSION['UserSession'] = [
			'UsAlias' => $result['data'][0]['UsAlias'],
			'UsNombres' => $result['data'][0]['UsNombres'],
			'UsApellidos' => $result['data'][0]['UsApellidos'],
			'UsCorreo' => $result['data'][0]['UsCorreo'],
			'UsRol' => $result['data'][0]['UsRol']
		];

		// Redireccionamiento
		if($result['data'][0]['UsRol'] == 'Ad'){
			die(header("Location: ".APPURL."Inicio/"));
		}else{
			die(header("Location: ".APPURL."Home/"));
		}

	}
	
}

?>