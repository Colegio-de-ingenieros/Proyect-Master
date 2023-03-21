<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualización proyectos</title>
    <script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
	<link rel="stylesheet" href="../../public/css/administrativo/Vista_Proyectos.css">
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
					  <li><a id="menuSucursal1" href="#">Registrar</a></li>
					  <li><a id="menuSucursal2" href="#">Visualizar</a></li>
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
		<section class="section-main">
			<div class="cabezera">
				<h4 class="subtitulo-1">Visualización / Consulta</h4>
			</div>
			<hr>

			<form action="" class="formulario-de-vista" id="formulario-vista">
				<div class="grupo-input">
					<div class="input-form">
						<input type="search" class="input-format2" placeholder="Search">				
					</div>
				</div>

				<div class="table">
					<div class="header_table">
					<?php include('../../controller/administrativo/Mostrar_Proyectos.php'); ?>
						<!--<table>
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Fecha de inicio</th>
									<th>Fecha de finalización</th>
									<th>Monto</th>
									<th>Objetivo</th>
									<th>Acciones</th>
								</tr>
							</thead>
						</table>-->
					</div>
				</div>
				

				
			</form>
		</section>
	</main>	
        
    </div>
</body>

</html>