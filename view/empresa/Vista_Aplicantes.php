<?php
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista aplicantes</title>
    <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  <script src="../../controller/empresa/js/Mostrar_Aplicantes.js"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/Reg_Ofertas.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Vista_Ofertas.css">
  

    <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
    <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
      sizes="192x192">
    <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
    <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
</head>
<body>
  <header>

    <div class="menu">
      <input type="checkbox" id="check__menu">
      <label id="label__check" for="check__menu"><i class="fa-sharp fa-solid fa-bars icon__menu"></i></label>
      <img class="logo_ciscig" src="../../public/img/ciscigCompleto.png" alt="">
      <nav>
        <ul>

          <!-- Cursos -->
          <li>
            <a href="#">
              <!--               <i class="fa-solid fa-user-tie"></i> -->
              Cursos
            </a>

            <ul>
              <li><a id="" href="#">Registrar</a></li>
              <li><a id="" href="#">Mostrar</a></li>
            </ul>
          </li>

          <!-- Cuotas -->
          <li>
            <a href="#">
              <!-- <i class="fa-solid fa-circle-check"></i> -->
              Cuotas
            </a>

            <ul>
              <li><a id="" href="#">Registrar</a></li>
              <li><a id="" href="#">Mostrar</a></li>
            </ul>
          </li>

          <!-- Bolsa de trabajo -->
          <li>
            <a href="#">
              <!-- <i class="fa-solid fa-chalkboard-user"></i> -->
              Bolsa de trabajo
            </a>

            <ul>
              <li><a id="" href="../empresa/Reg_Ofertas.html">Registrar</a></li>
              <li><a id="" href="../empresa/Vista_Ofertas.html">Mostrar</a></li>
            </ul>
          </li>

          <!-- Servicios -->
          <li>
            <a href="#">
              <!-- <i class="fa-solid fa-clipboard-list"></i> -->
              Servicios
            </a>

            <ul>
              <li><a id="" href="#">Registrar</a></li>
              <li><a id="" href="#">Mostrar</a></li>
            </ul>
          </li>

          <!-- Mi Perfil -->
          <li>
            <a href="#">
              <!-- <i class="fa-regular fa-user"></i> -->
              Mi perfil
            </a>

            <ul>
              <li><a id="" href="#">Datos Generales</a></li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>

    <div class="boton-cerrar-session">
      <button class="btn-cerrar-session btn">Cerrar sesión</button>
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
          <input id="prodId" name="prodId" type="hidden" value=<?php echo $id; ?>>
          
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
</body>
</html>