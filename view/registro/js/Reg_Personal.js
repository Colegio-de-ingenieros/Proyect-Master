/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */
let estado = document.getElementById("estadoPerso");
let ciudad = document.getElementById("ciudadPerso");


document.getElementById("cpPerso").addEventListener('blur', (e) => {
    let contenido =  document.getElementById("cpPerso").value;
    
    if(contenido.length == 5){
        
        let formulario_data = new FormData();
        formulario_data.append("cpPerso",contenido);
        

        fetch("/controller/socio-asociado/Reg_personal.php",
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
   
    
    fetch("/controller/socio-asociado/Reg_personal.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data[0]);
    });
});



function rellenar_lista(datos) {
    estado.value = "";
    ciudad.value = "";

    document.getElementById("coloniaPerso").innerHTML = "";
    estado.value = datos[0][3]
    ciudad.value = datos[0][2]

    
    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        document.getElementById("coloniaPerso").appendChild(optionElement);
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