<?php 

// Modelo que interactua con la base de datos

class PagarModel extends Mysql {

	public function __construct(){

		parent::__construct();
		
	}


	public function registrarVenta($SID, $user, $total){

		$sql = "INSERT INTO ventas (VeClaveTransaccion, VePago, VeFecha, VeUsuario, VeTotal, VeStatus, created_at) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$data = [$SID, 1, date('Y-m-d H:i:s'), $user, $total, 'Pendiente', date('Y-m-d H:i:s')];
		$result = $this->insert($sql, $data, 'ventas');

	}

	public function getVentaId(){

		$sql = "SELECT max(VeId) FROM ventas";
		$result = $this->value($sql);
		return $result;

	}


	public function registrarPedidos($idVenta, $producto){

		$sql = "INSERT INTO pedidos (PdVentaId, PeProductoId, PePrecioUnitario, PeCantidad, PeDescargado, created_at) VALUES (?, ?, ?, ?, ?, ?);";
		$data = [$idVenta, $producto['id'], $producto['precio'], $producto['cantidad'], '', date('Y-m-d H:i:s')];
		$result = $this->insert($sql, $data, 'pedidos');
		
	}


	public function registrarDatosTarjeta($ItUsuario, $ItInputNumero, $ItMes, $ItAnio, $ItInputCCV){

		$sql = "INSERT INTO infotarjeta (ItUsuario, ItInputNumero, ItMes, ItAnio, ItInputCCV, created_at) VALUES (?, ?, ?, ?, ?, ?);";
		$data = [$ItUsuario, $ItInputNumero, $ItMes, $ItAnio, $ItInputCCV, date('Y-m-d H:i:s')];
		$result = $this->insert($sql, $data, 'infotarjeta');

	}


	public function getTarjetaId(){

		$sql = "SELECT max(ItId) FROM infotarjeta";
		$result = $this->value($sql);
		return $result;

	}

	public function registrarPago($idventa, $tarjetaId){

		$sql = "UPDATE ventas SET VePago=?, VeFecha=? WHERE VeId = {$idventa}";
		$data = [$tarjetaId, date('Y-m-d H:i:s')];
		$result = $this->update($sql, $data, 'ventas');

	}


	public function descontarInventario($productoId){

		$sql = "SELECT InCantidad FROM inventarios WHERE InProductoId = '{$productoId}'";
		$result = $this->value($sql);
		$cantidad = $result - 1;

		$sql = "UPDATE inventarios SET InCantidad=? WHERE InProductoId = '{$productoId}'";;
		$result = $this->update($sql, [$cantidad], 'inventarios');

	}

}

?>