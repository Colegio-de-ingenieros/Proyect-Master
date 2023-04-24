window.onload = function () {
  fetch("../../controller/socio-asociado/Aplicar_Vacante.php")
    .then(response => response.json())
    .then(respuesta => {
      /* console.log(respuesta); */
      let datos_generales = Object.values(respuesta[0][0]);
      let datos_direccion = Object.values(respuesta[1][0]);
      let datos_certificaciones = Object.values(respuesta[2][0]);
      let continuacion_datos_generales = Object.values(respuesta[3][0]);
      let datos_academicos = Object.values(respuesta[4]);
      let datos_laborales = Object.values(respuesta[5]);

      console.log("Datos generales: ", datos_generales);
      console.log("Datos direccion: ", datos_direccion);
      console.log("Datos certificaciones: ", datos_certificaciones);
      console.log("Datos continuacion: ", continuacion_datos_generales);
      console.log("Datos academicos: ",  datos_academicos);
      console.log("Datos laborales: ", datos_laborales);

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

      const formulario_academico = document.getElementById("academico-1");

      for (let i = 0; i < datos_academicos.length; i++) {
        const div1 = document.createElement("div");
        div1.classList.add("campo");

        const label_carrera = document.createElement("label");
        label_carrera.classList.add("label-2");
        label_carrera.textContent = "Nombre de la carrera";

        const input_carrera = document.createElement("input");
        input_carrera.classList.add("input-format-2");
        input_carrera.id = "carrera-"+i;
        input_carrera.readOnly = true;
        input_carrera.value = datos_academicos[i][0];

        const div2 = document.createElement("div");
        div2.classList.add("campo");

        const label_cedula = document.createElement("label");
        label_cedula.classList.add("label-2");
        label_cedula.textContent = "Número de cédula";

        const input_cedula = document.createElement("input");
        input_cedula.classList.add("input-format-2");
        input_cedula.id = "cedula-"+i;
        input_cedula.readOnly = true;
        input_cedula.value = datos_academicos[i][1];

        div1.appendChild(label_carrera);
        div1.appendChild(input_carrera);

        div2.appendChild(label_cedula);
        div2.appendChild(input_cedula);

        formulario_academico.appendChild(div1);
        formulario_academico.appendChild(div2);
      }
    });
}