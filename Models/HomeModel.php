<?php 

// Modelo que interactua con la base de datos

class HomeModel extends Mysql {

	public function __construct(){
		parent::__construct();
	}

	public function getProducts(){

		$sql = "SELECT * FROM productos JOIN inventarios ON InProductoId=PrId";
		$result = $this->all($sql);
		return $result;

	}


	public function getProductsByCategory($params){

		$sql = "SELECT * FROM productos JOIN inventarios ON InProductoId=PrId WHERE PrCategoria = '{$params}'";
		$result = $this->all($sql);
		return $result;

	}

	public function getCategories(){

		$sql = "SELECT CaId, CaDescripcion, CaIcono FROM categorias";
		$result = $this->all($sql);
		return $result;

	}

}

?>