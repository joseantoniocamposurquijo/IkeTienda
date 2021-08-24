<?php 

// Modelo que interactua con la base de datos

class LogsModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

	public function getLogs(){

		$sql = "SELECT * FROM logs";
		$result = $this->all($sql);
		return $result;
		
	}

}

?>