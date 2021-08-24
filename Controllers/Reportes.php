<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Reportes extends Controllers {

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

		$this->tabla = 'reportes';
	}

	public function reportes ($params){

		$reportes = new ReportesModel();
		$content = [
			'ventas' => $reportes->getCountVentas(),
			'usuarios' => $reportes->getCountUsuarios(),
			'pedidos' => $reportes->getCountPedidos(),
			'productos' => $reportes->getCountProductos()
		];
		$productosVendidos = $reportes->getProductosVendidos();

		$data = [
			'table' => $this->tabla, 
			'title' => 'Logs de base de datos', 
			'icon' => 'fas fa-chart-line', 
			'description' => 'Zona de reportes',
			'content' => $content,
			'diccionario' => $this->diccionario,
			'camposClave' => $this->camposClave,
			'vendidos' => $productosVendidos
		];
		$this->views->getView($this, $this->tabla, $data);

	}

}

?>