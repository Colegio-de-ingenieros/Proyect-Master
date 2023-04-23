const btn_cursos = document.getElementById("cursos");
const btn_certificaciones = document.getElementById("certificaciones");
const btn_proyectos = document.getElementById("proyectos");
const formulario = document.getElementById("formulario");
const cuerpo_tabla = document.getElementById("cuerpo");

btn_cursos.addEventListener("click",(e)=>{
    peticion_nombres("cursos");
});
btn_certificaciones.addEventListener("click",(e)=>{
    peticion_nombres("certificaciones");
});
btn_proyectos.addEventListener("click",(e)=>{
    peticion_nombres("proyectos");
});

function peticion_nombres(tipo){

    let tipo_nombre = new FormData();
    tipo_nombre.append("tipo",tipo);

    fetch("../../controller/administrativo/Mostrar_ReporteIn.php",{
        method:"POST",
        body: tipo_nombre
    }).then(respuesta=> respuesta.json())
      .then(datos=>{

        rellenar_lista(datos);

    });
}

formulario.addEventListener("submit",(e)=>{

    e.preventDefault();
    
    let form_data = new FormData(formulario);

    fetch("../../controller/administrativo/Mostrar_ReporteIn.php",{
        method:"POST",
        body: form_data
    }).then(respuesta=> respuesta.json())
      .then(datos=>{

        rellenar_tabla(datos);

    });

});

//rellenamos el combo nombres
function rellenar_lista(datos) {

    document.getElementById("nombres").innerHTML = "";

    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0] + " " + registro[2];
        optionElement.text = registro[0] + " " + registro[1];
        document.getElementById("nombres").appendChild(optionElement);
    });
    
}

//rellenamos el combo nombres
function rellenar_tabla(datos) {

    cuerpo_tabla.innerHTML = "";

    datos.forEach(registro => {
        var fila = document.createElement("option");
        optionElement.value = registro[0] + " " + registro[2];
        optionElement.text = registro[0] + " " + registro[1];
        cuerpo_tabla.appendChild(optionElement);
    });
    
}


