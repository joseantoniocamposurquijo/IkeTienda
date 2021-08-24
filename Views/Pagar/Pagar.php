<?php require_once 'Config/SetSession.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once 'Templates/Header.php'; ?>
  <title>Pagar</title>
  <link rel="stylesheet" href="<?= APPURL ?>Assets/Css/Pagar.css">
</head>
<body>
  <?php require_once 'Templates/Navbar.php'; ?>

  <div class="contenedor">

    <!-- Tarjeta -->
    <section class="tarjeta" id="tarjeta">
      <div class="delantera">
        <div class="logo-marca" id="logo-marca">
          <!-- <img src="img/logos/visa.png" alt=""> -->
        </div>
        <img src="img/chip-tarjeta.png" class="chip" alt="">
        <div class="datos">
          <div class="grupo" id="numero">
            <p class="label">Número Tarjeta</p>
            <p class="numero">#### #### #### ####</p>
          </div>
          <div class="flexbox">
            <div class="grupo" id="nombre">
              <p class="label">Nombre Tarjeta</p>
              <p class="nombre">Jhon Doe</p>
            </div>

            <div class="grupo" id="expiracion">
              <p class="label">Expiracion</p>
              <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
            </div>
          </div>
        </div>
      </div>

      <div class="trasera">
        <div class="barra-magnetica"></div>
        <div class="datos">
          <div class="grupo" id="firma">
            <p class="label">Firma</p>
            <div class="firma"><p></p></div>
          </div>
          <div class="grupo" id="ccv">
            <p class="label">CCV</p>
            <p class="ccv"></p>
          </div>
        </div>
        <p class="leyenda">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus exercitationem, voluptates illo.</p>
        <a href="#" class="link-banco">www.tubanco.com</a>
      </div>
    </section>

    <!-- Contenedor Boton Abrir Formulario -->
    <div class="contenedor-btn">
      <button class="btn-abrir-formulario" id="btn-abrir-formulario">
        <i class="fas fa-plus"></i>
      </button>
    </div>

    <!-- Formulario -->
    <form action="<?= APPURL ?>Pagar/ProcesarPago" id="formulario-tarjeta" class="card formulario-tarjeta active" method="post">
      <div class="grupo">
        <label for="inputNumero">Número Tarjeta</label>
        <input type="text" id="inputNumero" name="inputNumero" maxlength="19" autocomplete="off">
      </div>
      <div class="grupo">
        <label for="inputNombre">Nombre</label>
        <input type="text" id="inputNombre" name="inputNombre" maxlength="19" autocomplete="off">
      </div>
      <div class="flexbox">
        <div class="grupo expira">
          <label for="selectMes">Expiracion</label>
          <div class="flexbox">
            <div class="grupo-select">
              <select name="mes" id="selectMes">
                <option disabled selected>Mes</option>
              </select>
              <i class="fas fa-angle-down"></i>
            </div>
            <div class="grupo-select">
              <select name="year" id="selectYear">
                <option disabled selected>Año</option>
              </select>
              <i class="fas fa-angle-down"></i>
            </div>
          </div>
        </div>

        <div class="grupo ccv">
          <label for="inputCCV">CCV</label>
          <input type="text" id="inputCCV" name="inputCCV" maxlength="3">
        </div>
      </div>
      <input type="hidden" name="total" value="<?= $data['total'] ?>">
      <input type="hidden" name="idventa" value="<?= $data['idventa'] ?>">
      <button type="submit" class="btn-enviar">Enviar</button>
    </form>
  </div>

  <?php require_once 'Templates/Footer.php'; ?>
  <script src="<?= APPURL ?>Assets/Js/Pagar.js"></script>
</body>
</html>