<!-- <?php
/* recibir id */
$id = $_GET['id'];
/* echo $id;
echo "hola"; */


include_once('../../model/administrativo/Ver_Cursos.php');

$respuesta = '';
$bd = new VerCurso();
$bd->BD();
/* mostrar los datos */
$datos = $bd->cursos_disponibles($id);
$datost = $bd->temas($id);
$datoss = $bd->tema($id);
/* $theme = $bd->tema($id); */
/* $datoss = $bd->subtemas($id); */

    for ($i = 0; $i < count($datos); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $clave = $datos[$i]["ClaveCur"];
        $nombre = $datos[$i]["NomCur"];
        $duracion = $datos[$i]["DuracionCur"]; 
        $objetivo = $datos[$i]["ObjCur"];   
        $estatus = $datos[$i]["EstatusCur"];  
}


$respuesta .= ' -->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver más de un curso</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Reg_Cursos.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Ver_Cursos.css">
  <link rel="icon" href="../../public/img/ciscig-notch.png" sizes="32x32">
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
        <button class="btn-cerrar-session btn" onclick="window.location.href = \'../../controller/login/Logout.php \'">Cerrar sesión</button>
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
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Trabajadores.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Trabajadores.html">Mostrar</a></li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="fa-solid fa-circle-check"></i>
                Certificaciones
              </a>

              <ul>
                <li><a id="menuSucursal1" href="../../view/administrativo/Reg_Certificaciones.html">Registrar</a></li>
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Certificaciones.html">Mostrar</a></li>
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
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_Proyectos.html">Mostrar</a></li>
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
                <li><a id="menuSucursal2" href="../../view/administrativo/Vista_ReporteGral.html">General</a></li>
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
                <li><a id="menuSucursal1" href="../../view/administrativo/Vista_Ofertasadmin.html">Ofertas</a></li>
              </ul>
            </li>

          </ul>
        </nav>
      </div>
    </div>

  </header>

  <!-- llama al archivo que genera el excel -->
  <script languaje="javascript">
    function generar() {
      location.href = "../../controller/administrativo/Excel_Temario_Cursos.php?id=' . $id . '";
    }
  </script>

  <div class="section-botones">
    <a target="_blank" href="../../controller/administrativo/Pdf_cursos.php?id='.$id. '"
      style="text-decoration: none; font-size: 1rem; font-weight: 600;padding: 6px 12px;background: var(--color-primary);color: var(--color-white);border-radius: var(--radius-2);">Descargar
      temario en PDF</a>
    <br>
    <a target="_blank" href="#"
      style="text-decoration: none; font-size: 1rem; font-weight: 600;padding: 6px 12px;background: var(--color-primary);color: var(--color-white);border-radius: var(--radius-2);"
      onclick="generar()">Descargar temario en Excel</a>
  </div>

  <main>

    <section>
      <h1 class="h4">'. $nombre .'</h1>
      <h4>'. $clave .'</h4>
    </section>

    <section>
      <h2 class="h5">Objetivo</h2>
      <p>'. $objetivo .'</p>
    </section>

    <section>
      <h2 class="h5">Duración</h2>
      <h1 class="lead-2">'. $duracion .' hrs</h1>
    </section>

    <section>
      <h2 class="h5">Temario</h2>

    </section>
    
    <section class="section-temario">
      <p>';

      $idtemasl = [];
			$nomtemasl = [];

			$datost = $bd->t($id);
			if ($datost) {
				for ($i = 0; $i < count($datost); $i++) {
					$tem = $datost[$i]["NomTema"];
					$iden = $datost[$i]["IdTema"];


					array_push($idtemasl, ((int)$iden));
					array_push($nomtemasl, $tem);
				}

					//aplica ordenacion burbuja para ordenar los temas en numeros del menor al mayor
				for ($i = 0; $i < count($idtemasl); $i++) {
					for ($j = 0; $j < count($idtemasl); $j++) {
						if ($idtemasl[$i] < $idtemasl[$j]) {
							$aux = $idtemasl[$i];
							$aux1 = $nomtemasl[$i];
							$nomtemasl[$i] = $nomtemasl[$j];
							$idtemasl[$i] = $idtemasl[$j];
							$idtemasl[$j] = $aux;
							$nomtemasl[$j] = $aux1;
						}
					}
				}
				
			
				for ($i = 0; $i < count($idtemasl); $i++) {
					$respuesta .= '<h3 class="subtitulo-1">'.$nomtemasl[$i] .'</h3><br>';
					$datoss = $bd->s($tem,((string)$idtemasl[$i]));
					$idsubtemasl = [];
					$nomsubtemasl = [];
					if ($datoss) {

						for ($j = 0; $j < count($datoss); $j++) {
							$te = $datoss[$j]["NomSubT"];
							$idss = $datoss[$j]["IdSubT"]; 
							array_push($idsubtemasl, ((int)$idss));
							array_push($nomsubtemasl, $te);
						}

						//aplicar burbuja para ordenar los subtemas(id)
						for ($is = 0; $is < count($idsubtemasl); $is++) {
							for ($js = 0; $js < count($idsubtemasl); $js++) {
								if ($idsubtemasl[$is] < $idsubtemasl[$js]) {
									$aux = $idsubtemasl[$is];
									$aux1 = $nomsubtemasl[$is];
									$nomsubtemasl[$is] = $nomsubtemasl[$js];
									$idsubtemasl[$is] = $idsubtemasl[$js];
									$idsubtemasl[$js] = $aux;
									$nomsubtemasl[$js] = $aux1;
								}
							}
						}

						for ($il = 0; $il < count($idsubtemasl); $il++) {
							$respuesta .= '<h4 >'.$nomsubtemasl[$il] .'</h4><br>';
							

						}
					}
				}
		


					
			}
			else 
			{
				$respuesta .= '<h3>No hay temas registrados</h3><br>';
			}
			$respuesta .= '		
    </section>
  </main>

</body>
<!-- ';
$respuesta .= '</html>';
echo $respuesta;
?> -->