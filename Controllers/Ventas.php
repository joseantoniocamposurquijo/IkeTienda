<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Ventas extends Controllers {

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

		$this->tabla = 'ventas';

	}

	public function ventas ($params){
		$productos = new VentasModel();
		$content = $productos->getVentas();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Ventas', 
			'icon' => 'fas fa-tags', 
			'description' => 'Listado de ventas.',
			'content' => $content,
			'diccionario' => $this->diccionario
		];
		$this->views->getView($this, $this->tabla, $data);
	}


	public function formEditar ($params){
		
		$data = ['table' => $this->tabla];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$data = ['table' => $this->tabla];
		$this->views->getView($this, 'Form', $data);

	}

	
}

?>