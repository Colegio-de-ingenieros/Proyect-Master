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

var fila_2 = 0;
var fila_3 = 0;

function nueva_carrera_1() {
  if(fila_3 == 1 && fila_2 == 0){
    let boton1 = document.getElementById("botones-1");
    let boton2 = document.getElementById("botones-2");
    let formulario2 = document.getElementById("academico-2");

    boton1.style.display = "none";
    formulario2.style.display = "grid";
    boton2.style.display = "none";
    fila_2 = 1;
  }
  else if(fila_3 == 0 && fila_2 == 0){
    let boton1 = document.getElementById("botones-1");
    let boton2 = document.getElementById("botones-2");
    let formulario2 = document.getElementById("academico-2");

    boton1.style.display = "none";
    formulario2.style.display = "grid";
    boton2.style.display = "block";
    fila_2 = 1;
  }

}

function cancelar_carrera_1() {

  let boton1 = document.getElementById("botones-1");
  let boton2 = document.getElementById("botones-2");
  let formulario2 = document.getElementById("academico-2");
  let carrera2 = document.getElementById("carrera-2");
  let cedula2 = document.getElementById("cedula-2");

  boton1.style.display = "block";
  boton2.style.display = "none";
  formulario2.style.display = "none";


  carrera2.value = "";
  cedula2.value = "";
  fila_2 = 0;
}

function nueva_carrera_2() {
  let boton2 = document.getElementById("botones-2");
  let formulario3 = document.getElementById("academico-3");
  let boton3 = document.getElementById("botones-3");

  boton2.style.display = "none";
  formulario3.style.display = "grid";
  fila_3 = 1;
}

function cancelar_carrera_2() {
  if(fila_2 == 1 && fila_3 == 1){
    let boton2 = document.getElementById("botones-2");
    let formulario3 = document.getElementById("academico-3");
    let carrera3 = document.getElementById("carrera-3");
    let cedula3 = document.getElementById("cedula-3");

    boton2.style.display = "block";

    formulario3.style.display = "none";

    carrera3.value = "";
    cedula3.value = "";
    fila_3 = 0;
  }
  else if(fila_2 == 0 && fila_3 == 1){
    let boton2 = document.getElementById("botones-2");
    let formulario3 = document.getElementById("academico-3");
    let carrera3 = document.getElementById("carrera-3");
    let cedula3 = document.getElementById("cedula-3");

    boton2.style.display = "none";

    formulario3.style.display = "none";

    carrera3.value = "";
    cedula3.value = "";
    fila_3 = 0;
  }
  
}