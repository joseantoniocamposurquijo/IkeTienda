<?php 

// Modelo que interactua con la base de datos

class RolesModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'roles';

	}

	public function getRoles(){
		
		$sql = "SELECT * FROM {$this->tabla}";
		$result = $this->all($sql);
		return $result;

	}


	public function getRol($id){

		$sql = "SELECT RoId, RoDescription FROM {$this->tabla} WHERE RoId='{$id}' LIMIT 1";
		$result = $this->row($sql);
		return $result;

	}

	public function getRolAgregar(){
		
		$sql = "SELECT null as RoId, null as RoDescription FROM DUAL;";
		$result = $this->row($sql);
		return $result;

	}


	public function agregarRol(){

		$RoId = CleanString(VarPOST('RoId'));
		$RoDescription = CleanString(VarPOST('RoDescription'));

		$sql = "INSERT INTO {$this->tabla} (RoId, RoDescription) VALUES(?, ?);";
		$data = [$RoId, $RoDescription];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}

	public function eliminarRol($id){

		$sql = "DELETE FROM {$this->tabla} WHERE RoId=?";
		$result = $this->delete($sql, [$id], $this->tabla);
		return $result;

	}

	public function editarRol($id){

		$RoId = CleanString(VarPOST('RoId'));
		$RoDescription = CleanString(VarPOST('RoDescription'));

		$sql = "UPDATE {$this->tabla} SET RoDescription=? WHERE RoId = '{$RoId}'";
		$data = [$RoDescription];
		$result = $this->update($sql, $data, $this->tabla);

		return $result;

	}

}

?>