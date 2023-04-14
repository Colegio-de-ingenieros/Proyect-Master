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
    listOfLists = listOfLists.map(list => list.slice(0, 14));
    console.log(listOfLists);
  }
}

