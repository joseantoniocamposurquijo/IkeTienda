<?php 

// Modelo que interactua con la base de datos

class InventariosModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'inventarios';

	}

	public function getInventarios(){

		$sql = "SELECT InId, PrNombre, InCantidad FROM {$this->tabla} JOIN productos ON InProductoId = PrId";
		$result = $this->all($sql);
		return $result;
		
	}


	public function getInventario($id){

		$sql = "SELECT InId, InProductoId, InCantidad FROM {$this->tabla} WHERE InId='{$id}' LIMIT 1";
		$result = $this->row($sql);
		return $result;

	}

	public function getInventarioAgregar(){
		
		$sql = "SELECT null as InId, null as InProductoId, null as InCantidad FROM DUAL;";
		$result = $this->row($sql);
		return $result;

	}


	public function agregarInventario(){

		$InProductoId = CleanString(VarPOST('InProductoId'));
		$InCantidad = CleanString(VarPOST('InCantidad'));

		$sql = "INSERT INTO {$this->tabla} (InProductoId, InCantidad) VALUES(?, ?);";
		$data = [$InProductoId, $InCantidad];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}

	public function eliminarInventario($id){

		$sql = "DELETE FROM {$this->tabla} WHERE InId=?";
		$result = $this->delete($sql, [$id], $this->tabla);
		return $result;

	}
	

	public function getListas($params){

		$lista = [];
		$listaReturn = [];

		// Valor seleccionado por el usuario
		$sql = "SELECT PrId, PrNombre FROM productos JOIN inventarios ON PrId = InProductoId WHERE InId = '{$params}'";
		$rolUsuario = $this->row($sql);

		// Seleccion de valores de tabla roles
		if(isset($rolUsuario['data'])){
			$sql = "SELECT PrId, PrNombre FROM productos WHERE PrId != '{$rolUsuario['data']['PrId']}' ORDER BY PrNombre";
		}else{
			$sql = "SELECT PrId, PrNombre FROM productos ORDER BY PrNombre";
		}

		$roles = $this->all($sql);

		// Concatenacion
		if(isset($rolUsuario['data']) && count($rolUsuario['data']) > 0){
			$valorBD = [
				'PrId' => $rolUsuario['data']['PrId'],
				'PrNombre' => $rolUsuario['data']['PrNombre']
			];
		}else{
			$valorBD = [
				'PrId' => '',
				'PrNombre' => '-- Selecccione --'
			];
		}


		array_push($lista, $valorBD);
		foreach($roles['data'] as $rol){
			array_push($lista, $rol);
		}

		$listaReturn = [
			'productos' => $lista
		];

		return $listaReturn;

	}


	public function editarInventario(){

		$InId = CleanString(VarPOST('InId'));
		$InProductoId = CleanString(VarPOST('InProductoId'));
		$InCantidad = CleanString(VarPOST('InCantidad'));

		$sql = "UPDATE {$this->tabla} SET InProductoId=?, InCantidad=? WHERE InId='{$InId}'";
		$data = [$InProductoId, $InCantidad];
		$result = $this->update($sql, $data, $this->tabla);

		return $result;

	}

}

?>