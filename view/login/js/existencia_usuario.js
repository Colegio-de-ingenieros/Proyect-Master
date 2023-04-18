const contenedor = document.getElementById("Mensaje");
const campo_usuario = document.getElementById("usuario");
const formulario = document.getElementById("formulario");

formulario.addEventListener("submit",(e)=>{

    e.preventDefault();
    let formulario_data = new FormData(formulario);
    if(campo_usuario.value.length == 0 ){
        alert("Debe escribir su usuario");
    }else{
        fetch("../../controller/login/existencia_usuario.php",
        {
            method:"POST",
            body: formulario_data
        })
        .then(response => response.json())
        .then(respuesta =>{
            if(respuesta[0] == 0){
                mostrar_mensaje();
            }else{
                window.location.href = respuesta[1];
            }
            
        });
    }

    


});

function mostrar_mensaje() {

    if(contenedor.hasChildNodes()){
        contenedor.removeChild(contenedor.firstChild)
    }
   
    let etiqueta_p = document.createElement("p");
    let texto = document.createTextNode("El usuario no existe");
    etiqueta_p.appendChild(texto);
    contenedor.appendChild(etiqueta_p);
    
    

    
}