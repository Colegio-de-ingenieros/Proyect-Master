<!-- <script src="../../view/login/js/Verificar_Permiso_Trabajador.js"></script> -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificación</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Reg_Cursos.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Modi_Cursos.css">
  <link rel="icon" href="../../public/img/ciscig-notch.png" sizes="32x32">
  <!-- <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body>

  <header>
    <div class="header_superior">
      <div class="titulo">

        <div class="nombre_ventana">
          <img class="logo_ciscig" src="../../public/img/LOGO_CISCIG-white.png" width="10px" alt="">
          <h1 class="nombre_Ventana">Cursos</h1>
        </div>

      </div>

      <div class="boton-cerrar-session">
        <button class="btn-cerrar-session btn" onclick="window.location.href = '../../controller/login/Logout.php ' ">Cerrar sesión</button>
      </div>
    </div>

    <!-- Menu Desplegable -->
    <div class="container_menu">
      <div class="menu">
        <input type="checkbox" id="check__menu">
        <label id="label__check" for="check__menu">
          <i class="fa-sharp fa-solid fa-bars icon__menu"></i>
        </label>
        <nav>
          <ul>

            <li>
              <a href="#">
                <i class="fa-regular fa-user"></i>
                Usuarios
              </a>

              <ul>
                <li><a id="menuProducto1" href="#">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-user-tie"></i>
                Trabajadores
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_trabajadores.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_trabajadores.php">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-circle-check"></i>
                Certificaciones
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Certificaciones.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Certificaciones.php">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-chalkboard-user"></i>
                Cursos
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Cursos.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Cursos.html">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-clipboard-list"></i>
                Proyectos
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Proyectos.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Proyectos.php">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-person-chalkboard"></i>
                Instructores
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-chart-column"></i>
                Seguimiento
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Seguimiento.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Seguimiento.html">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-file"></i>
                Pólizas
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-file-lines"></i>
                Reportes
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Vista_ReporteIn.html">Individual</a></li>
                <li><a id="menuSucursal2" href="#">General</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-user-gear"></i>
                Servicios
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-briefcase"></i>
                Bolsa de trabajo
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Ofertas</a></li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <section class="section-main">
      <div class="cabezera">
        <h4 class="h4">Modificación de cursos</h4>
        <h6 class="subtitulo-1">Datos generales</h6>
      </div>
      <hr>

      <div class="formulario-cursos">

        <div class="campo">
          <label for="nombre-curso" class="label-2 nombre">Nombre del curso*</label>
          <input title="El nombre solo puede contener letras, números, puntos y comas." type="text" name="nombre-curso" id="nombre-curso" class="input-format-2" placeholder="Ingrese el nombre" minlength="1" maxlength="40" required>
        </div>

        <div class="campo">
          <label for="clave-curso" class="label-2 clave">Clave del curso*</label>
          <input type="text" name="clave-curso" id="clave-curso" class="input-format-2" readonly required>
        </div>

        <div class="campo">
          <label for="duración" class="label-2 duracion">Duración del curso*</label>

          <input title="La duración solo puede contener 3 números como máximo." type="text" name="duración" id="duración" class="input-format-2" placeholder="Ingrese la duración en hrs" maxlength="3" required>
        </div>

        <div class="campo-wide">
          <label for="objetivo" class="label-2 objetivo">Objetivo*</label>
          <textarea title="El objetivo solo puede contener letras, números, puntos y comas" type="textarea" name="objetivo" id="objetivo" class="input-textarea-2" placeholder="Ingrese el objetivo" required></textarea>
        </div>
      </div>


      <div class="titulos-registrados">
        <p class="subtitulo-1">Temario</p>
        <hr class="hr">
      </div>

      <div id="temario"></div>

      <div class="section-botones-2">
        <div class="campo botones">
          <button id="update-form" class="btn-medium btn">Actualizar</button>
          <button id="delete-form" class="btn-medium btn">Cancelar</button>
        </div>
      </div>


    </section>

    <div class="modal-container" id="modal-container">
      <div class="modal">
        <div class="subtitulos-registrados">
          <p class="subtitulo-1" id="modal-title"></p>
          <p class="subtitulo-2">Subtemas:</p>
          <hr class="hr">
        </div>
        <div class="container-subtemas" id="modal">

        </div>
        <div class="botones">
          <button id="close" class="btn btn-small">Cerrar</button>
        </div>
      </div>
    </div>
    </div>

    <span id="id-usuario" style="display:none"></span>
  </main>

</body>

<script src="js/temario.js"></script>
<!-- <script src="js/Ventana_Modal.js"></script> -->

</html>
<?php
echo "<script>document.getElementById('id-usuario').innerHTML = '" . $_GET['id'] . "'</script>";
?>