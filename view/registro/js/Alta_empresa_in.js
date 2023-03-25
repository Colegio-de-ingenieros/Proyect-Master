


/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */



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

            rellenar_lista(data);
        });

    }
  });

let formulario  = document.getElementById("formula");
formulario.addEventListener("submit",(e)=>{
    e.preventDefault();
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
        alert("Por favor, seleccione una hora de fin.");
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
        });
        formulario.reset();
        document.getElementById("ciudad").disabled = true;
        document.getElementById("estado").disabled = true;
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
    let lista = [];
    var checked_list = document.querySelectorAll('.checkbox-format');
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











