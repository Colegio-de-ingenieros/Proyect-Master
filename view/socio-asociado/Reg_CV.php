<script src="../../view/login/js/verificar_permiso_socio.js"></script>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro CV - CISCIG</title>
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
        <h3 class="h3">Registro del CV</h2>
          <p class="subtitulo-1">Datos generales</p>
          <hr>
      </div>
      <!-- Datos generales -->
      <div class="formulario-generales">
        <!-- Nombre -->
        <div class="campo">
          <label for="" class="label-2">Nombre*</label>
          <input type="text" class="input-format-2" id="nombre-campo" readonly></input>
        </div>
        <!-- Apellido paterno -->
        <div class="campo">
          <label for="" class="label-2">Apellido Paterno*</label>
          <input type="text" class="input-format-2" id="apellido-paterno-campo" readonly></input>
        </div>
        <!-- Apellido materno -->
        <div class="campo">
          <label for="" class="label-2">Apellido Materno</label>
          <input type="text" class="input-format-2" id="apellido-materno-campo" readonly></input>
        </div>
        <!-- Fecha de nacimiento -->
        <div class="campo">
          <label for="" class="label-2">Fecha de nacimiento*</label>
          <input type="date" class="input-format-2" id="fecha-nacimiento-campo" readonly></input>
        </div>
        <!-- Correo electrónico -->
        <div class="campo">
          <label for="" class="label-2">Correo electrónico*</label>
          <input
            title="El email solo puede contener letras mayúsculas, minúsculas, números y los siguientes caracteres especiales (., -, _, @)."
            type="email" class="input-format-2" placeholder="someone@example.com"></input>
        </div>
        <!-- Telefono -->
        <div class="campo">
          <label for="" class="label-2">Teléfono*</label>
          <input title="El número de teléfono solo puede contener números." type="tel" class="input-format-2"
            placeholder="Ingrese su teléfono aquí"></input>
        </div>
        <!-- Domicilio -->
        <div class="campo">
          <label for="" class="label-2">Domicilio*</label>
          <input type="text" class="input-format-2" id="direccion-campo" readonly></input>
        </div>
        <!-- Cambio de residencia -->
        <div class="campo">
          <label for="" class="label-2">¿Puede cambiar de residencia?*</label>
          <select name="" id="" class="input-format-2">
            <option value="1">No</option>
            <option value="2">Si</option>
          </select>
        </div>
        <!-- Expectativa salarial bruta -->
        <div class="campo">
          <label for="" class="label-2">Expectativa salarial bruta*</label>
          <input title="El campo expectativa salarial bruta solo debe de contener números." type="text"
            class="input-format-2" placeholder="Ingrese su expectativa salarial bruta aquí"></input>
        </div>
      </div>

      <div class="formulario-descripcion">
        <label for="" class="label-2">Descripción profesional*</label>
        <textarea title="Ingrese su descripción profesional." name="" id="" class="input-format-2"
          placeholder="Ingrese la descripción profesional"></textarea>
      </div>
      <!-- Experiencia académica -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia académica</p>
        <hr>
      </div>

      <div class="formulario-academica">
        <!-- Nombre de la carrera -->
        <div id="carrera-1"class="campo">
          <label for="" class="label-2">Nombre de la carrera*</label>
          <input title="El campo nombresolo debe de contener letras." type="text" class="input-format-2" placeholder="Ingrese el nombre de la carrera aquí"></input>
        </div>
        <!-- Número de cédula -->
        <div id="carrera-1"class="campo">
          <label for="" class="label-2">Número de cédula*</label>
          <input title="El campo cédula solo debe de contener números." type="text" class="input-format-2" placeholder="Ingrese el número de cédula aquí"></input>
        </div>

        <div id="carrera-1"class="campo especial">
          <i class="ti ti-trash-x eliminar-item" onclick="eliminar_carrera('carrera-1')"></i>
        </div>
      </div>

      <div class="botones-academica">
        <button class="btn btn-small">Agregar carrera</button>
      </div>

      <!-- Experiencia profesional -->
      <div class="divisor">
        <p class="subtitulo-1">Experiencia profesional</p>
        <hr>
      </div>

      <div class="formulario-experiencia">
        <!-- Puesto que desempeñaba -->
        <div class="campo">
          <label for="" class="label-2">Puesto que desempeñaba*</label>
          <input title="El campo puesto que desempeñaba solo debe de contener letras." type="text"
            class="input-format-2" placeholder="Ingrese el puesto que desempeñaba aquí"></input>
        </div>
        <!-- Nombre de la empresa -->
        <div class="campo">
          <label for="" class="label-2">Nombre de la empresa*</label>
          <input title="El campo nombre de la empresa solo debe de contener letras." type="text" class="input-format-2"
            placeholder="Ingrese el nombre de la empresa aquí"></input>
        </div>
        <!-- Fecha de inicio -->
        <div class="campo">
          <label for="" class="label-2">Fecha de inicio*</label>
          <input type="date" class="input-format-2"></input>
        </div>
        <!-- Fecha de fin -->
        <div class="campo">
          <label for="" class="label-2">Fecha de fin*</label>
          <input type="date" class="input-format-2"></input>
        </div>
        <!-- Actividades relevantes -->
        <div class="campo">
          <label for="" class="label-2">Actividades relevantes*</label>
          <textarea title="Ingrese las actividades relevantes." name="" id="" class="input-format-2"
            placeholder="Ingrese las actividades relevantes aquí"></textarea>
        </div>
      </div>

      <div class="botones-experiencia">
        <button class="btn btn-small">Agregar experiencia</button>
      </div>

      <!-- Certificaciónes -->
      <div class="divisor">
        <p class="subtitulo-1">Certificaciónes</p>
        <hr>
      </div>

      <div class="formulario-certificaciones">
        <!-- Nombre certificación -->
        <div class="campo">
          <label for="" class="label-2">Nombre de la certificación*</label>
          <input title="El campo nombre de la certificación solo debe de contener letras." type="text"
            class="input-format-2" placeholder="Ingrese el nombre de la certificación aquí"></input>
        </div>
        <!-- Organismo que expidió -->
        <div class="campo">
          <label for="" class="label-2">Institución emismora*</label>
          <input title="El campo institución solo debe de contener letras." type="text" class="input-format-2"
            placeholder="Ingrese la institución aquí"></input>
        </div>
      </div>

      <div class="botones-certificaciones">
        <button class="btn btn-small">Agregar certificación</button>
      </div>

      <div class="botones-registro">
        <button class="btn btn-medium">Guardar registro</button>
      </div>

    </section>
    <span id="id-usuario" style="display:none">P0001</span>

  </main>
</body>
<script src="js/Reg_CV.js"></script>
</html>
