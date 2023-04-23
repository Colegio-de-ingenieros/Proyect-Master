window.onload = function () {
  fetch("../../controller/socio-asociado/Aplicar_Vacante.php")
    .then(response => response.json())
    .then(respuesta => {
      console.log(respuesta);
      let datos_generales = respuesta[0];
      let datos_direccion = respuesta[1];
      let datos_certificaciones = respuesta[2];
      let continuacion_datos_generales = respuesta[3];
      let datos_academicos = respuesta[3];
      let datos_laborales = respuesta[4];

      let nombre = datos_generales[1];
      let apellido_paterno = datos_generales[2];
      let apellido_materno = datos_generales[3];
      let fecha_nacimiento = datos_generales[4];
      let telefono = datos_generales[5];
      let calle = datos_generales[8];
      let correo = datos_generales[7];
      let colonia = datos_direccion[0];
      let municipio = datos_direccion[1];
      let estado = datos_direccion[2];
      let descripcion = continuacion_datos_generales[1];  
      let residencia = continuacion_datos_generales[2];
      let expectativa_salarial = continuacion_datos_generales[3];


      document.getElementById("nombre-campo").value = nombre;
      document.getElementById("apellido-paterno-campo").value = apellido_paterno;
      document.getElementById("apellido-materno-campo").value = apellido_materno;
      document.getElementById("fecha-nacimiento-campo").value = fecha_nacimiento;
      document.getElementById("correo-campo").value = correo;
      document.getElementById("telefono-campo").value = telefono;
      document.getElementById("calle-campo").value = calle;
      document.getElementById("colonia-campo").value = colonia;
      document.getElementById("ciudad-campo").value = municipio;
      document.getElementById("estado-campo").value = estado;
      document.getElementById("residencia-campo").value = residencia;
      document.getElementById("salarial-campo").value = expectativa_salarial;
      document.getElementById("objetivo").value = descripcion;

      console.log(respuesta.length);

      // Obtener el elemento del DOM al que se añadirá la nueva caja de texto
      const contenedor = document.getElementById('formulario-certificaciones');

      if (respuesta.length > 2) {
        for (let i = 2; i < respuesta.length; i++) {
          // Crear una nueva caja de texto
          const nuevaCajaTexto = document.createElement('input');

          // Establecer los atributos de la nueva caja de texto
          nuevaCajaTexto.type = 'text';
          nuevaCajaTexto.name = 'nuevo-input';
          nuevaCajaTexto.classList = 'input-format-2';
          let certificacion = respuesta[i]['NomCerExt'];
          nuevaCajaTexto.value = certificacion;
          nuevaCajaTexto.readOnly = true;

          // Añadir la nueva caja de texto al contenedor
          contenedor.appendChild(nuevaCajaTexto);

          const CajaTexto = document.createElement('input');

          // Establecer los atributos de la nueva caja de texto
          CajaTexto.type = 'text';
          CajaTexto.name = 'nuevo-input';
          CajaTexto.classList = 'input-format-2';
          let empresa = respuesta[i]['OrgCerExt'];
          CajaTexto.value = empresa;
          CajaTexto.readOnly = true;

          // Añadir la nueva caja de texto al contenedor
          contenedor.appendChild(CajaTexto);
        }
      }
      else {
        contenedor.textContent = 'No se encontraron certificaciones';
      }
    });
}