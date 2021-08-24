<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Pedidos extends Controllers {

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

		$this->tabla = 'pedidos';

	}

	public function pedidos ($params){
		$productos = new PedidosModel();
		$content = $productos->getPedidos();
		$data = [
			'table' => $this->tabla, 
			'title' => 'Pedidos de clientes', 
			'icon' => 'fas fa-truck-loading', 
			'description' => 'Contiene la lista de los pedidos que han hecho los clientes.',
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