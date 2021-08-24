<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Logs extends Controllers {

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

		$this->tabla = 'logs';
	}

	public function logs ($params){

		$usuarios = new LogsModel();
		$content = $usuarios->getLogs();

		$data = [
			'table' => $this->tabla, 
			'title' => 'Logs de base de datos', 
			'icon' => 'fas fa-search', 
			'description' => 'Contiene los logs de consultas SQL tipo (insert, update y delete) que ejecutan los usuarios.',
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