<?php 

// Modelo que interactua con la base de datos

class ProductosModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'productos';
	}

	public function getProducts(){

		$sql = "SELECT PrId, PrNombre, PrPrecio, PrDescripcion, PrImagen, PrCategoria, PrDescuento FROM {$this->tabla}";
		$result = $this->all($sql);
		return $result;
		
	}


	public function getProducto($id){

		$sql = "SELECT PrId, PrNombre, PrPrecio, PrDescripcion, PrImagen, PrCategoria, PrDescuento FROM {$this->tabla} WHERE PrId='{$id}' LIMIT 1";
		$result = $this->row($sql);
		return $result;

	}

	public function getProductoAgregar(){
		
		$sql = "SELECT null as PrId, null as PrNombre, null as PrPrecio, null as PrDescripcion, null as PrImagen, null as PrCategoria, null as PrDescuento FROM DUAL;";
		$result = $this->row($sql);
		return $result;

	}

	public function getListas($params){

		$lista = [];
		$listaReturn = [];

		// Valor seleccionado por el usuario
		$sql = "SELECT CaId, CaDescripcion FROM categorias JOIN productos ON PrCategoria = CaId WHERE PrId = '{$params}'";
		$rolUsuario = $this->row($sql);

		// Seleccion de valores de tabla roles
		if(isset($rolUsuario['data'])){
			$sql = "SELECT CaId, CaDescripcion FROM categorias WHERE CaId != '{$rolUsuario['data']['CaId']}' ORDER BY CaDescripcion";
		}else{
			$sql = "SELECT CaId, CaDescripcion FROM categorias ORDER BY CaDescripcion";
		}

		$roles = $this->all($sql);

		// Concatenacion
		if(isset($rolUsuario['data']) && count($rolUsuario['data']) > 0){
			$valorBD = [
				'CaId' => $rolUsuario['data']['CaId'],
				'CaDescripcion' => $rolUsuario['data']['CaDescripcion']
			];
		}else{
			$valorBD = [
				'CaId' => '',
				'CaDescripcion' => '-- Selecccione --'
			];
		}


		array_push($lista, $valorBD);
		foreach($roles['data'] as $rol){
			array_push($lista, $rol);
		}

		$listaReturn = [
			'categorias' => $lista
		];

		return $listaReturn;

	}


	public function agregarProducto(){

		$PrNombre = CleanString(VarPOST('PrNombre'));
		$PrPrecio = CleanString(VarPOST('PrPrecio'));
		$PrDescripcion = CleanString(VarPOST('PrDescripcion'));
		$PrCategoria = CleanString(VarPOST('PrCategoria'));
		$PrDescuento = CleanString(VarPOST('PrDescuento'));
		$PrImagen = CleanString(VarPOST('PrImagen'));

		$sql = "INSERT INTO {$this->tabla} (PrNombre, PrPrecio, PrDescripcion, PrCategoria, PrDescuento, PrImagen) VALUES(?, ?, ?, ?, ?, ?);";
		$data = [$PrNombre, $PrPrecio, $PrDescripcion, $PrCategoria, $PrDescuento, $PrImagen];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}


	public function eliminarProducto($id){

		$sql = "DELETE FROM {$this->tabla} WHERE PrId=?";
		$result = $this->delete($sql, [$id], $this->tabla);
		return $result;

	}



	public function editarProducto(){

		$PrId = CleanString(VarPOST('PrId'));
		$PrNombre = CleanString(VarPOST('PrNombre'));
		$PrPrecio = CleanString(VarPOST('PrPrecio'));
		$PrDescripcion = CleanString(VarPOST('PrDescripcion'));
		$PrCategoria = CleanString(VarPOST('PrCategoria'));
		$PrDescuento = CleanString(VarPOST('PrDescuento'));
		$PrImagen = CleanString(VarPOST('PrImagen'));

		$sql = "UPDATE {$this->tabla} SET PrNombre=?, PrPrecio=?, PrDescripcion=?, PrCategoria=?, PrDescuento=?, PrImagen=? WHERE PrId='{$PrId}'";
		$data = [$PrNombre, $PrPrecio, $PrDescripcion, $PrCategoria, $PrDescuento, $PrImagen];
		$result = $this->update($sql, $data, $this->tabla);

		return $result;

	}

}

?>