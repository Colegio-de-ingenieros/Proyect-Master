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
        

        fetch("../../controller/registro/Registro_personal.php",
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

//declara las variables globales
var formulario = document.getElementById('formulario');

//responde cuando hay un click en el boton
formulario.addEventListener('submit', function (e)
{
    e.preventDefault();
    var datos= new FormData(formulario);
        fetch('../../controller/registro/Registro_personal.php', {
            method: 'POST',
            body: datos
        })

        .then(res => res.json())
        .then(data => {
            alert(data);
            });
            formulario.reset();
    
})