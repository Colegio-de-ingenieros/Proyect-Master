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
    listOfLists = listOfLists.map(list => list.slice(0, 15));
    
    let tarjetas = document.getElementById("cards");

    for (let i = 0; i < listOfLists.length; i++) {
      body = `
        <div class="card" onclick="mostrar_modal('${listOfLists[i][0]}')">

        <div class="card-content">
          <p class="titulo-vacante">${listOfLists[i][1]}</p>

          <div class="info-1">
            <p class="empresa"><i class="ti ti-id-badge-2"></i>Ofrecido por: <span class="nombre-empresa">${listOfLists[i][0]}</span></p>
            <p class="lugar"><i class="ti ti-map-2"></i>${listOfLists[i][12]}</p>

            <p class="salario"><i class="ti ti-cash"></i>${listOfLists[i][6]}</p>
            <p class="jornada"><i class="ti ti-hourglass-empty"></i>${listOfLists[i][13]}</p>
          </div>
        </div>
      </div>
      `;
      /* crea los elementos dentro de tarjetas */
      tarjetas.innerHTML += body;
    }
  }
}
