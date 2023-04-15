let tipo;
window.onload = function () {
  obtener_Participantes() 
}

//Llena las secciones de instructores y participantes
function obtener_Participantes(){
  let valueHidden = document.getElementById("oculto").value; 
  let url = "../../controller/administrativo/Registro_Seguimiento.php";

  let form = new FormData();
  form.append("valueHidden", valueHidden);
  fetch(url, {
    method: "POST",
    body: form
  })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        rellenar_participantes(data);
    }) 
}

function rellenar_participantes(datos) {
  document.getElementById("instructores").innerHTML = "";
  document.getElementById("nom_socio_asociado").innerHTML = "";
  document.getElementById("nom_empresa").innerHTML = "";
  for (var i = 0; i < 3; i++) {
    dato=datos[i]
    if (i==0){
      campo="instructores"
    }else if(i==1){
      campo="nom_socio_asociado"
    }else{
      campo="nom_empresa"
    }
    if (dato.length != 0){
        dato.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        document.getElementById(campo).appendChild(optionElement);
      });
      } else {
        var optionElement = document.createElement("option");
        optionElement.value = "Vacio";
        optionElement.text = "No hay " + campo + " registrados";
        document.getElementById(campo).appendChild(optionElement);
        document.getElementById(campo).disabled = true;
      } 
  }
  document.getElementById("oculto").value=0;
}
//Detecta cuando un radio button es seleccionado, precarga los nombres correspondientes
const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
}

function verSeleccion(e) {
  if (this.checked) {
    tipo=this.value
    let envio=0
    let valueHidden = document.getElementById("oculto").value; 
    let url = "../../controller/administrativo/Registro_Seguimiento.php";

    let form = new FormData();
    form.append("tipo", tipo);
    form.append("valueHidden", valueHidden);
    form.append("envio", envio);

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

let formulario  = document.getElementById("formulario");
formulario.addEventListener("submit",(e)=>{
    e.preventDefault();
    let envio=1
    let nombre = document.getElementById("nombre").value;
    let instructores = document.getElementById("instructores");
    let socio_asociado =document.getElementById("nom_socio_asociado");
    let empresa = document.getElementById("nom_empresa");
    if (nombre=="") {
      alert("Por favor, seleccione el tipo de actividad");
    } else if (document.getElementById("instructores").disabled == true){
      alert("No se han encontrado instructores registrados")
    } else if(instructores.value.length == 0){
      alert("Por favor, seleccione al menos un instructor");
    } else if (document.getElementById("nom_socio_asociado").disabled == true && document.getElementById("nom_empresa").disabled == true){
      alert("No se han encontrado participantes registrados");
    } else if (socio_asociado.value=="" && empresa.value==""){
      alert("Por favor, seleccione al menos un participante, ya sea un socio / asociado o una empresa.");
    }

    if (nombre !=0  && instructores.value !=0  && (socio_asociado.value != 0 || empresa.value != 0 )) {
      let valueHidden = document.getElementById("oculto").value; 
      let auxLisI=[]
      let auxLisS=[]
      let auxLisE=[]
      let lisSocio=[]
      let lisEmp=[]
      let lisIns=obtener_Opciones(auxLisI, instructores)
      
      if (socio_asociado.value.length!=0){
        lisSocio=obtener_Opciones(auxLisS, socio_asociado)
      }
      if (empresa.value.length!=0){
        lisEmp=obtener_Opciones(auxLisE, empresa)
      }

      let url = "../../controller/administrativo/Registro_Seguimiento.php";

      let form = new FormData();
      form.append("tipo", tipo);
      form.append("valueHidden", valueHidden);
      form.append("envio", envio);
      form.append("nombre", nombre);
      form.append("lisIns", lisIns);
      form.append("lisSocio", lisSocio);
      form.append("lisEmp", lisEmp);
      fetch(url, {
        method: "POST",
        body: form
      })
          .then(response => response.json())
          .then(data => {
            console.log(data)
            //el registro fue exitoso
            if (data[0] === 'correcto') {
              alert("Registro exitoso");
              location.href = '../../view/administrativo/Reg_Seguimiento.html';
            }
            else {
                alert($data);
            }
        })   
    }
});

function obtener_Opciones(lista, valores){
  for (var i = 0; i < valores.options.length; i++) {
    if(valores.options[i].selected == true){ 
       lista.push(valores.options[i].value)
      }
  }
  return lista
}