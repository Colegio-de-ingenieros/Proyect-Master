!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de certificaciones</title>
	<script src="https://kit.fontawesome.com/f8c41f1595.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../../public/css/administrativo/plantilla_admin.css">
	<link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
	<header>
		<div class="header_superior">
			<div class="titulo">

				<div class="nombre_ventana">
					<h1 class="nombre_Ventana">Certificaciones</h1>
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
	<form id="formulario">
		<div class="contePlantilla">
			<h3>Registro de certificaciones</h3>
			<br>
			<p class="subtitulo-1">Datos generales</p>
			<hr size="1px" />
			<div class="contenedor-formulario">
				<div class="grupo-input">
					<div class="label-form">
						<p class="label-2">Nombre</p>
					</div>
					<div class="input-form">
						<input type="text" class="input-format" placeholder="Ingrese el nombre aquí" name="inputNombre" , id="inputNombre" required>
					</div>
				</div>

				<div class="grupo-input">
					<div class="label-form">
						<p class="label-2">Logo</p>
					</div>
					<div class="input-form">
						<input type="file" class="input-format" placeholder="File" name="inputLogo" , id="inputLogo" required>
					</div>
				</div>

				<div class="grupo-input">
					<div class="label-form">
						<p class="label-2">Precio socio/asociado</p>
					</div>
					<div class="input-form">
						<input type="text" class="input-format" placeholder="Ingrese el precio" name="inputPrecio" , id="inputPrecio" required>
					</div>
				</div>

				<div class="grupo-input2">
					<div class="label-form">
						<p class="label-2">Descripción</p>
					</div>
					<div class="input-form">
						<textarea type="text" class="input-textarea" placeholder="Ingrese la descripción aquí" name="inputDescripcion" , id="inputDescripcion" required></textarea>
					</div>
				</div>
			</div>
			<br>
			<div class="boton_registrar">
				<button type="submit" class="btn-medium btn" name="botonRegistrar" , id="botonRegistrar">Registrar</button>
			</div>
			<br>
			<p class="subtitulo-1">Visualización</p>
			<hr size="1px" />
			<br>
			<div class="table">
				<div class="header_table">
					<?php include('../../controller/administrativo/Mostrar_Certificaciones.php'); ?>
					<!-- <table>
						<thead>
							<tr>
								<th>Logo</th>
								<th>Nombre</th>
								<th>Descripcion</th>
								<th>Precio socio/asociado</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>0001</td>
								<td>Python para principiantes</td>
								<td>200 hrs</td>
								<td>$4870.00</td>
							</tr>
							<tr>
								<td>0002</td>
								<td>C++ desde 0 hasta master</td>
								<td>220 hrs</td>
								<td>$7160.50</td>
							</tr>
							<tr>
								<td>0003</td>
								<td>Java, JavaScript como profesional</td>
								<td>210 hrs</td>
								<td>$2208.58</td>
							</tr>
						</tbody>
					</table> -->
				</div>
			</div>
			<br><br>
		</div>
	</form>
	<script src="js/Vali_Certificaciones.js"></script>
</body>

<script src="../../controller/administrativo/js/Registro_Certificaciones.js"></script>

</html>