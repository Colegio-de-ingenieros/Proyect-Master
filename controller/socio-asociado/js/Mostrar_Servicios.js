const headhunter = document.getElementById("radio_headhunter");
const outplacement = document.getElementById("radio_outplacement");

const caja_mensaje = document.getElementById("mensaje");
const cnt_tabla = document.getElementById("tabla_contenedor");
const opciones = document.getElementById("opciones");


window.onload = function () {
  let url = "../../controller/socio-asociado/Mostrar_Servicios.php";
  let fecha = "0000-00-00";

  let data = new FormData();
  data.append("servicio", "all");
  data.append("fecha", fecha);

  fetch(url, {
    method: 'POST',
    body: data
  })
    .then(response => response.json())
    .then(data => resultados(data, "all"))
    .catch(error => console.log(error));
};

headhunter.addEventListener("click", function () {
  let url = "../../controller/socio-asociado/Mostrar_Servicios.php";
  let fecha = "0000-00-00";

  let data = new FormData();
  data.append("servicio", "headhunter");
  data.append("fecha", fecha);

  fetch(url, {
    method: 'POST',
    body: data
  })
    .then(response => response.json())
    .then(data => resultados(data, "headhunter"))
    .catch(error => console.log(error));
});

outplacement.addEventListener("click", function () {
  let url = "../../controller/socio-asociado/Mostrar_Servicios.php";
  let fecha = "0000-00-00";

  let data = new FormData();
  data.append("servicio", "outplacement");
  data.append("fecha", fecha);

  fetch(url, {
    method: 'POST',
    body: data
  })
    .then(response => response.json())
    .then(data => resultados(data, "outplacement"))
    .catch(error => console.log(error));
});


function resultados(json, llamada) {

  console.log("Resultado del valor de llamada: ", llamada);
  console.log("Resultado del contenido del objeto: ", json);

  if (json.length == 0 && llamada == "all") {
    document.querySelector("table tbody").innerHTML = "";
    cnt_tabla.style.display = 'none';
    caja_mensaje.innerText = "No se encontraron resultados";
    opciones.style.display = 'none';
  }
  else if (json.length == 0 && ((llamada == "headhunter") || (llamada == "outplacement"))){
    document.querySelector("table tbody").innerHTML = "";
    cnt_tabla.style.display = 'none';
    caja_mensaje.style.display = 'block';
    caja_mensaje.innerText = "No se encontraron resultados";

  }
  else if (json.length != 0 & ((llamada == "headhunter") || (llamada == "outplacement") || (llamada == "all"))) {
    cnt_tabla.style.display = 'block';
    caja_mensaje.style.display = 'none';
    const tableBody = document.querySelector("table tbody");
    tableBody.innerHTML = "";
    json.forEach(rowData => {
      let row = document.createElement('tr');

      //* Tipo de servicio
      let ServiceCell = document.createElement('td');
      let ServiceText = document.createTextNode(rowData[0]);
      ServiceCell.appendChild(ServiceText);
      row.appendChild(ServiceCell);

      //* Fecha de aplicación del servicio
      let DateCell = document.createElement('td');
      let DateText = document.createTextNode(rowData[1]);
      DateCell.appendChild(DateText);
      row.appendChild(DateCell);

      //* Estado del servicio
      let StateCell = document.createElement('td');
      let Status = rowData[2];

      if (Status == "0") {
        let StateText = document.createTextNode("En espera");
        StateCell.appendChild(StateText);
        row.appendChild(StateCell);
      }
      else if (Status == "1") {
        let StateText = document.createTextNode("Aceptado");
        StateCell.appendChild(StateText);
        row.appendChild(StateCell);
      }
      else if (Status == "2") {
        let StateText = document.createTextNode("Rechazado");
        StateCell.appendChild(StateText);
        row.appendChild(StateCell);
      }
      else if (Status == "3") {
        let StateText = document.createTextNode("Cancelado");
        StateCell.appendChild(StateText);
        row.appendChild(StateCell);
      }

      if (Status != "3") {
        //* Acciones para el servicio
        let ActionCell = document.createElement('td');
        const ActionText = document.createElement('button');
        ActionText.classList.add("btn", "btn-small", "btn-danger");

        const icon3 = document.createElement("i");
        icon3.classList.add("ti", "ti-backspace-filled");
        ActionText.appendChild(icon3);

        ActionText.addEventListener("click", function () {
          let respuesta = confirm("¿Está seguro de eliminar el servicio?");
          if (respuesta) {
            let url = "../../controller/socio-asociado/Cancelar_Servicio.php";

            let data = new FormData();
            data.append("id", rowData[3]);

            fetch(url, {
              method: 'POST',
              body: data
            })
              .then(response => response.json())
              .then(data => {
                if (data == "Servicio cancelado") {
                  alert("Servicio cancelado");
                  location.reload();
                }
                else {
                  alert("No se pudo cancelar el servicio");
                }
              }
              )
              .catch(error => console.log(error));

          }

        });

        ActionCell.appendChild(ActionText);
        row.appendChild(ActionCell);
      }
      else {
        let ActionCell = document.createElement('td');
        let ActionText = document.createTextNode("No disponible");
        ActionCell.appendChild(ActionText);
        row.appendChild(ActionCell);
      }
      tableBody.appendChild(row);

    });
  }
};