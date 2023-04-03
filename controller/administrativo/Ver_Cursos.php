<?php
/* recibir id */
$id = $_GET['id'];
/* echo $id;
echo "hola"; */


include_once('../../model/Ver_Cursos.php');

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

/* echo $clave;
echo $nombre;
echo $duracion;
echo $objetivo;
echo $estatus; */

$respuesta .='
<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
			color: #333;
			margin: 0;
			padding: 0;
            text-align: center;
		}
		
		h1 {
			margin: 0;
		}
		
		main {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 2px 4px rgba(0,0,0,0.2);
		}
		
		section {
			margin-bottom: 40px;
			border-bottom: 1px solid #ccc;
			padding-bottom: 20px;
		}
		
		h2 {
			font-size: 24px;
			margin: 0 0 10px 0;
		}
		h3 {
			text-align: left;
		}
		
		p, ul, ol {
			margin: 0 0 10px 0;
			line-height: 1.5;
		}
		footer {
			background-color: #333;
			color: #fff;
			padding: 20px;
			text-align: center;
		}
		
		footer p {
			margin: 0;
		}

		li {
			text-align: left;
		}
		p {
		}
	</style>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de cursos - CISCIG</title>
  <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Reg_Cursos.css">
  <link rel="stylesheet" href="../../public/css/administrativo/Visualizacion_Cursos.css">

  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-45x45.png" sizes="32x32">
  <link rel="icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png"
    sizes="192x192">
  <link rel="apple-touch-icon" href="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
  <meta name="msapplication-TileImage"
    content="https://ciscig.com.mx/wp-content/uploads/2022/07/LOGO_CISCIG-fav-1-300x300.png">
</head>

<header>
<div class="header_superior">
  <div class="titulo">

	<div class="nombre_ventana">
	  <img class="logo_ciscig" src="../../public/img/LOGO_CISCIG-white.png" width="10px" alt="">
	  <h1 class="nombre_Ventana">Cursos</h1>
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
			<li><a id="menuProducto1" href="#">Visualizar</a></li>
		  </ul>
		</li>

		<li>
		  <a href="#">
			<i class="fa-solid fa-user-tie"></i>
			Trabajadores
		  </a>

		  <ul>
			<li><a id="menuSucursal1" href="../../view/administrativo/Reg_Trabajadores.html">Registrar</a></li>
			<li><a id="menuSucursal2" href="../../view/administrativo/Vista_trabajadores.php">Visualizar</a></li>
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
			<li><a id="menuSucursal1" href="../../view/administrativo/Reg_Cursos.html">Registrar</a></li>
			<li><a id="menuSucursal2" href="../../view/administrativo/Vista_Cursos.php">Visualizar</a></li>
		  </ul>
		</li>

		<li>
		  <a href="#">
			<i class="fa-solid fa-clipboard-list"></i>
			Proyectos
		  </a>

						<ul>
							<li><a id="menuSucursal1" href="../../view/administrativo/Reg_Proyectos.html">Registrar</a></li>
							<li><a id="menuSucursal2" href="../../view/administrativo/Vista_Proyectos.php">Visualizar</a></li>
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
		  </ul>
		</li>
	  </ul>
	</nav>
  </div>
</div>

</header>

	<main>
	<section>
		<h1 style="width: 500px; word-wrap: break-word;">'. $nombre .'</h1>
        <h4>'. $clave .'</h4>
	</section>
		<section>
			<h2>Objetivo</h2>
			<p style="width: 500px; word-wrap: break-word;">'. $objetivo .'</p>
		</section>
		<section>
			<h2>Duración</h2>
            <h1>'. $duracion .' hrs</h1>
		</section>
		<section>
			<h2>Temario</h2>
		</section>
		<section>
			<p>';


			$datost = $bd->t($id);
			if ($datost) {
				for ($i = 0; $i < count($datost); $i++) {
					$tem = $datost[$i]["NomTema"];
					$iden = $datost[$i]["IdTema"];
					$respuesta .= '<h3 style="width: 500px; word-wrap: break-word;">'.$tem .'</h3><br>';
					$datoss = $bd->s($tem,$iden);
					if ($datoss) {
						for ($j = 0; $j < count($datoss); $j++) {
							$te = $datoss[$j]["NomSubT"];
							$respuesta .= '<h4 style="width: 500px;">'.$te .'</h4><br>';
						}                    
					}
				} 
			}
			else 
			{
				$respuesta .= '<h3 style="width: 500px;">No hay temas registrados</h3><br>';
			}
			/* if ($datost) {
				$rec = '';
				for ($i = 0; $i < count($datost); $i++) {
					$tem = $datost[$i]["NomTema"];
					$respuesta .= '<h3 style="width: 500px; word-wrap: break-word;">'.$tem .'</h3><br>';
					// Agregar consulta aquí:
					$theme = $bd->tema($tem);
					if ($theme) {
						for ($j = 0; $j < count($theme); $j++) {
							$sub = $theme[$j]["NomSubT"];    
							$respuesta .= '<ul class="tema">
										  <li class="subtema" style="width: 500px; word-wrap: break-word;">'. $sub .'</li>
										  </ul>';
						}
					}
				}
			} */
			/* $b=0;
            if ($datost){
				$rec='';
            for ($i = 0; $i < count($datost); $i++) {
                $tem = $datost[$i]["NomTema"];
					$respuesta .= '<h3 style="width: 500px; word-wrap: break-word;">'.$tem .'</h3><br>';
						
					}
				}
					

			
					
				$theme = $bd->tema($tem);
					if($theme){
						for ($i = 0; $i < count($theme); $i++) {
						$sub = $theme[$i]["NomSubT"];	
						$respuesta .=
						'<ul class="tema">
					  <li class = "subtema" style="width: 500px; word-wrap: break-word;">'. $sub .'</li>
						</ul>';
					}
				}
			
                
            
            
			
        
		
		else{
				$respuesta .= 'No hay temario';
				$respuesta .=    '</p>';
			} */
		
			$respuesta .= '		</section> 
	</main>

</body>
';
$respuesta .= '</html>';
echo $respuesta;
?>