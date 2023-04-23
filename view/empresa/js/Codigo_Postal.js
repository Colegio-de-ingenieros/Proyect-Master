/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */
let estado = document.getElementById("estado");
let ciudad = document.getElementById("ciudad");

document.getElementById("cpPerso").addEventListener('blur', (e) => {
    let contenido =  document.getElementById("cpPerso").value;
    
    if(contenido.length == 5){
        //console.log(contenido);
        let formulario_data = new FormData();
        formulario_data.append("cpPerso",contenido);
        

        fetch("../../controller/registro/codigo_postal.php",
        {
            method: 'POST',
            body: formulario_data,
        })
        .then(response => response.json())
        .then(data => {
            if(data.length != 0){
                rellenar_lista(data);
            }else{
                alert("Codigo postal inválido");
                estado.value = "";
                ciudad.value = "";
                const select = document.getElementById("colonia");
                    for (let i = select.options.length; i >= 0; i--) {
                      select.remove(i);
                    }
                select.appendChild(new Option("Seleccione su colonia", ""));
            }
            
        });

    }
  });

function rellenar_lista(datos) {
    estado.value = "";
    ciudad.value = "";

    document.getElementById("colonia").innerHTML = "";
    estado.value = datos[0][3]
    ciudad.value = datos[0][2]

    
    datos.forEach(registro => {
        var optionElement = document.createElement("option");
        optionElement.value = registro[0];
        optionElement.text = registro[1];
        document.getElementById("colonia").appendChild(optionElement);
    });
}