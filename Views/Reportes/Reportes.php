<?php require_once 'Config/SetSession.php'; ?>
<?php require_once 'Help/Reportes.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once 'Templates/Header.php'; ?>
	<title><?= ucwords($data['table']) ?></title>
	<link rel="stylesheet" href="<?= APPURL ?>Assets/Css/Reportes.css">
	<link rel="stylesheet" href="<?= APPURL ?>Assets/Highcharts-7.0.0/highcharts.css"/>
	
	<script type="text/javascript" src="<?= APPURL ?>Assets/Highcharts-7.0.0/code/highcharts.js"></script>
    <script type="text/javascript" src="<?= APPURL ?>Assets/Highcharts-7.0.0/code/modules/series-label.js"></script>
    <script type="text/javascript" src="<?= APPURL ?>Assets/Highcharts-7.0.0/code/modules/exporting.js"></script>
    <script type="text/javascript" src="<?= APPURL ?>Assets/Highcharts-7.0.0/code/modules/export-data.js"></script>
</head>
<body>
   <?php require_once 'Templates/Navbar.php'; ?>
   
   <!-- Content -->

   <section class="container my-3">
		<h1>
		   <em class="<?= $data['icon'] ?>"></em>&nbsp;<?= ucwords($data['table']) ?>
		</h1>
		<small class="text-muted px-5"><?= $data['description'] ?></small>

<div class="d-flex">
	<!--  el otro lado -->
	<div class="w-100">
		<div id="content">
			
			<!-- Contenedor titulo -->

			<section class="py-3 w-100">
				<div class="container">
					<div class="row">
						<div class="col-lg-9">
							<h1 class="font-weight-bold mb-0">Hola!, <?= $_SESSION['UserSession']['UsNombres'].' '.$_SESSION['UserSession']['UsApellidos'] ?></h1>
							<p class="lead text-muted">Mira estas estadisticas</p>
						</div>
						<div class="col-lg-3 d-flex">
							<button class="btn btn-primary w-100 align-self-center" onclick="alert('Opsss, parece que este boton no sirve');">Descargar</button>
						</div>
					</div>
				</div>
			</section>

			<!-- badges -->

			<section>
				<div class="container">
					<div class="card rounded-0 shadow">
						<div class="card-body">
							<div class="row">
								
								<div class="col-lg-3 col-md-6 d-flex stat my-3">
								    <div class="mx-auto">
								        <h6 class="text-muted">Ventas</h6>
								        <h3 class="font-weight-bold"><?= $data['content']['ventas'] ?></h3>
								        <h6 class="text-success"><em class="fas fa-tag"></em> 10%</h6>
								    </div>
								</div>

								<div class="col-lg-3 col-md-6 d-flex stat my-3">
								    <div class="mx-auto">
								        <h6 class="text-muted">Usuarios</h6>
								        <h3 class="font-weight-bold"><?= $data['content']['usuarios'] ?></h3>
								        <h6 class="text-success"><em class="fas fa-users"></em> 3%</h6>
								    </div>
								</div>

								<div class="col-lg-3 col-md-6 d-flex stat my-3">
								    <div class="mx-auto">
								        <h6 class="text-muted">Pedidos</h6>
								        <h3 class="font-weight-bold"><?= $data['content']['pedidos'] ?></h3>
								        <h6 class="text-success"><em class="fas fa-truck-loading"></em> 4%</h6>
								    </div>
								</div>

								<div class="col-lg-3 col-md-6 d-flex stat my-3">
								    <div class="mx-auto">
								        <h6 class="text-muted">Productos</h6>
								        <h3 class="font-weight-bold"><?= $data['content']['productos'] ?></h3>
								        <h6 class="text-success"><em class="fas fa-box-open"></em> 5%</h6>
								    </div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>


			<!-- graficos -->

			<section class="bg-grey">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 my-3">
							<div class="card rounded-0">
								<div class="card-header bg-light">
									<h6 class="font-weight-bold mb-0">Graficos</h6>
								</div>
								<div class="card-body">
									<?php 
										$datos = "{$data['content']['ventas']}, {$data['content']['usuarios']}, {$data['content']['pedidos']}, {$data['content']['productos']}";
										$Categorias = "'ventas', 'usuarios', 'pedidos', 'productos'";
										GraficaEnColumnas("Cuentas por tablas", $datos, $Categorias, "Tabla", "Cantidad de registros") 
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-4 my-3">
							<div class="card rounded-0">
								<div class="card-header bg-light">
									<h6 class="font-weight-bold mb-0">Ventas recientes</h6>
								</div>
								<div class="card-body">

									<?php foreach($data['vendidos']['data'] as $venta) : ?>

									<div class="d-flex border-bottom py-2">
								        <div class="d-flex mr-3">
								            <h2 class="align-self-center mb-0"><em class="fas fa-tag"></em></h2>
								        </div>
								        <div class="align-self-center">
								            <h6 class="d-inline-block mb-0"><?= $venta['PrPrecio'] ?></h6><span class="badge badge-success ml-2">- <?= $venta['PrDescuento'] ?> % off</span>
								            <small class="d-block text-muted"><?= $venta['PrNombre'] ?></small>
								        </div>
								    </div>

    								<?php endforeach; ?>

									<button class="btn btn-primary w-100" onclick="alert('Opsss, parece que este boton no sirve');">Descargar</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
      
   </section>

   <!-- /Content -->
   <?php require_once 'Templates/Footer.php'; ?>
</body>
</html>