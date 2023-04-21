<!-- <script src="../../view/login/js/verificar_permiso_empresa.js"></script> -->
<?php
$id=$_GET['id'];
include_once('../../model/empresa/Mostrar_Ofertas.php');
$base = new MostrarOfertas();
$base->instancias();
$resultado = $base->mostrarOferta($id);
if ($resultado == true) {
  $sid = $resultado[0]["IdEmpBol"];
  $nombre = $resultado[0]["VacEmpBol"];
  $req = $resultado[0]["ReqAcaEmpBol"];
  $reqtec = $resultado[0]["ReqTecEmpBol"];
  $desc = $resultado[0]["DesEmpBol"];
  $bruto = $resultado[0]["SalBrutoEmpBol"];
  $mens = $resultado[0]["SalNetoEmpBol"];
  $hin = $resultado[0]["HrIniEmpBol"];
  $hfin = $resultado[0]["HrFinEmpBol"];
  $calle = $resultado[0]["CalleEmpBol"];
  $exp = $resultado[0]["AñoEmpBol"];
  $tel = $resultado[0]["TelEmpBol"];
  $cor= $resultado[0]["CorreoEmpBol"];
}
$resultado = $base->mostrarJornada($id);
if ($resultado == true) {
  $jor=$resultado[0]["TipoJor"];
}
$resultado = $base->mostrarModalidad($id);
if ($resultado == true) {
  $mod=$resultado[0]["TipoMod"];
}
$resultado = $base->mostrarColonia($id);
if ($resultado == true) {
  $col=$resultado[0]["nomcolonia"];
  $cp=$resultado[0]["codpostal"];
  $mun=$resultado[0]["nommunicipio"];
  $edo=$resultado[0]["nomestado"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>
    <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/socio-asociado/Reg_Ofertas.css">


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
              <li><a id="" href="../../view/empresa/Reg_Ofertas.html">Registrar</a></li>
              <li><a id="" href="../../view/empresa/Vista_Ofertas.html">Mostrar</a></li>
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
      <button class="btn-cerrar-session btn" onclick="window.location.href = '../../controller/login/logout.php' " >Cerrar sesión</button>
    </div>
  </header>
    <main>
        <section class="section-main">
          <div class="cabezera">
            <h3 class="h3">Oferta</h2>
        <form action="" id="formula">        
              <p class="subtitulo-1">Datos vacante</p>
              <hr>
          </div>
          <!-- Datos generales avacante -->
          <div class="formulario-generales">
            <!-- Nombre -->
            <div class="campo">
              <label for="" class="label-2">Nombre de la vacante:</label>
              <br><label for="" class="label-4"><?php echo $nombre; ?></label>
              <div class="campo">
                <br>
                <label for="" class="label-2"> Requisitos académicos:</label>
                <br><label for="" class="label-4"><?php echo $req; ?></label>
              </div>
              <br>
              <div class="campo">
                <label for="" class="label-2">Requisitos técnicos:</label>
                <br><label for="" class="label-4"><?php echo $reqtec; ?></label>
              </div>
              <br>
            </div>
            <!-- Expectativa salarial bruta -->
            </div>
          <div class="formulario-descripcion">
            <label for="" class="label-2">Descripción del puesto:</label>
            <br><label for="" class="label-4"><?php echo $desc; ?></label>
          </div>
          <br>
          <!--PARTE DOS-->
			<p class="subtitulo-1"> Domicilio laboral</p>
			<hr size="1px" />
			<div class="contenedor-formulario">

				<div class="grupo-input">
					<div class="label-form">
						<p class="label-2">Código postal</p>
            <br><label for="" class="label-4"><?php echo $cp; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Calle y número</p>
            <br><label for="" class="label-4"><?php echo $calle; ?></label>
					</div>
                    <br>
                    <div class="label-form">
					    <p class="label-2">Colonia</p>
              <br><label for="" class="label-4"><?php echo $col; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Ciudad</p>
            <br><label for="" class="label-4"><?php echo $mun; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Estado</p>
            <br><label for="" class="label-4"><?php echo $edo; ?></label>
					</div>
				</div>
				
				
			</div>
          <!-- Datos del trabajo -->
			<p class="subtitulo-1"> Datos trabajo</p>
			<hr size="1px" />
			<div class="contenedor-formulario">
                <!-- Forma de trabajo  -->
				<div class="grupo-input">
					<div class="label-form">
					    <p class="label-2">Forma de trabajo</p>
              <br><label for="" class="label-4"><?php echo $mod; ?></label>
					</div>
                    <br>
                    <div class="label-form">
					    <p class="label-2">Jornada laboral</p>
              <br><label for="" class="label-4"><?php echo $jor; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Años de experiencia</p>
            <br><label for="" class="label-4"><?php echo $exp; ?> años</label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Salario bruto</p>
            <br><label for="" class="label-4">$ <?php echo $bruto; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Salario mensual</p>
            <br><label for="" class="label-4">$ <?php echo $mens; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Hora de inicio</p>
            <br><label for="" class="label-4"><?php echo $hin; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Hora de finalización</p>
            <br><label for="" class="label-4"><?php echo $hfin; ?></label>
					</div>
                    <br>  
                    <div class="label-form">
						<p class="label-2">Teléfono</p>
            <br><label for="" class="label-4"><?php echo $tel; ?></label>
					</div>
                    <br>
                    <div class="label-form">
						<p class="label-2">Correo electrónico</p>
            <br><label for="" class="label-4"><?php echo $cor; ?></label>
					</div>
			
				</div>
			     </div>
        </form>
        </section>
      </main>
</body>
</html>