<?php 

// Modelo que interactua con la base de datos

class VentasModel extends Mysql {

	public function __construct(){

		parent::__construct();
		$this->tabla = 'ventas';

	}

	public function getVentas(){
		
		$sql = "SELECT * FROM ventas";
		$result = $this->all($sql);
		return $result;
		
	}



	public function agregarVenta(){

		$VeUsuario = CleanString(VarPOST('VeUsuario'));
		$VeClaveTransaccion = CleanString(VarPOST('VeClaveTransaccion'));
		$VePago = CleanString(VarPOST('VePago'));
		$VeFecha = CleanString(VarPOST('VeFecha'));
		$VeTotal = CleanString(VarPOST('VeTotal'));
		$VeTotal = CleanString(VarPOST('VeTotal'));
		$VeStatus = CleanString(VarPOST('VeStatus'));

		$sql = "INSERT INTO {$this->tabla} (VeUsuario, VeClaveTransaccion, VePago, VeFecha, VeTotal, VeStatus, created_at) VALUES(?, ?, ?, ?, ?, ?, ?);";
		$data = [$VeUsuario, $VeClaveTransaccion, $VePago, $VeFecha, $VeTotal, $VeTotal, $VeStatus, date('Y-m-d H:i:s')];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}

}

?>