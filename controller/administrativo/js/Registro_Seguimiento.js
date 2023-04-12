const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
}

function verSeleccion(e) {
  if (this.checked) {
    let tipo=this.value
    //console.log(this.value)
    let url = "../../controller/administrativo/Registro_Seguimiento.php";

    let form = new FormData();
    form.append("tipo", tipo);

    fetch(url, {
      method: "POST",
      body: form
    })
        .then(response => response.json())
        .then(data => {
          console.log(data)
          rellenar_nombre_tipo(data);
      })
  }
}

function rellenar_nombre_tipo(datos) {
  document.getElementById("nombre").innerHTML = "";
  datos.forEach(registro => {
      var optionElement = document.createElement("option");
      optionElement.value = registro[0];
      optionElement.text = registro[1];
      document.getElementById("nombre").appendChild(optionElement);
  });
  
}