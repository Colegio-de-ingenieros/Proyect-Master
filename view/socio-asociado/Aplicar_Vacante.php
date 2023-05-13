<script src="../../view/login/js/Verificar_Permiso_Socio.js"></script>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplicar a la Vacante</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/Vista_Cv.css">
  <link rel="icon" href="../../public/img/ciscig-notch.png" sizes="32x32">
  <!-- <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png" sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage" content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"> -->
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
              Cursos
            </a>

            <ul>
              <li><a id="" href="../../view/socio-asociado/Reg_Cursos.html">Registrar</a></li>
              <li><a id="" href="../../view/socio-asociado/Ver_Cursos.html">Mostrar</a></li>
            </ul>
          </li>

          <!-- Cuotas -->
          <li>
            <a href="#">
              Cuotas
            </a>

            <ul>
              <li><a id="" href="Reg_Cuota.html">Registrar</a></li>
              <li><a id="" href="Vista_Cuotas.html">Mostrar</a></li>
            </ul>
          </li>

          <!-- Bolsa de trabajo -->
          <li>
            <a href="#">
             
              Bolsa de trabajo
            </a>

            <ul>
              <li><a id="" href="Bolsa-Trabajo.html">Ofertas de trabajo</a></li>
              <li><a id="" href="Reg_CV.html">Mi CV</a></li>
            </ul>
          </li>

          <!-- Servicios -->
          <li>
            <a href="#">
              
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
      <button class="btn-cerrar-session btn"
        onclick="window.location.href = '../../controller/login/Logout.php ' ">Cerrar sesión</button>
    </div>
  </header>

  <main>
    <section class="section-main">
      <div class="cabezera">
        <h3 class="h3">Mostrar CV</h2>
          
          <p class="subtitulo-1">Datos generales</p>
          
          <hr>
      </div>
      <!-- Datos generales -->
      
      <div class="formulario-generales">
        <!-- Nombre -->
        <div class="campo">
          <label for="" class="label-2">Nombre</label>
          <input type="text" class="input-format-2" id="nombre-campo" readonly></input>
        </div>
        <!-- Apellido paterno -->
        <div class="campo">
          <label for="" class="label-2">Apellido Paterno</label>
          <input type="text" class="input-format-2" id="apellido-paterno-campo" readonly></input>
        </div>
        <!-- Apellido materno -->
        <div class="campo">
          <label for="" class="label-2">Apellido Materno</label>
          <input type="text" class="input-format-2" id="apellido-materno-campo" readonly></input>
        </div>
        <!-- Fecha de nacimiento -->
        <div class="campo">
          <label for="" class="label-2">Fecha de nacimiento</label>
          <input type="date" class="input-format-2" id="fecha-nacimiento-campo" readonly></input>
        </div>
        <!-- Correo electrónico -->
        <div class="campo">
          <label for="" class="label-2">Correo electrónico</label>
          <input type="email" class="input-format-2" id="correo-campo" readonly></input>
        </div>
        <!-- Telefono -->
        <div class="campo">
          <label for="" class="label-2">Teléfono</label>
          <input type="tel" class="input-format-2" id="telefono-campo" readonly></input>
        </div>
        <!-- Cambio de residencia -->
        <div class="campo">
          <label for="" class="label-2">¿Puede cambiar de residencia?</label>
          <input type="text" class="input-format-2" id="residencia-campo" readonly>
        </div>
        <!-- Expectativa salarial bruta -->
        <div class="campo">
          <label for="" class="label-2">Expectativa salarial bruta</label>
          <input id="salarial-campo" type="text"class="input-format-2" readonly></input>
        </div>
      </div>

      <div class="formulario-descripcion">
        <label for="" class="label-2">Descripción profesional</label>
        <textarea  id="objetivo" class="input-format-2" readonly></textarea>
      </div>
      
      <!-- Dirección -->
      <div class="divisor">
        <p class="subtitulo-1">Dirección</p>
        <hr>
      </div>
      
      <div class="formulario-generales">
        <!-- Calle y número -->
        <div class="campo">
          <label for="" class="label-2">Calle y número</label>
          <input type="text" class="input-format-2" id="calle-campo" readonly></input>
        </div>
        <!-- Colonia -->
        <div class="campo">
          <label for="" class="label-2">Colonia</label>
          <input type="text" class="input-format-2" id="colonia-campo" readonly>
        </div>
        <!-- Ciudad -->
        <div class="campo">
          <label for="" class="label-2">Ciudad</label>
          <input type="text" class="input-format-2" id="ciudad-campo" readonly>
        </div>
        <!-- Estado -->
        <div class="campo">
          <label for="" class="label-2">Estado</label>
          <input type="text" class="input-format-2" id="estado-campo" readonly>
        </div>
      </div>

      <!-- Experiencia académica -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia académica</p>
        <hr>
      </div>
      
      <!-- Formulario académico 1 -->
      <div class="formulario-academica" id="academico-1">
        
      </div>
      

      <!-- Experiencia profesional -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia profesional</p>
        <hr>
      </div>
      
      <!-- Formulario experiencia 1 -->
      <div class="formulario-experiencia" id="experiencia-1">

      </div>

      <!-- Certificaciónes -->
      <div class="divisor">
        <p class="subtitulo-1">Certificaciones</p>
        <hr>
      </div>

      <div id="formulario-certificaciones" class="formulario-certificaciones">
      </div>

      
      <div class="botones-registro">
        <button class="btn btn-medium" onclick="aplicar()">Aplicar a la vacante</button>
      </div>

    </section>
  </main>
  <span id="id-bolsa" style="display:none"></span>
  <span id="id-usuario" style="display:none"></span>
</body>
<script src="js/Aplicar_Vacante.js"></script>
</html>

<?php
  echo "<script>document.getElementById('id-bolsa').innerHTML = '".$_GET['id']."'</script>";
?>