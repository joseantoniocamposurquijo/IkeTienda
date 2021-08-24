<?php require_once 'Config/SetSession.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'Templates/Header.php'; ?>
	<title><?= $data['page']; ?></title>
</head>
<body>
	<?php require_once 'Templates/Navbar.php'; ?>
	
	<!-- Content -->

	<section class="container text-center my-3">
		
			<div class="jumbotron text-center">
				<em class="far fa-check-circle text-success" style="font-size: 100px;"></em>
				<h1 class="display-4">¡Listo!</h1>
				<p class="lead">El pago se ha realizado con exito:
					<h4><?= formatMoney($data['total']) ?></h4>
					<!-- Set up a container element for the button -->
    				<div id="paypal-button-container"></div>
				</p>
				<hr class="my-4">
				<p>El (los) producto(s) sera(n) entregado(s) en la direccion de domicilio registrada.
				</p>

				<a href="<?= APPURL ?>Home/" class="btn btn-primary btn-block">Regresar</a>
			</div>
	</section>

	<!-- /Content -->
	
	<?php require_once 'Templates/Footer.php'; ?>
</body>
</html>