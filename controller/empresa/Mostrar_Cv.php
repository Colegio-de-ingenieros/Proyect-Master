<?php
$id=$_GET['id'];
include_once('../../model/empresa/Mostrar_Aplicantes.php');
//echo $id;
$base = new MostrarAplicantes();
$base->instancias();
$resultado = $base->getAplicante($id);
if ($resultado == true) {
  $identificador=$resultado[0]["IdPerso"];
  $nombre=$resultado[0]["NomPerso"];
  $apeP=$resultado[0]["ApePPerso"];
  $apeM=$resultado[0]["ApeMPerso"];
  $calle=$resultado[0]["CallePerso"];
  $tel=$resultado[0]["TelMPerso"];
  $fecha=$resultado[0]["FechaNacPerso"];
  $correo=$resultado[0]["CorreoPerso"];
  $desc=$resultado[0]["DesProCv"];
  $salEsp=$resultado[0]["ExpSalCv"];
  $cedula=$resultado[0]["NumCedAca"];
  $carrera=$resultado[0]["Carrera"];
}
$resultado=$base->mostrarColonia($identificador);
if ($resultado == true) {
  $colonia=$resultado[0]["nomcolonia"];
  $municipio=$resultado[0]["nommunicipio"];
  $estado=$resultado[0]["nomestado"];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mostrar CV</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/Reg_CV.css">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
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
              <li><a id="" href="#">Ofertas de trabajo</a></li>
              <li><a id="" href="#">Mi CV</a></li>
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
          <label for="" class="label-2">Nombre</label> <br> <br>
          <label for="" class="label-4"><?php echo $nombre ?></label> <br> <br>
          <label for="" class="label-2">Apellido Paterno</label><br><br>
          <label for="" class="label-4"><?php echo $apeP?></label> <br> <br>
          <label for="" class="label-2">Apellido Materno</label><br><br>
          <label for="" class="label-4"><?php echo $apeM?></label> <br> <br>
          <label for="" class="label-2">Fecha de nacimiento</label><br><br>
          <label for="" class="label-4"><?php echo $fecha?></label> <br> <br>
          <label for="" class="label-2">Correo electrónico</label><br><br>
          <label for="" class="label-4"><?php echo $correo?></label> <br> <br>
          <label for="" class="label-2">Teléfono</label><br><br>
          <label for="" class="label-4"><?php echo $tel?></label> <br> <br>
          <label for="" class="label-2">Domicilio</label><br><br>
          <label for="" class="label-4"><?php echo $calle." ".$colonia.", ".$municipio.", ".$estado?></label> <br> <br>
          <label for="" class="label-2">Expectativa salarial bruta</label><br><br>
          <label for="" class="label-4">$ <?php echo $salEsp?></label> <br> <br>
          <label for="" class="label-2">Descripción profesional</label><br><br>
          <label for="" class="label-4"> <?php echo $desc?></label> <br> <br>
        </div>
      </div>
      <!-- Experiencia académica -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia académica</p>
        <hr>
      </div>

      <div class="formulario-academica">
        <!-- Nombre de la carrera -->
        <?php $resultado=$base->mostrarAcademica($id);
        if ($resultado == true) {
          $salida='';
          for ($i = 0; $i < count($resultado); $i++) {
            $puesto=$resultado[$i]['Carrera'];
            $ced=$resultado[$i]['NumCedAca'];
         $salida.='<div id="carrera-1"class="campo">
          <label for="" class="label-2">Nombre de la carrera</label><br><br>
          <label for="" class="label-4">'.$puesto.' </label> <br> <br>
          <label for="" class="label-2">Número de cédula</label><br> <br>
          <label for="" class="label-4">'.$ced.' </label> <br> <br>          
        </div>
      ';}}
      echo $salida;
      ?>
      </div>
      <!-- Experiencia profesional -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia profesional</p>
        <hr>
      </div>
      
      <div class="formulario-experiencia">
        <!-- Puesto que desempeñaba -->
        <?php $resultado=$base->mostrarLaboral($id);
        if ($resultado == true) {
          $salida='';
          for ($i = 0; $i < count($resultado); $i++) {
          // IdBolCv 	IdExpP 	EmpExpP 	IniExpP 	FinExpP 	PuestoExpP 	ActExpP 	IdExpP 	
          $puesto=$resultado[$i]['PuestoExpP'];
          $empresa=$resultado[$i]['EmpExpP'];
          $inicio=$resultado[$i]['IniExpP'];
          $fin=$resultado[$i]['FinExpP'];
          $act1=$resultado[$i]['ActExpP'];
          $num=$i+1;
        
        $salida.='<div class="campo">
          <label for="" class="label-2">Experiencia '.$num.'</label><br><br>
          <label for="" class="label-2">Puesto que desempeñaba</label><br><br>
          <label for="" class="label-4">'.$puesto.'</label> <br> <br>
          <label for="" class="label-2">Nombre de la empresa</label><br><br>
          <label for="" class="label-4">'.$empresa.'</label><br><br>
          <label for="" class="label-2">Fecha de inicio</label><br><br>
          <label for="" class="label-4">'.$inicio.'</label><br><br>
          <label for="" class="label-2">Fecha de fin</label><br><br>
          <label for="" class="label-4">'.$fin.'</label><br><br>
          <label for="" class="label-2">Actividades relevantes</label><br><br>
          <label for="" class="label-4">'.$act1.'</label><br><br> 
        </div>';}};
        echo $salida;
        ?>
      </div>  
      <!-- Certificaciónes -->
      <div class="divisor">
        <p class="subtitulo-1">Certificaciónes</p>
        <hr>
      </div>

      <div class="formulario-certificaciones">
        <!-- Nombre certificación -->
        <?php $resultado=$base->mostrarCertificaciones($identificador);
        if ($resultado == true) {
          $salida='';
          for ($i = 0; $i < count($resultado); $i++) {
          $nomCert=$resultado[$i]['NomCerExt'];
          $inst=$resultado[$i]['OrgCerExt'];  
         $salida.='<div class="campo">
          <label for="" class="label-2">Nombre de la certificación</label><br><br>
          <label for="" class="label-4">'.$nomCert.'</label><br><br> 
          <label for="" class="label-2">Institución emismora</label><br><br>
          <label for="" class="label-4">'.$inst.'</label><br><br> 
        </div>';}}; 
        echo $salida;
        ?>
      </div>

    </section>
  </main>
</body>
<script src="js/Reg_CV.js"></script>
</html>