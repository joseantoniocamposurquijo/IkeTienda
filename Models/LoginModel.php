<?php 

// Modelo que interactua con la base de datos

class LoginModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

	public function comprobarUsuario($username, $password){
		
		$sql = "SELECT * FROM usuarios WHERE UsAlias='{$username}' AND UsPassword='{$password}';";
		$result = $this->all($sql);
		return $result;

	}



}

?>