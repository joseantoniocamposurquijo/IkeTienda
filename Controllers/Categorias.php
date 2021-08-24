<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Categorias extends Controllers {

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

		$this->tabla = 'categorias';
	}

	public function categorias ($params){
		$productos = new CategoriasModel();
		$content = $productos->getCategorias();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Categorias', 
			'icon' => 'fas fa-sitemap', 
			'description' => 'Contiene la lista de categorias en que se clasifican los productos.',
			'content' => $content, 
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave
		];
		$this->views->getView($this, $this->tabla, $data);
	}

	public function formEditar ($params){
		
		$productos = new CategoriasModel();
		$content = $productos->getCategoria($params);
		$listas = '';

		$data = [
			'table' => $this->tabla, 
			'title' => 'Editar producto', 
			'icon' => 'fas fa-archive', 
			'description' => 'Edite el producto',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'editar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$usuarios = new CategoriasModel();
		$content = $usuarios->getCategoriaAgregar();
		$listas = '';

		$data = [
			'table' => $this->tabla, 
			'title' => 'Agregar categoria', 
			'icon' => 'fas fa-users', 
			'description' => 'Agregue el producto',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'accion' => 'agregar',
			'listas' => $listas
		];
		$this->views->getView($this, 'Form', $data);

	}

	public function editar (){

		$usuarios = new CategoriasModel();
		$usuarios->editarCategoria();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function agregar (){

		$usuarios = new CategoriasModel();
		$usuarios->agregarCategoria();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function eliminar ($params){

		$usuarios = new CategoriasModel();
		$result = $usuarios->eliminarCategoria($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}
	
}

?>