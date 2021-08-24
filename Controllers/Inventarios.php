<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Inventarios extends Controllers {

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

		$this->tabla = 'inventarios';
	}

	public function inventarios ($params){
		$productos = new InventariosModel();
		$content = $productos->getInventarios();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Inventarios', 
			'icon' => 'fas fa-boxes', 
			'description' => 'Contiene la lista de existencias por producto.',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave
		];
		$this->views->getView($this, $this->tabla, $data);
	}


	public function formEditar ($params){
		
		$instancia = new InventariosModel();
		$content = $instancia->getInventario($params);
		$listas = $instancia->getListas($params);

		$data = [
			'table' => $this->tabla, 
			'title' => 'Editar inventario', 
			'icon' => 'fas fa-archive', 
			'description' => 'Edite el inventario',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'editar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$instancia = new InventariosModel();
		$content = $instancia->getInventarioAgregar();
		$listas = $instancia->getListas($params);

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

	public function editar (){

		$usuarios = new InventariosModel();
		$usuarios->editarInventario();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function agregar (){

		$usuarios = new InventariosModel();
		$usuarios->agregarInventario();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function eliminar ($params){

		$usuarios = new InventariosModel();
		$result = $usuarios->eliminarInventario($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	
}

?>