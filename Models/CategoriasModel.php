<?php 

// Modelo que interactua con la base de datos

class CategoriasModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'categorias';
		
	}

	public function getCategorias(){
		
		$sql = "SELECT * FROM {$this->tabla}";
		$result = $this->all($sql);
		return $result;
		
	}

	public function getCategoria($id){

		$sql = "SELECT CaId, CaDescripcion FROM {$this->tabla} WHERE CaId='{$id}' LIMIT 1";
		$result = $this->row($sql);
		return $result;

	}

	public function getCategoriaAgregar(){
		
		$sql = "SELECT null as CaId, null as CaDescripcion FROM DUAL;";
		$result = $this->row($sql);
		return $result;

	}


	public function agregarCategoria(){

		$CaId = CleanString(VarPOST('CaId'));
		$CaDescripcion = CleanString(VarPOST('CaDescripcion'));

		$sql = "INSERT INTO {$this->tabla} (CaId, CaDescripcion, created_at) VALUES(?, ?, ?);";
		$data = [$CaId, $CaDescripcion, date('Y-m-d H:i:s')];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}

	public function eliminarCategoria($id){

		$sql = "DELETE FROM {$this->tabla} WHERE CaId=?";
		$result = $this->delete($sql, [$id], $this->tabla);
		return $result;

	}


	public function editarCategoria(){

		$CaId = CleanString(VarPOST('CaId'));
		$CaDescripcion = CleanString(VarPOST('CaDescripcion'));

		$sql = "UPDATE {$this->tabla} SET CaId=?, CaDescripcion=? WHERE CaId='{$CaId}'";
		$data = [$CaId, $CaDescripcion];
		$result = $this->update($sql, $data, $this->tabla);

		return $result;

	}

}

?>