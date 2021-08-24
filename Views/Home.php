<?php require_once 'Carrito.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'Templates/Header.php'; ?>
	<title><?= $data['page']; ?></title>
</head>
<body class="bg-light">
	<?php require_once 'Templates/Navbar.php'; ?>

	<?php require_once 'Carrusel.php'; ?>
	
	<!-- Content -->

	<section class="container my-2 text-right">

		<!-- Boton ver carrito - open modal -->
		<button type="button" class="btn btn-info text-light btn-carrito" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="position: fixed;">
			<em class="fas fa-shopping-cart"></em>&nbsp;&nbsp;
			<?php if(isset($_SESSION['carrito'])): ?>
				<span class="badge badge-light"><?php echo count($_SESSION['carrito']) ?></span>
			<?php endif; ?>
		</button>
		
		<div class="dropdown-menu p-3">
			<?php if(isset($_SESSION['carrito'])): ?>
			<h3>Productos agregados al carrito</h3>
			<p><strong><?php echo count($_SESSION['carrito']) ?></strong> producto(s) agregado(s) al carrito exitósamente.</p>
			<a href="<?= APPURL ?>Carrito/" class="btn btn-outline-success my-2 btn-block" type="submit">Comprar</a>
			<?php else: ?>
			<h5>No se han agregado productos al carrito</h5>
			<?php endif; ?>
		</div>

	</section>


	<!-- Productos -->
	<section class="container">
		<h3 class="p-5 text-muted">Nuestros productos</h3>
		<div class="row">

		<?php if($data['content']['rowCount'] == 0) : ?>

			<h5 class="text-muted">Sorry! No hay productos en esta categoria</h5>

		<?php endif; ?>

		<?php foreach ($data['content']['data'] as $producto):?>
		  
			<div class="col-sm-3">
				<div class="card card-hover">
					<img class="card-img-top" src="<?= URLIMG.$producto['PrImagen'] ?>" alt="<?= $producto['PrNombre'] ?>" title="<?= $producto['PrNombre'] ?>" data-toggle="popover" data-trigger="hover" data-content="<?= $producto['PrDescripcion'] ?>" height="200px">

					<div class="card-body">
						
						<span class="card-text h3"><?= formatMoney($producto['PrPrecio'] * (1 - $producto['PrDescuento'] / 100)) ?></span>
						<div class="text-right">
							<?php if($producto['PrDescuento'] > 0): ?>
								
								<s><span class="card-text text-muted h5"><?= formatMoney($producto['PrPrecio']) ?></span></s>&nbsp;&nbsp;
								<small class="badge badge-success"><?= $producto['PrDescuento'] ?>% off</small>

							<?php  endif; ?>
							
						</div>

						<p class="card-title text-muted text-center"><?= $producto['PrNombre'] ?></p>

						<form action="" method="post">
							<input type="hidden" name="id" id="id" value="<?= openssl_encrypt($producto['PrId'], METHOD, KEY) ?>">
							<input type="hidden" name="nombre" id="nombre" value="<?= openssl_encrypt($producto['PrNombre'], METHOD, KEY) ?>">
							<input type="hidden" name="precio" id="precio" value="<?= openssl_encrypt($producto['PrPrecio'], METHOD, KEY) ?>">
							<input type="hidden" name="cantidad" id="cantidad" value="<?= openssl_encrypt(1, METHOD, KEY) ?>">
							<input type="hidden" name="descuento" id="descuento" value="<?= openssl_encrypt($producto['PrDescuento'], METHOD, KEY) ?>">
							<input type="hidden" name="imagen" id="imagen" value="<?= openssl_encrypt($producto['PrImagen'], METHOD, KEY) ?>">

							<?php if($producto['InCantidad'] > 0): ?>
								<button type="submit" class="btn btn-outline-primary btn-block" name="btnAccion" value="Agregar"><em class="fas fa-shopping-cart"></em> Agregar</button>
							<?php else: ?>
								<button type="button" class="btn btn-secondary btn-block" name="btnAccion" value="none" disabled><em class="fas fa-shopping-cart"></em> Agotado</button>
							<?php endif; ?>
						</form>

					</div>
				</div>
			</div>

		<?php endforeach; ?>

		</div>
	</section>


	<!-- Categorias -->
	<?php if(isset($data['categorias']['data'])): ?>
		<section class="container">
			<h3 class="p-5 text-muted">Algunas categorias</h3>
			<div class="row">

				<?php foreach ($data['categorias']['data'] as $categoria):?>

					<div class="col-sm-2 border text-center card-category">
						<a href="<?= APPURL ?>Home/CategoriaFiltrada/<?= $categoria['CaId'] ?>">
							<div class="p-5">
								<em class="<?= $categoria['CaIcono'] ?> h1"></em>
								<small><?= $categoria['CaDescripcion'] ?></small>
							</div>
						</a>		
					</div>

				<?php endforeach; ?>

			</div>
		</section>
	<?php endif; ?>


	<!--  -->
	<section class="bg-white p-5 mt-5">
		
		<div class="container">
			<div class="row">
				<div class="col-sm-4 text-center">
					<em class="fas fa-credit-card text-muted h1"></em>
					<h5 class="text-muted">Paga con tarjeta o en efectivo</h5>
					<small class="text-muted">Paga en cuotas y aprovecha la comodidad de financiación que te da tu banco, o hazlo con efectivo en puntos de pago. ¡Y siempre es seguro!</small>
				</div>
				<div class="col-sm-4 text-center">
					<em class="fas fa-box-open text-muted h1"></em>
					<h5 class="text-muted">Envío gratis desde $ 70.000</h5>
					<small class="text-muted">Con solo estar registrado, tienes envíos gratis en miles de productos seleccionados.</small>
				</div>
				<div class="col-sm-4 text-center">
					<em class="fas fa-shield-alt text-muted h1"></em>
					<h5 class="text-muted">Seguridad, de principio a fin</h5>
					<small class="text-muted">¿No te gusta? ¡Devuélvelo! No hay nada que no puedas hacer, porque estás siempre protegido.</small>
				</div>
			</div>
		</div>

	</section>

	<!-- /Content -->
	
	<?php require_once 'Templates/Footer.php'; ?>
</body>
</html>