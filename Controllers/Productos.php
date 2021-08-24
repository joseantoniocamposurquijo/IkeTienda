<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Productos extends Controllers{

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

		$this->tabla = 'productos';
	}

	public function productos ($params){

		$productos = new ProductosModel();
		$content = $productos->getProducts();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Productos', 
			'icon' => 'fas fa-archive', 
			'description' => 'Contiene la lista de todos los productos en venta.',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave
		];
		$this->views->getView($this, $this->tabla, $data);
		
	}


	public function formEditar ($params){
		
		$productos = new ProductosModel();
		$content = $productos->getProducto($params);
		$listas = $productos->getListas($params);

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

		$usuarios = new ProductosModel();
		$content = $usuarios->getProductoAgregar();
		$listas = $usuarios->getListas($params);

		$data = [
			'table' => $this->tabla, 
			'title' => 'Agregar producto', 
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

		$usuarios = new ProductosModel();
		$usuarios->editarProducto();
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

	public function agregar (){

		$loadFile = CargarArchivo();

		if($loadFile == 'OK'){
			$usuarios = new ProductosModel();
			$usuarios->agregarProducto();
			die(header("Location: ".APPURL.$this->tabla."/"));
		}else{
			die($loadFile);
		}		

	}

	public function eliminar ($params){

		$usuarios = new ProductosModel();
		$result = $usuarios->eliminarProducto($params);
		die(header("Location: ".APPURL.$this->tabla."/"));

	}

}

 ?>