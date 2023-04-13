<!-- <script src="../../view/login/js/verificar_permiso_trabajador.js"></script> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización trabajadores</title>
    <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
    <link rel="stylesheet" href="../../public/css/administrativo/vista_trabajadores.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../../controller/administrativo/js/Mostrar_Trabajadores.js"></script>

  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
</head>
<body>
<header>
    <div class="header_superior">
      <div class="titulo">

        <div class="nombre_ventana">
          <img class="logo_ciscig" src="../../public/img/LOGO_CISCIG-white.png" width="10px" alt="">
          <h1 class="nombre_Ventana">Trabajadores</h1>
        </div>

      </div>

      <div class="boton-cerrar-session">
        <button class="btn-cerrar-session btn">Cerrar sesión</button>
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
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Cursos.php">Mostrar</a></li>
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
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Mostrar</a></li>
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
                <li><a id="menuSucursal1" href="#">Individual</a></li>
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
    <div>
      <div class="article-tablas">
        <article>
          <div class="sub-titulo">
            <h4 class="subtitulo-1">Mostrar / Consultar</h4>
          </div>
          <hr>
          <div class="grupo-input">
            <div class="input-form">
              <input type="search" class="input-format-2" placeholder="Buscar" name="busqueda" id="busqueda">
            </div>
          </div>
          <br>
          <div class="tablas">
            <section class="header_table" id="tablaResultado">
            <?php //include('../../controller/administrativo/Mostrar_Trabajadores.php');?>
            </section>
          </div>
        </article>
      </div>
    </div>
  </main>
	<script src="../../controller/administrativo/js/Eliminar_Trabajadores_Confirmacion.js"></script>
</body>
<!--<script src="../../controller/administrativo/js/Mostrar_Trabajadores.js"></>-->
</html>