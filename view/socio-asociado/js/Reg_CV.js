function eliminar_carrera(carrera) {
  alert("Se eliminara la carrera: " + carrera);
}

window.onload = function () {
  let url = "../../controller/socio-asociado/Reg_CV.php";
  let id = document.getElementById("id-usuario").textContent;

  let form = new FormData();
  form.append("id", id);
  
  fetch(url, {
    method: "POST",
    body: form
  })
    .then(response => response.json())
    .then(data => arrays(data))
    .catch(error => console.log(error));

  const arrays = (data) => {
    let array = Object.values(data);
    let arreglo = Object.values(array[0]);
    
    let nombre = arreglo[0];
    let apellido_paterno = arreglo[1];
    let apellido_materno = arreglo[2];
    let fecha_nacimiento = arreglo[3];
    let direccion = arreglo[4];

    document.getElementById("nombre-campo").value = nombre;
    document.getElementById("apellido-paterno-campo").value = apellido_paterno;
    document.getElementById("apellido-materno-campo").value = apellido_materno;
    document.getElementById("fecha-nacimiento-campo").value = fecha_nacimiento;
    document.getElementById("direccion-campo").value = direccion;
  }
}