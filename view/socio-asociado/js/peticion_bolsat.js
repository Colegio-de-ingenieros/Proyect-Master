fetch("../../controller/socio-asociado/Bolsa_Trabajo2.php")
   .then(response => response.json())
   .then(respuesta => {
      console.log(respuesta); 
       
      let nombre = respuesta[0]['NomPerso'];
      let apellido_paterno = respuesta[0]['ApePPerso'];
      let apellido_materno = respuesta[0]['ApeMPerso'];
      let fecha_nacimiento = respuesta[0]['FechaNacPerso'];
      let telefono = respuesta[0]['TelMPerso'];
      let calle = respuesta[0]['CallePerso'];
      let correo = respuesta[0]['CorreoPerso'];
      let colonia = respuesta[1]['nomcolonia'];
      let municipio = respuesta[1]['nommunicipio'];
      let estado = respuesta[1]['nomestado'];

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

      console.log(respuesta.length);

      // Obtener el elemento del DOM al que se añadirá la nueva caja de texto
      const contenedor = document.getElementById('formulario-certificaciones');

      if (respuesta.length > 2){
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
   else{
      contenedor.textContent = 'No se encontraron certificaciones';
   }
   });