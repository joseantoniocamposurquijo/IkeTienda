<?php 

// Modelo que interactua con la base de datos

class TarjetasModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'infotarjeta';

	}

	public function getTarjetas(){

		$sql = "SELECT ItId, ItUsuario, ItInputNumero, ItMes, ItAnio, ItInputCCV FROM {$this->tabla} JOIN usuarios ON ItUsuario = UsAlias";
		$result = $this->all($sql);
		return $result;
		
	}

}

?>