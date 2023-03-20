


/**
 * este archivo se encarga de mandar los datos al controlador 
 * de Alta_empresa.php
 */


let formulario  = document.getElementById("formulario");
formulario.addEventListener("onsubmit",enviar_formulario(e));


function enviar_formulario(e) {
    e.preventDefault();

    /** extraemos los datos del formulario */
    let formulario_data = new FormData(e.target);

    fetch("../controller/Alta_empresa.php",
    {
        method: 'POST',
        body: formulario_data,
    })
    .then(response => response.json())
    .then(respuesta => {
        alert(respuesta);
    });
    
}






