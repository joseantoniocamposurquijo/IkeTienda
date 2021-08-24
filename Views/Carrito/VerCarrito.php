<?php require_once 'Views/Carrito.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'Templates/Header.php'; ?>
	<title><?= $data['page']; ?></title>
</head>
<body>
	<?php require_once 'Templates/Navbar.php'; ?>
	
	<!-- Content -->

	<section class="container my-3">

		<h1><em class="fas fa-cart-arrow-down"></em>&nbsp;&nbsp;Productos agregados al carrito</h1>

		<div class="text-right my-3">
         	<a href="<?= APPURL ?>home/" class="btn btn-secondary"><em class="fas fa-chevron-left"></em>&nbsp;Regresar</a>
      	</div>

		<table class="table table-sm table-bordered">
			<tr>
				<th width="10%">Id</th>
				<th width="10%">Imagen</th>
				<th width="50%">Nombre</th>
				<th width="10%">Precio</th>
				<th width="25%">Cantidad</th>
				<th width="5%">--</th>
			</tr>

		<?php $total = 0 ?>
		<?php foreach ($_SESSION['carrito'] as $item):?>
			<tr>
				<td><?= $item['id'] ?></td>
				<td><img class="img-rounded" src="<?= URLIMG.$item['imagen'] ?>" alt="<?= $producto['PrNombre'] ?>" width="70px"></td>
				<td><?= $item['nombre'] ?></td>
				<td><?= formatMoney($item['precio'] * (1 - $item['descuento'] / 100)) ?></td>
				<td><?= $item['cantidad']  ?></td>
				<td>
					<form action="" method="post">
						<input type="hidden" name="id" id="id" value="<?= openssl_encrypt($item['id'], METHOD, KEY) ?>">						
						<button type="submit" class="btn btn-danger" name="btnAccion" value="Eliminar"><em class="fas fa-trash-alt"></em></button>
					</form>
				</td>
			</tr>
		<?php $total = $total + ($item['precio'] * (1 - $item['descuento'] / 100)) ?>
		<?php endforeach; ?>

		</table>

		<div class="alert alert-secondary text-right p-4">
			<h3>Total <?= formatMoney($total) ?></h3>
		</div>

		<?php if(isset($_GET['url']) && $_GET['url'] == 'Carrito/Carrito/RegistrarUsuario'): ?>

			<div class="alert alert-warning text-center">
				<h5>Señor usuario, por favor inicie sesión o registrese en el siguiente formulario</h5>
			</div>

			<div class="card p-5">
				
				<form action="<?= APPURL ?>pagar/" method="post">
					<div class="form-group">
						<h3 class="text-center">Formulario de registro</h3>

						<h5 class="my-3">Datos de acceso</h5>
						<input type="text" name="UsAlias" class="form-control my-2" placeholder="Nombre de usuario" required>
						<input type="password" name="UsPassword" class="form-control my-2" placeholder="Password" required>
						<input type="password" name="UsPasswordConf" class="form-control my-2" placeholder="Confirme password" required>

						<h5 class="my-3">Datos personales</h5>
						<input type="text" name="UsNombres" class="form-control my-2" placeholder="Nombres" required>
						<input type="text" name="UsApellidos" class="form-control my-2" placeholder="Apellidos" required>
						<input type="email" name="UsCorreo" class="form-control my-2" placeholder="Correo electronico" required>
						<input type="text" name="UsDireccion" class="form-control my-2" placeholder="Direccion" required>
						<input type="text" name="UsTelefono" class="form-control my-2" placeholder="Telefono" required>
						
					</div>

					<div class="row">
						<div class="col-sm-4">
							<button type="reset" class="btn btn-secondary btn-block" name="btnAccion" value="proceder">Limpiar</button>
						</div>
						<div class="col-sm-4">
							<button type="button" class="btn btn-outline-secondary btn-block" name="btnAccion" value="proceder" onclick="history.back();">Cancelar</button>
						</div>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-primary btn-block" name="btnAccion" value="proceder">Proceder a pagar <em class="fas fa-angle-double-right"></em></button>
						</div>
						
					</div>
				</form>

			</div>

		<?php else: ?>

		<form action="<?= APPURL ?>pagar/" method="post">
			<button type="submit" class="btn btn-primary" name="btnAccion" value="verifica">Proceder a pagar >> </button>
		</form>

		<?php endif; ?>
	

	</section>

		<!-- /Content -->
	
	<?php require_once 'Templates/Footer.php'; ?>
	<script>
		$(function () {
  			$('[data-toggle="popover"]').popover()
		})
	</script>
</body>
</html>