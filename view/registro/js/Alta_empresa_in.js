


/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */
let rh_nombre = document.getElementById("rh_nombre");
let rh_paterno = document.getElementById("rh_paterno");
let rh_materno = document.getElementById("rh_materno");
let rh_tele = document.getElementById("rh_tele");
let rh_exten = document.getElementById("rh_exten");
let rh_correo = document.getElementById("rh_correo");

let it_nombre = document.getElementById("ti_nombre");
let it_paterno = document.getElementById("ti_paterno");
let it_materno = document.getElementById("ti_materno");
let it_tele = document.getElementById("ti_tele");
let it_exten = document.getElementById("ti_exten");
let it_correo = document.getElementById("ti_correo");

let ac_nombre = document.getElementById("ac_nombre");
let ac_paterno = document.getElementById("ac_paterno");
let ac_materno = document.getElementById("ac_materno");
let ac_tele = document.getElementById("ac_tele");
let ac_exten = document.getElementById("ac_exten");
let ac_correo = document.getElementById("ac_correo");




document.getElementById("codigo_postal").addEventListener('blur', (e) => {
    let contenido =  document.getElementById("codigo_postal").value;
    
    if(contenido.length == 5){
        
        let formulario_data = new FormData();
        formulario_data.append("codigo_postal",contenido);
        

        fetch("../../controller/registro/Registro_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
            if(data.length != 0){
                rellenar_lista(data);
            }
            
        });

    }
  });

let formulario  = document.getElementById("formula");
formulario.addEventListener("submit",(e)=>{
    e.preventDefault();
    disabled_opcionales(false);
    //traemos los datos del checkbox
    let aviso_privacidad = document.getElementById("avisos1");
    let time_inicio = document.getElementById("inicio");
    let time_fin = document.getElementById("fin");
    let dias = checke();



    if (dias.length == 0) {
        alert("Por favor, seleccione al menos un día laboral.");
    }else if(time_inicio.value.length == 0){
        alert("Por favor, seleccione una hora de inicio.");
    }else if(time_fin.value.length == 0){
        alert("Por favor, seleccione una hora de finalización.");
    }else if(aviso_privacidad.checked == false){
        alert("Para continuar con el registro, debe aceptar el aviso de privacidad.");
    } 

    if (dias.length > 0 && aviso_privacidad.checked && time_inicio.value.length > 0 && time_fin.value.length > 0 ) {
         /** extraemos los datos del formulario */

        let formulario_data = new FormData(e.target);
        dias.forEach(dia => {
            formulario_data.append("dias[]",dia)
        });
    
        
        fetch("../../controller/registro/Registro_Empresa.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
            alert(data[0]);
            if(data[0] != "Esta empresa ya ha sido registrada anteriormente."){
                formulario.reset();
            }
        });
        
        document.getElementById("ciudad").disabled = true;
        document.getElementById("estado").disabled = true;
        disabled_opcionales(true); 
    }
   
});



function rellenar_lista(datos) {
    estado.value = "";
    ciudad.value = "";

    document.getElementById("busqueda_colonia").innerHTML = "";
    estado.value = datos[0][3]
    ciudad.value = datos[0][2]

    
    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        document.getElementById("busqueda_colonia").appendChild(optionElement);
    });
    
}
function checke() {
    // ve si hay dias seleccionados
    let lista = [];
    var checked_list = document.querySelectorAll('.dias');
    for(var i=0; checked_list[i]; ++i){
        if(checked_list[i].checked){
            lista.push(checked_list[i].value);
            
        }
    }
    return lista;
}

function limpiar() {
    estado.value = "";
    ciudad.value = "";  
}
function disabled_opcionales(opcion){

    rh_nombre.disabled = opcion; 
    rh_paterno.disabled = opcion;
    rh_materno.disabled = opcion;
    rh_tele.disabled = opcion;
    rh_exten.disabled = opcion;
    rh_correo.disabled = opcion;

    it_nombre.disabled = opcion;
    it_paterno.disabled = opcion;
    it_materno.disabled = opcion;
    it_tele.disabled = opcion;
    it_exten.disabled = opcion;
    it_correo.disabled = opcion;

    ac_nombre.disabled = opcion;
    ac_paterno.disabled = opcion;
    ac_materno.disabled = opcion;
    ac_tele.disabled = opcion;
    ac_exten.disabled = opcion;
    ac_correo.disabled = opcion;

}











