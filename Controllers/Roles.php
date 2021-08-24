<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Roles extends Controllers {

	private $diccionario;
	private $tabla;
	private $camposClave;

	public function __construct(){
		parent::__construct();
		// Metadata diccionario
		$fileDiccionario = file_get_contents("Config/Metadata/Diccionario.json");
		$this->diccionario = json_decode($fileDiccionario, true);

		$camposClave = file_get_contents("Config/Metadata/CamposClave.json");
		$this->camposClave = json_decode($camposClave, true);

		$this->tabla = 'roles';
	}

	public function roles ($params){
		$productos = new RolesModel();
		$content = $productos->getRoles();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Roles de los usuarios', 
			'icon' => 'fas fa-user-cog', 
			'description' => 'Contiene la lista de roles de los usuarios.',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave
		];
		$this->views->getView($this, $this->tabla, $data);
	}


	public function formEditar ($params){
		
		$instancia = new RolesModel();
		$content = $instancia->getRol($params);
		$listas = '';

		$data = [
			'table' => $this->tabla, 
			'title' => 'Editar rol', 
			'icon' => 'fas fa-archive', 
			'description' => 'Edite el rol',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'editar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$instancia = new RolesModel();
		$content = $instancia->getRolAgregar();
		$listas = '';

		$data = [
			'table' => $this->tabla, 
			'title' => 'Agregar inventario', 
			'icon' => 'fas fa-users', 
			'description' => 'Agregue el inventario',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'agregar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function editar ($params){

		$usuarios = new RolesModel();
		$usuarios->editarRol($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function agregar (){

		$usuarios = new RolesModel();
		$usuarios->agregarRol();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function eliminar ($params){

		$usuarios = new RolesModel();
		$result = $usuarios->eliminarRol($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	
}

?>