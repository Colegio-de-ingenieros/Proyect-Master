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
    console.log(data);    
    let nombre = data.map(objeto => Object.values(objeto)[0]);
    let apellido_paterno = data.map(objeto => Object.values(objeto)[1]);
    let apellido_materno = data.map(objeto => Object.values(objeto)[2]);
    let fecha_nacimiento = data.map(objeto => Object.values(objeto)[3]);
    let telefono = data.map(objeto => Object.values(objeto)[4]);
    let calle = data.map(objeto => Object.values(objeto)[5]);
    let correo = data.map(objeto => Object.values(objeto)[6]);
    let colonia = data.map(objeto => Object.values(objeto)[7]);
    let municipio = data.map(objeto => Object.values(objeto)[8]);
    let estado = data.map(objeto => Object.values(objeto)[9]);

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
  }
}