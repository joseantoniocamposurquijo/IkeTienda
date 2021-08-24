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

	<section class="container my-3">
		<div class="jumbotron text-center">
			<h1>Bienvenido <?= $_SESSION['UserSession']['UsNombres'].' '.$_SESSION['UserSession']['UsApellidos'] ?></h1>
			<h4><?= $_SESSION['UserSession']['UsRol'] ?></h4>
			<p>Elija en el menu la opcion</p>
			<br><br><br>
			<a href="<?= APPURL ?>Home/" class="btn btn-primary btn-block">Ir a la tienda</a>
		</div>
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