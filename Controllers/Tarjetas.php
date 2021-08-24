<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Tarjetas extends Controllers {

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

		$this->tabla = 'infotarjeta';

	}

	public function tarjetas ($params){
		$productos = new TarjetasModel();
		$content = $productos->getTarjetas();
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
		
		$data = ['table' => $this->tabla];
		$this->views->getView($this, 'Form', $data);

	}

	public function formAgregar ($params){

		$data = ['table' => $this->tabla];
		$this->views->getView($this, 'Form', $data);

	}

	
}

?>