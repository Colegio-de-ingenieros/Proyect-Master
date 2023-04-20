let listOfLists = [];

window.onload = function () {
  let url = "../../controller/socio-asociado/Bolsa_Trabajo.php";
  let id = 0;

  let form = new FormData();
  form.append("id", id);

  fetch(url, {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(json => resultado(json))
    .catch(error => alert(error));

  const resultado = (json) => {
    listOfLists = json.map(obj => Object.values(obj));
    listOfLists = listOfLists.map(list => list.slice(0, 16));
    
    let tarjetas = document.getElementById("cards");

    for (let i = 0; i < listOfLists.length; i++) {
      let formato_salario_neto = listOfLists[i][7] + "MXN Mensuales"; 

      let valor_jornada = listOfLists[i][13];
      let valor_modalidad = listOfLists[i][14];
      let texto_jornada = "";
      let texto_modalidad = "";
      
      if(valor_jornada === "1"){
        texto_jornada = "Tiempo Completo";
      }
      else if(valor_jornada === "2"){
        texto_jornada = "Medio Tiempo";
      }

      if(valor_modalidad === "1"){
        texto_modalidad = "Híbrido";
      }
      else if(valor_modalidad === "2"){
        texto_modalidad = "Home Office";
      }
      else if(valor_modalidad === "3"){
        texto_modalidad = "Presencial";
      }

      body = `
        <div class="card" onclick="mostrar_modal('${listOfLists[i][0]}')">

        <div class="card-content">
          <p class="titulo-vacante">${listOfLists[i][1]}</p>

          <div class="info-1">
            <p class="empresa"><i class="ti ti-id-badge-2"></i>Ofrecido por: <span class="nombre-empresa">${listOfLists[i][15]}</span></p>
            <p class="lugar"><i class="ti ti-map-2"></i>${listOfLists[i][11]}</p>

            <p class="salario"><i class="ti ti-cash"></i>${formato_salario_neto}</p>
            <p class="jornada"><i class="ti ti-hourglass-empty"></i>${texto_jornada}</p>
          </div>
        </div>
      </div>
      `;
      /* crea los elementos dentro de tarjetas */
      tarjetas.innerHTML += body;
    }

  }
}

const abrir_modal = document.getElementById('open');
const cerrar_modal = document.getElementById('close');
const modal = document.getElementById('modal-container');

function mostrar_modal(id_vacante) {
    modal.classList.add('show');
    let url = "../../controller/socio-asociado/Bolsa_Trabajo.php";
    let form = new FormData();
    form.append("id_vacante", id_vacante);

    fetch(url, {
        method: "POST",
        body: form
    })
        .then(res => res.json())
        .then(json => resultado(json))
        .catch(error => alert(error));

    const resultado = (json) => {
      let listOfLists2 = json.map(obj => Object.values(obj));
      listOfLists2 = listOfLists2.map(list => list.slice(0, 16));
      console.log(listOfLists2);
      for(let i = 0; i < listOfLists2.length; i++){
        if(listOfLists2[i][0] == id_vacante){
          const nombre_vacante = document.getElementById('nombre-vacante');
          const horario = document.getElementById('horario');
          const jornada = document.getElementById('jornada');
          const modalidad = document.getElementById('modalidad');
          const descripcion = document.getElementById('descripcion-vacante');
          const tecnicos = document.getElementById('requisitos-tecnicos');
          const academicos = document.getElementById('requisitos-academicos');
          const experiencia = document.getElementById('experiencia');
          const salario_bruto = document.getElementById('salario-bruto');
          const salario_neto = document.getElementById('salario-neto');
          const telefono = document.getElementById('telefono-empresa');
          const correo = document.getElementById('correo-empresa');

          let formato_horario = listOfLists2[i][8] + " - " + listOfLists2[i][9];
          let formato_salario_bruto = listOfLists2[i][6] + "MXN Mensuales";
          let formato_salario_neto = listOfLists2[i][7] + "MXN Mensuales"; 

          let valor_jornada = listOfLists2[i][13];
          let valor_modalidad = listOfLists2[i][14];
          let texto_jornada = "";
          let texto_modalidad = "";
          
          if(valor_jornada === "1"){
            texto_jornada = "Tiempo Completo";
          }
          else if(valor_jornada === "2"){
            texto_jornada = "Medio Tiempo";
          }

          if(valor_modalidad === "1"){
            texto_modalidad = "Híbrido";
          }
          else if(valor_modalidad === "2"){
            texto_modalidad = "Home Office";
          }
          else if(valor_modalidad === "3"){
            texto_modalidad = "Presencial";
          }

          nombre_vacante.innerHTML = listOfLists2[i][1];
          academicos.innerHTML = listOfLists2[i][2];
          tecnicos.innerHTML = listOfLists2[i][3];
          descripcion.innerHTML = listOfLists2[i][4];
          experiencia.innerHTML = listOfLists2[i][5];
          salario_bruto.innerHTML = formato_salario_bruto;
          salario_neto.innerHTML = formato_salario_neto;
          horario.innerHTML = formato_horario;
          jornada.innerHTML = texto_jornada
          modalidad.innerHTML = texto_modalidad;
          telefono.innerHTML = listOfLists2[i][10];
          correo.innerHTML = listOfLists2[i][11];
        }
      }
    }
}
function ocultar_modal() {
    modal.classList.remove('show');
}