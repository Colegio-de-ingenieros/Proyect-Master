<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver más de un instructor</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Vista_Instructor.css">
  <link rel="icon" href="../../public/img/ciscig-notch.png" sizes="32x32">
</head>

<body>
  <header>
    <div class="header_superior">
      <div class="titulo">

        <div class="nombre_ventana">
          <img class="logo_ciscig" src="../../public/img/LOGO_CISCIG-white.png" width="10px" alt="">
          <h1 class="nombre_Ventana">Instructores</h1>
        </div>

      </div>

      <div class="boton-cerrar-session">
        <button class="btn-cerrar-session btn" onclick="window.location.href = '../../controller/login/Logout.php' ">Cerrar sesión</button>
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
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Instructor.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Instructor.html">Mostrar</a></li>
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
        <div class="boton_registrar">
            <button class="btn-medium btn">Descargar Excel</button>
        </div>  
        <br>
        <form action="">
            <div class="contenedor-formulario">
                <br>
                <p class="subtitulo-0"> Nombre</p>
                <br>
                <p class="subtitulo-11" id="nombre_instructor"></p>
                <br>
                <hr>
                <br>
                <p class="subtitulo-0"> Especialidades</p>
                <br>
                <div class="datos" id="especialidades_instructor">
                  <p class="subtitulo-11"></p>
                </div>
                <br>
                <hr>
                <br>
                <p class="subtitulo-0"> Certificaciones internas </p>
                <br>
                <div class="datos" id="certificaciones_internas">
                </div>
                <br>
                <hr>
                <br>
                <p class="subtitulo-0"> Certificaciones externas </p>
                <br>
                <div class="datos" id="certificaciones_externas">
                </div>
                <br>
            </div>
        </form>
    </section>
  </main>
  <br>
  <br>
  <br>
  <span id="id_instructor" style="display:none"></span>
</body>
<script src="js/Vista_Instructor_Individual.js"></script>
</html>

<?php
  echo "<script>document.getElementById('id_instructor').innerHTML = '" . $_GET['id'] . "'</script>";
?>