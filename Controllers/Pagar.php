<?php 

/**
 * @author Jose Antonio Campos Urquijo
 * Controlador principal del proyecto
*/

@session_start();
// require_once 'Views/Carrito.php';
require_once 'Models/UsuariosModel.php';




class Pagar extends Controllers {

	public function __construct(){
		parent::__construct();
	}

	public function pagar ($params){

		// Se establece que no exista sesion y que el usuario deba registrarse
		if(
			!isset($_SESSION['UserSession']) && 
			isset($_POST['btnAccion']) && 
			$_POST['btnAccion'] == 'verifica'
		){
			die(header("Location: ".APPURL."Carrito/Carrito/RegistrarUsuario"));
		}


		// Ya existe una sesion activa
		if(isset($_SESSION['UserSession']['UsAlias'])){

			$user = $_SESSION['UserSession']['UsAlias'];
			
		}else{

			// Registro del usuario
			$usuarios = new UsuariosModel();
			$_POST['UsRol'] = 'Us';
			$usuarios->agregarUsuario();
			$user = CleanString(VarPOST('UsAlias'));
			$UsNombres = CleanString(VarPOST('UsNombres'));
			$UsApellidos = CleanString(VarPOST('UsApellidos'));
			$UsCorreo = CleanString(VarPOST('UsCorreo'));


			// Inicia la sesion
			@session_start();
			$_SESSION['UserSession'] = [
				'UsAlias' => $user,
				'UsNombres' => $UsNombres,
				'UsApellidos' => $UsApellidos,
				'UsCorreo' => $UsCorreo,
				'UsRol' => 'Us'
			];

		}
		

		// Registro de la venta
		$totalVenta = 0;

		if($_POST){	
			foreach ($_SESSION['carrito'] as $indice => $producto) {
				$totalVenta = $totalVenta + ($producto['precio'] * $producto['cantidad'] * (1 - $producto['descuento'] / 100));
			}
		}
		
		$SID = session_id();
		$ventas = new PagarModel();
		$ventas->registrarVenta($SID, $user, $totalVenta);
		$idVenta = $ventas->getVentaId();


		// registro de los pedidos
		foreach ($_SESSION['carrito'] as $indice => $producto) {
			$pedido = $ventas->registrarPedidos($idVenta, $producto);
		}

		$data = ['page' => 'pagar', 'title' => 'pagar', 'total' => $totalVenta, 'idventa' => $idVenta];
		$this->views->getView($this, 'pagar', $data);

	}


	public function procesarPago (){

		$ventas = new PagarModel();

		$ItUsuario = isset($_SESSION['UserSession']['UsAlias']) ? $_SESSION['UserSession']['UsAlias'] : 'admin';
		$ItInputNumero = CleanString(VarPOST('inputNumero'));
		$ItMes = CleanString(VarPOST('mes'));
		$ItAnio = CleanString(VarPOST('year'));
		$ItInputCCV = CleanString(VarPOST('inputCCV'));
		$total = CleanString(VarPOST('total'));
		$idventa = CleanString(VarPOST('idventa'));

		$ventas->registrarDatosTarjeta($ItUsuario, $ItInputNumero, $ItMes, $ItAnio, $ItInputCCV);
		$tarjetaId = $ventas->getTarjetaId();
		$ventas->registrarPago($idventa, $tarjetaId);

		// Descontar de inventario
		foreach ($_SESSION['carrito'] as $indice => $producto) {
			$pedido = $ventas->descontarInventario($producto['id']);
			$this->descontarCarrito($indice);
		}


		$data = ['page' => 'pagar', 'title' => 'pagar', 'total' => $total];
		$this->views->getView($this, 'pagoTC', $data);

	}


	private function descontarCarrito($key){
		
		unset($_SESSION['carrito'][$key]);
		
	}

	
}

?>