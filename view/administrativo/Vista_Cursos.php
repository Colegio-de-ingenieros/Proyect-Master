<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vista de cursos - CISICG</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">

  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../../controller/administrativo/js/Mostrar_Cursos.js"></script>
</head>

<body>
  <header>
    <div class="header_superior">
      <div class="titulo">

        <div class="nombre_ventana">
          <h1 class="nombre_Ventana">Nombre ventana</h1>
        </div>

      </div>

      <div class="input-buscar">
        <div class="barra-busqueda">
          <input type="text" class="input" name="busqueda" id="busqueda" placeholder="Buscar...">
          <i class="fas fa-search"></i>
        </div>
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
            <li class="logo_menu"><a href="#">
                <img class="logo_ciscig" src="../../public/img/ciscigCompleto.png" alt="">
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa-regular fa-user"></i>
                Usuarios
              </a>

              <ul>
                <li><a id="menuProducto1" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-user-tie"></i>
                Trabajadores
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-circle-check"></i>
                Certificaciones
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Certificaciones.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Certificaciones.php">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-chalkboard-user"></i>
                Cursos
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-clipboard-list"></i>
                Proyectos
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-person-chalkboard"></i>
                Instructores
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-chart-column"></i>
                Seguimiento
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-file"></i>
                Pólizas
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Registrar</a></li>
                <li><a id="menuSucursal2" href="#">Visualizar</a></li>
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
                <li><a id="menuSucursal1" href="#">Visualizar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-briefcase"></i>
                Bolsa de trabajo
              </a>

              <ul>
                <li><a id="menuSucursal1" href="#">Ofertas</a></li>
                <li><a id="menuSucursal1" href="#">C.V</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar sesión
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  
  <main class="section-main" id="tablaResultado">
    <div class="contenedortrabajadores" >
		  <h3>Vista </h3>
		<hr size="1px"/>
		<br>
        <p class="subtitulo-1"> Vista general trabajadores</p>
		<div class="contenedor-formulario">
			<div></div>
			<div class="grupo-input">
				<div class="input-form">
					<input type="search" id="search" class="input-busca" placeholder="Buscar..">
				</div>
			</div>
		</div>
		<br>
        <br>
        <br>
        <br>
        <div class="table">
            <div class="errors-cointainer">
                <p></p>
            </div>
            <div class="header_table" id="resultContainer">
				<?php //include('../../controller/administrativo/Mostrar_Trabajadores.php');?>
            </div>
        </div>
    </div>
  </main>
</body>

</html>