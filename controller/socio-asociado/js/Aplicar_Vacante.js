window.onload = function () {
  fetch("../../controller/socio-asociado/Aplicar_Vacante.php")
    .then(response => response.json())
    .then(respuesta => {
      console.log(respuesta);

      let resultado = respuesta;

      if (resultado == "sintemario") {
        alert('Para poder aplicar a la oferta es necesario que complete su CV. Por favor, diríjase al módulo "MI CV" y complete su información');
        window.location.href = "../../view/socio-asociado/Bolsa_Trabajo.html";
      }
      else {
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
        console.log("Datos academicos: ", datos_academicos);
        console.log("Datos laborales: ", datos_laborales);

        let clave = continuacion_datos_generales[0]
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

        document.getElementById("id-usuario").innerHTML = clave;
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
        document.getElementById("objetivo").style.overflowY = "scroll";

        const formulario_academico = document.getElementById("academico-1");
        for (let i = 0; i < datos_academicos.length; i++) {
          const div1 = document.createElement("div");
          div1.classList.add("campo");

          const label_carrera = document.createElement("label");
          label_carrera.classList.add("label-2");
          label_carrera.textContent = "Nombre de la carrera";

          const input_carrera = document.createElement("input");
          input_carrera.classList.add("input-format-2");
          input_carrera.id = "carrera-" + i;
          input_carrera.readOnly = true;
          input_carrera.value = datos_academicos[i][0];

          const div2 = document.createElement("div");
          div2.classList.add("campo");

          const label_cedula = document.createElement("label");
          label_cedula.classList.add("label-2");
          label_cedula.textContent = "Número de cédula";

          const input_cedula = document.createElement("input");
          input_cedula.classList.add("input-format-2");
          input_cedula.id = "cedula-" + i;
          input_cedula.readOnly = true;
          input_cedula.value = datos_academicos[i][1];

          div1.appendChild(label_carrera);
          div1.appendChild(input_carrera);

          div2.appendChild(label_cedula);
          div2.appendChild(input_cedula);

          formulario_academico.appendChild(div1);
          formulario_academico.appendChild(div2);
        }

        const formualrio_experiencia = document.getElementById("experiencia-1");
        for (let i = 0; i < datos_laborales.length; i++) {
          const div1 = document.createElement("div");
          div1.classList.add("campo");

          const label_puesto = document.createElement("label");
          label_puesto.classList.add("label-2");
          label_puesto.textContent = "Puesto que desempeñaba";

          const input_puesto = document.createElement("input");
          input_puesto.classList.add("input-format-2");
          input_puesto.id = "puesto-antiguo-" + i;
          input_puesto.readOnly = true;
          input_puesto.value = datos_laborales[i][3];

          const div2 = document.createElement("div");
          div2.classList.add("campo");

          const label_empresa = document.createElement("label");
          label_empresa.classList.add("label-2");
          label_empresa.textContent = "Nombre de la empresa";

          const input_empresa = document.createElement("input");
          input_empresa.classList.add("input-format-2");
          input_empresa.id = "empresa-antigua-" + i;
          input_empresa.readOnly = true;
          input_empresa.value = datos_laborales[i][0];

          const div3 = document.createElement("div");
          div3.classList.add("campo");

          const label_fecha = document.createElement("label");
          label_fecha.classList.add("label-2");
          label_fecha.textContent = "Periodo de inicio";

          const input_fecha = document.createElement("input");
          input_fecha.type = "date";
          input_fecha.classList.add("input-format-2");
          input_fecha.id = "periodo-inicio-antigua-" + i;
          input_fecha.readOnly = true;
          input_fecha.value = datos_laborales[i][1];

          const div4 = document.createElement("div");
          div4.classList.add("campo");

          const label_fecha_fin = document.createElement("label");
          label_fecha_fin.classList.add("label-2");
          label_fecha_fin.textContent = "Periodo de finalización";

          const input_fecha_fin = document.createElement("input");
          input_fecha_fin.type = "date";
          input_fecha_fin.classList.add("input-format-2");
          input_fecha_fin.id = "periodo-fin-antigua-" + i;
          input_fecha_fin.readOnly = true;
          input_fecha_fin.value = datos_laborales[i][2];

          const div5 = document.createElement("div");
          div5.classList.add("campo");
          div5.classList.add("campo-textarea");

          const label_actividades = document.createElement("label");
          label_actividades.classList.add("label-2");
          label_actividades.textContent = "Actividades relevantes";

          const input_actividades = document.createElement("textarea");
          input_actividades.classList.add("input-format-2");
          input_actividades.id = "actividad-antigua-" + i;
          input_actividades.readOnly = true;
          input_actividades.value = datos_laborales[i][4];
          input_actividades.style.overflowY = "scroll";

          div1.appendChild(label_puesto);
          div1.appendChild(input_puesto);

          div2.appendChild(label_empresa);
          div2.appendChild(input_empresa);

          div3.appendChild(label_fecha);
          div3.appendChild(input_fecha);

          div4.appendChild(label_fecha_fin);
          div4.appendChild(input_fecha_fin);

          div5.appendChild(label_actividades);
          div5.appendChild(input_actividades);

          formualrio_experiencia.appendChild(div1);
          formualrio_experiencia.appendChild(div2);
          formualrio_experiencia.appendChild(div3);
          formualrio_experiencia.appendChild(div4);
          formualrio_experiencia.appendChild(div5);
        }

        const formulario_certificaciones = document.getElementById("formulario-certificaciones");
        if (datos_certificaciones.length > 2) {

          let lista_certificaciones = [];
          for (let i = 0; i < datos_certificaciones.length; i += 4) {
            let aux = [];
            aux.push(datos_certificaciones[i]);
            aux.push(datos_certificaciones[i + 1]);
            lista_certificaciones.push(aux);
          }

          for (let i = 0; i < lista_certificaciones.length; i++) {
            const div1 = document.createElement("div");
            div1.classList.add("campo");
            div1.classList.add("expand");

            const label_certificacion = document.createElement("label");
            label_certificacion.classList.add("label-2");
            label_certificacion.textContent = "Nombre de la certificación";

            const input_certificacion = document.createElement("input");
            input_certificacion.classList.add("input-format-2");
            input_certificacion.classList.add("expand");
            input_certificacion.id = "certificacion-" + i;
            input_certificacion.readOnly = true;
            input_certificacion.value = lista_certificaciones[i][0];

            const div2 = document.createElement("div");
            div2.classList.add("campo");

            const label_institucion = document.createElement("label");
            label_institucion.classList.add("label-2");

            const input_institucion = document.createElement("input");
            input_institucion.classList.add("input-format-2");
            input_institucion.id = "institucion-" + i;
            input_institucion.readOnly = true;
            input_institucion.value = lista_certificaciones[i][1];

            div1.appendChild(label_certificacion);
            div1.appendChild(input_certificacion);

            div2.appendChild(label_institucion);
            div2.appendChild(input_institucion);

            formulario_certificaciones.appendChild(div1);
            formulario_certificaciones.appendChild(div2);
          }
        }
        else {
          const label_sin_certificaciones = document.createElement("label");
          label_sin_certificaciones.classList.add("label-2");
          label_sin_certificaciones.textContent = "No se encontraron certificaciones";

          formulario_certificaciones.appendChild(label_sin_certificaciones);
        }
      }
    });
}

function aplicar() {
  const id_usuario = document.getElementById("id-usuario");

  let valor_id_bolsa = (new URLSearchParams(location.search)).get('id');;
  let valor_id_usuario = id_usuario.textContent;

  let url = "../../controller/socio-asociado/Enviar_Vacante.php"
  let form = new FormData()

  form.append("id_bolsa", valor_id_bolsa)
  form.append("id_usuario", valor_id_usuario)

  fetch(url, {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(JSON => resultados(JSON))
    .catch(error => console.log(error))

  function resultados(JSON) {
    if (JSON == "Ya has aplicado a esta vacante") {
      alert("Ya has aplicado a esta vacante");
      window.location.href = "../../view/socio-asociado/Bolsa_Trabajo.html";
    }
    else {
      alert("Se ha aplicado a la vacante");
      window.location.href = "../../view/socio-asociado/Bolsa_Trabajo.html";
    }
  }
}