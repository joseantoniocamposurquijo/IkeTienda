<?php 

// Modelo que interactua con la base de datos

class UsuariosModel extends Mysql {

	private $tabla;

	public function __construct(){

		parent::__construct();
		$this->tabla = 'usuarios';

	}

	public function getUsuarios(){
		
		$sql = "SELECT UsAlias, UsRol, UsNombres, UsApellidos, UsCorreo, UsPassword, UsDireccion, UsTelefono FROM {$this->tabla} JOIN roles ON RoId = UsRol";
		$result = $this->all($sql);
		return $result;

	}


	public function getUsuario($id){
		
		$sql = "SELECT UsAlias, UsRol, UsNombres, UsApellidos, UsCorreo, UsPassword, UsDireccion, UsTelefono FROM {$this->tabla} JOIN roles ON RoId = UsRol WHERE UsAlias='{$id}' LIMIT 1";
		$result = $this->row($sql);
		return $result;

	}


	public function getListas($params){

		$lista = [];
		$listaReturn = [];

		// Valor seleccionado por el usuario
		$sql = "SELECT RoId, RoDescription FROM roles JOIN {$this->tabla} ON UsRol = RoId WHERE UsAlias = '{$params}'";
		$rolUsuario = $this->row($sql);

		// Seleccion de valores de tabla roles
		if(isset($rolUsuario['data'])){
			$sql = "SELECT RoId, RoDescription FROM roles WHERE RoId != '{$rolUsuario['data']['RoId']}' ORDER BY RoDescription";
		}else{
			$sql = "SELECT RoId, RoDescription FROM roles ORDER BY RoDescription";
		}		
		$roles = $this->all($sql);

		// Concatenacion
		if(isset($rolUsuario['data']) && count($rolUsuario['data']) > 0){
			$valorBD = [
				'RoId' => $rolUsuario['data']['RoId'],
				'RoDescription' => $rolUsuario['data']['RoDescription']
			];
		}else{
			$valorBD = [
				'RoId' => '',
				'RoDescription' => '-- Selecccione --'
			];
		}


		array_push($lista, $valorBD);
		foreach($roles['data'] as $rol){
			array_push($lista, $rol);
		}

		$listaReturn = [
			'roles' => $lista
		];

		return $listaReturn;

	}

	public function getUsuarioAgregar(){
		
		$sql = "SELECT null as UsAlias, null as UsRol, null as UsNombres, null as UsApellidos, null as UsCorreo, null as UsPassword, null as UsDireccion, null as UsTelefono FROM DUAL;";
		$result = $this->row($sql);
		return $result;

	}

	public function editarUsuario(){

		$UsAlias = CleanString(VarPOST('UsAlias'));
		$UsRol = CleanString(VarPOST('UsRol'));
		$UsNombres = CleanString(VarPOST('UsNombres'));
		$UsApellidos = CleanString(VarPOST('UsApellidos'));
		$UsCorreo = CleanString(VarPOST('UsCorreo'));
		$UsPassword = CleanString(VarPOST('UsPassword'));
		$UsTelefono = CleanString(VarPOST('UsTelefono'));
		$UsDireccion = CleanString(VarPOST('UsDireccion'));

		$UsPassword = Encrypt($UsPassword);

		$sql = "UPDATE {$this->tabla} SET UsRol=?, UsNombres=?, UsApellidos=?, UsCorreo=?, UsPassword=?, UsDireccion=?, UsTelefono=? WHERE UsAlias='{$UsAlias}'";
		$data = [$UsRol, $UsNombres, $UsApellidos, $UsCorreo, $UsPassword, $UsDireccion, $UsTelefono];
		$result = $this->update($sql, $data, $this->tabla);

		return $result;

	}


	public function agregarUsuario(){

		$UsAlias = CleanString(VarPOST('UsAlias'));
		$UsRol = CleanString(VarPOST('UsRol'));
		$UsNombres = CleanString(VarPOST('UsNombres'));
		$UsApellidos = CleanString(VarPOST('UsApellidos'));
		$UsCorreo = CleanString(VarPOST('UsCorreo'));
		$UsPassword = CleanString(VarPOST('UsPassword'));
		$UsDireccion = CleanString(VarPOST('UsDireccion'));
		$UsTelefono = CleanString(VarPOST('UsTelefono'));

		$UsPassword = Encrypt($UsPassword);

		$sql = "INSERT INTO {$this->tabla} (UsAlias, UsRol, UsNombres, UsApellidos, UsCorreo, UsPassword, UsDireccion, UsTelefono) VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
		$data = [$UsAlias, $UsRol, $UsNombres, $UsApellidos, $UsCorreo, $UsPassword, $UsDireccion, $UsTelefono];
		$result = $this->insert($sql, $data, $this->tabla);

		return $result;

	}


	public function eliminarUsuario($id){

		$sql = "DELETE FROM {$this->tabla} WHERE UsAlias=?";
		$result = $this->delete($sql, [$id], $this->tabla);
		return $result;

	}



}

?>