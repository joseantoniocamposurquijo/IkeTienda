<?php 

// Modelo que interactua con la base de datos

class PedidosModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'pedidos';

	}

	public function getPedidos(){
		
		$sql = "SELECT PeId, PdVentaId, PeProductoId, PePrecioUnitario, PeCantidad FROM {$this->tabla}";
		$result = $this->all($sql);
		return $result;

	}

}

?>