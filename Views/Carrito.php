<?php

session_start();

$mensaje = '';

if(isset($_POST['btnAccion'])){
	switch ($_POST['btnAccion']) {
		case 'Agregar':

			
			if(is_numeric(openssl_decrypt($_POST['id'], METHOD, KEY))){
				$id = openssl_decrypt($_POST['id'], METHOD, KEY);
				$mensaje .= 'id correcto: '.$id;
			}else{
				$mensaje .= '¡Opss!, id incorrecto: ';
				break;
			}

			if(is_numeric(openssl_decrypt($_POST['descuento'], METHOD, KEY))){
				$descuento = openssl_decrypt($_POST['descuento'], METHOD, KEY);
				$mensaje .= 'descuento correcto: '.$descuento;
			}else{
				$mensaje .= '¡Opss!, descuento incorrecto: ';
				break;
			}

			if(is_string(openssl_decrypt($_POST['nombre'], METHOD, KEY))){
				$nombre = openssl_decrypt($_POST['nombre'], METHOD, KEY);
				$mensaje .= ' nombre correcto: '.$nombre;
			}else{
				$mensaje .= '¡Opss!, nombre incorrecto: ';
				break;
			}

			if(is_numeric(openssl_decrypt($_POST['precio'], METHOD, KEY))){
				$precio = openssl_decrypt($_POST['precio'], METHOD, KEY);
				$mensaje .= ' precio correcto: '.$precio;
			}else{
				$mensaje .= '¡Opss!, precio incorrecto: ';
				break;
			}

			if(is_numeric(openssl_decrypt($_POST['cantidad'], METHOD, KEY))){
				$cantidad = openssl_decrypt($_POST['cantidad'], METHOD, KEY);
				$mensaje .= ' cantidad correcta: '.$cantidad;
			}else{
				$mensaje .= '¡Opss!, cantidad incorrecta: ';
				break;
			}

			if(is_string(openssl_decrypt($_POST['imagen'], METHOD, KEY))){
				$imagen = openssl_decrypt($_POST['imagen'], METHOD, KEY);
				$mensaje .= ' imagen correcta: '.$imagen;
			}else{
				$mensaje .= '¡Opss!, imagen incorrecta: ';
				break;
			}



			if(!isset($_SESSION['carrito'])){
				$producto = [
					'id' => $id,
					'nombre' => $nombre,
					'precio' => $precio,
					'cantidad' => $cantidad,
					'descuento' => $descuento,
					'imagen' => $imagen
				];
				$_SESSION['carrito'][0] = $producto;
			}else{
				$idProductos = array_column($_SESSION['carrito'], 'id');
				if(in_array($id, $idProductos)){
					// echo "<script>alert('El producto ya ha sido seleccionado');</script>";
					$mensaje = 'El producto ya ha sido seleccionado';
				}else{
					$numeroProductos = count($_SESSION['carrito']);
					$producto = [
						'id' => $id,
						'nombre' => $nombre,
						'precio' => $precio,
						'cantidad' => $cantidad,
						'descuento' => $descuento,
						'imagen' => $imagen
					];
					$_SESSION['carrito'][$numeroProductos] = $producto;
					$mensaje = 'Producto agregado al carrito';
				}

					
			}

			break;
		
		case 'Eliminar':
			
			if(is_numeric(openssl_decrypt($_POST['id'], METHOD, KEY))){
				$id = openssl_decrypt($_POST['id'], METHOD, KEY);
				
				foreach ($_SESSION['carrito'] as $key => $producto) {
					
					if($producto['id'] == $id){
						unset($_SESSION['carrito'][$key]);
						$_SESSION['carrito'] = array_values($_SESSION["carrito"]); 
						$mensaje = 'elemento borrado satisfactoriamente';
					}

				}

			}else{
				$mensaje .= '¡Opss!, id incorrecto: ';
				break;
			}

			break;

		default:
			// code...
			break;
	}
}

?>