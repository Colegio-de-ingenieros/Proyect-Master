<?php
$idp=$_GET["idp"];
include_once('../../controller/administrativo/Get_Proyecto.php');
list($nom, $obj, $monto,$ini,$fin)=fecPro($idp);
?>

<script src="../../view/login/js/Verificar_Permiso_Trabajador.js"></script>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificación de proyectos</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Reg_Proyectos.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">

  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">

    <script languaje="javascript">
      function regresar(){
        location.href = '../../view/administrativo/Vista_Proyectos.php';
      }
    </script>

</head>

<body>
  <header>
    <div class="header_superior">
      <div class="titulo">

        <div class="nombre_ventana">
          <img class="logo_ciscig" src="../../public/img/LOGO_CISCIG-white.png" width="10px" alt="">
          <h1 class="nombre_Ventana">Proyectos</h1>
        </div>

      </div>

      <div class="boton-cerrar-session">
        <button class="btn-cerrar-session btn" onclick="window.location.href = '../../controller/login/Logout.php' ">Cerrar sesión</button>      </div>
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
      <div class="cabezera">
        <h4 class="h4">Modificación</h4>
      </div>
      <br>
      <p class="subtitulo-1"> Datos generales</p>
      <hr>

      <form class="formulario-de-datos" id="formulario">

        <input type="hidden" id="idp" name="idp" value="<?php echo $idp?>">

        <div class="grupo-input">
          <div class="label-form">
            <p class="label-2">Nombre del proyecto*</p>
          </div>
          <div class="input-form">
            <input type="text" name="nom_proyecto" id="nom_proyecto" value="<?php echo $nom?>" class="input-format-2"
              placeholder="Ingrese el nombre" required maxlength="60" 
              title="El nombre del proyecto solo puede contener letras mayúsculas, minúsculas, números, comas y puntos.">
          </div>
        </div>

        <div class="grupo-input">
          <div class="label-form">
            <p class="label-2">Fecha de inicio*</p>
          </div>

          <div class="input-form">
            <input type="date" name="ini_proyecto" id="ini_proyecto" value="<?php echo $ini?>" class="input-format-2" required
            title="La fecha de inicio debe cumplir con el formato dd/mm/aaa.">
          </div>
        </div>

        <div class="grupo-input">
          <div class="label-form">
            <p class="label-2">Fecha de finalización*</p>
          </div>
          
          <div class="input-form">
            <input type="date" name="fin_proyecto" id="fin_proyecto" value="<?php echo $fin?>" class="input-format-2"  required
            title="La fecha de finalización debe cumplir con el formato dd/mm/aaa y debe ser mayor a la fecha de inicio.">

          </div>
        </div>

        <div class="grupo-input">
          <div class="label-form">
            <p class="label-2">Monto*</p>
          </div>
          <div class="input-form">
            <input  type="text"   name="monto_proyecto" id="monto_proyecto" value="<?php echo $monto?>" class="input-format-2" placeholder="Ingrese el monto" required 
            title="El monto solo puede contener números y un punto.">
          </div>
        </div>

        <div class="grupo-input2">
          <div class="label-form">
            <p class="label-2">Objetivo*</p>
          </div>
          <div class="input-form">
            <textarea type="text" name="obj_proyecto" id="obj_proyecto" class="input-textarea"
              placeholder="Ingrese el objetivo" required
              title="El objetivo solo puede contener letras mayúsculas, minúsculas, comas y puntos."><?php echo $obj?></textarea>
          </div>
        </div>
        <br>

        <div class="grupo-boton-reg">
          <div class="boton_registrar">
            <button type="submit" name="registrar" id="registrar" class="btn-medium btn">Actualizar</button>&nbsp;&nbsp;
            <button type="button" name="cancelar" id="cancelar" class="btn-medium btn" onclick="regresar()">Cancelar</button>
          </div>
        </div>
      </form>
    </section>
  </main>
  <script src="../../view/administrativo/js/Vali_Proyectos.js"></script>
</body>
<script src="../../controller/administrativo/js/Modificar_Proyectos.js"></script>
</html>


