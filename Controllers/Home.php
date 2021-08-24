<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

class Home extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function home ($params){

		$instancia = new HomeModel();
		$productos = $instancia->getProducts();
		$categorias = $instancia->getCategories();

		$data = [
			'page' => 'home', 
			'title' => 'Home', 
			'content' => $productos,
			'categorias' => $categorias
		];

		$this->views->getView($this, 'home', $data);
		
	}

	public function CategoriaFiltrada($params){

		$instancia = new HomeModel();
		$productos = $instancia->getProductsByCategory($params);
		$categorias = null;

		$data = [
			'page' => 'home', 
			'title' => 'Home', 
			'content' => $productos,
			'categorias' => $categorias
		];

		$this->views->getView($this, 'home', $data);

	}

	
}

?>