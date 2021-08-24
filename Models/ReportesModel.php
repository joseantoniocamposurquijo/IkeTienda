<?php 

// Modelo que interactua con la base de datos

class ReportesModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

	public function getCountVentas(){

		$sql = "SELECT count(1) FROM ventas";
		$result = $this->value($sql);
		return $result;
		
	}

	public function getCountUsuarios(){

		$sql = "SELECT count(1) FROM usuarios";
		$result = $this->value($sql);
		return $result;
		
	}

	public function getCountPedidos(){

		$sql = "SELECT count(1) FROM pedidos";
		$result = $this->value($sql);
		return $result;
		
	}

	public function getCountProductos(){

		$sql = "SELECT count(1) FROM productos";
		$result = $this->value($sql);
		return $result;
		
	}


	public function getProductosVendidos(){

		$sql = "SELECT PrNombre, PrPrecio, PrDescuento FROM productos JOIN pedidos ON PeProductoId=PrId";
		$result = $this->all($sql);
		return $result;

	}

}

?>