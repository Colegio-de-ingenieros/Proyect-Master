


/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */
let estado = document.getElementById("estado");
let ciudad = document.getElementById("ciudad");

let cod_postal = document.getElementById("codigo_postal");
cod_postal.addEventListener('blur', () => {
    let contenido =  cod_postal.value;
    if(contenido.length == 5){

        let formulario_data = new FormData();
        formulario_data.append("codigo_postal",contenido);
        

        fetch("/controller/Alta_empresa.php",
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
    let dias = checke();
    /** extraemos los datos del formulario */
    let formulario_data = new FormData(e.target);
    dias.forEach(dia => {
        formulario_data.append("dias[]",dia)
    });
    
    
    fetch("/controller/Alta_empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data[0]);
    });
});
let boton_enviar = document.getElementById("boton_registrar");


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











