<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Usuarios extends Controllers {

	private $diccionario;
	private $camposClave;
	private $tabla;

	public function __construct(){
		parent::__construct();
		
		// Metadata diccionario
		$fileDiccionario = file_get_contents("Config/Metadata/Diccionario.json");
		$this->diccionario = json_decode($fileDiccionario, true);

		$camposClave = file_get_contents("Config/Metadata/CamposClave.json");
		$this->camposClave = json_decode($camposClave, true);

		$this->tabla = 'usuarios';

	}

	public function usuarios ($params){

		$usuarios = new UsuariosModel();
		$content = $usuarios->getUsuarios();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Usuarios del sistema', 
			'icon' => 'fas fa-users', 
			'description' => 'Contiene la lista de todos los usuarios del sistema.',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave
		];
		$this->views->getView($this, $this->tabla, $data);

	}


	public function formEditar ($params){
		
		$usuarios = new UsuariosModel();
		$content = $usuarios->getUsuario($params);
		$listas = $usuarios->getListas($params);
		$data = [
			'table' => $this->tabla, 
			'title' => 'Editar usuario', 
			'icon' => 'fas fa-users', 
			'description' => 'Edite el usuario',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'editar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$usuarios = new UsuariosModel();
		$content = $usuarios->getUsuarioAgregar();
		$listas = $usuarios->getListas($params);
		$data = [
			'table' => $this->tabla, 
			'title' => 'Agregar usuario', 
			'icon' => 'fas fa-users', 
			'description' => 'Agregue el usuario',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'agregar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function editar (){

		$usuarios = new UsuariosModel();
		$usuarios->editarUsuario();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function agregar (){

		$usuarios = new UsuariosModel();
		$usuarios->agregarUsuario();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function eliminar ($params){

		$usuarios = new UsuariosModel();
		$result = $usuarios->eliminarUsuario($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	
}

?>