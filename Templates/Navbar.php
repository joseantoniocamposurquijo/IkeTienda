<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	
	<h2 class="navbar-brand text-light">
		<em class="fas fa-tv"></em> Ike Tech
	</h2>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">

		<!-- determina si inicia la sesion como administrador -->
		
		<ul class="navbar-nav mr-auto">
			<?php if(isset($_SESSION['UserSession']['UsRol']) && $_SESSION['UserSession']['UsRol'] == 'Ad'): ?>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>inicio">Inicio</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>productos">Productos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>categorias">Categorias</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>inventarios">Inventarios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>logs">Logs</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>pedidos">Pedidos</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>roles">Roles</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>usuarios">Usuarios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>ventas">Ventas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>tarjetas">Medios de pago</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light" href="<?= baseUrl(); ?>reportes">Reportes</a>
			</li>
			<?php endif; ?>
		</ul>

		
		<?php if(isset($_SESSION['UserSession']['UsRol'])): ?>

			<div class="btn-group dropleft">
				<button type="button" class="btn btn-outline-light"><em class="fas fa-user"></em> <?= $_SESSION['UserSession']['UsNombres'] ?></button>

				<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>

				<div class="dropdown-menu p-3">
					<a href="http://localhost/Tienda/Logout/" class="btn btn-danger btn-block"><em class="fas fa-sign-out-alt"></em>&nbsp;&nbsp;Salir</a>
				</div>
			</div>

		<?php else: ?>

			<div class="btn-group dropleft">
				<button type="button" class="btn btn-outline-light">Acceder</button>

				<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>

				<div class="dropdown-menu p-3">
					<h3>Inicio de sesion</h3>
					<form action="<?= APPURL ?>Login/" method="post" class="form-inline my-2 my-lg-0">
						<input class="form-control my-2" type="text" placeholder="User" name="username" id="username">
						<input class="form-control my-2" type="password" placeholder="Password" name="password" id="password">
						<button class="btn btn-outline-success my-2" type="submit" name="btnAccion">Login</button>
					</form>
				</div>
			</div>

		<?php endif; ?>

	</div>
</nav>