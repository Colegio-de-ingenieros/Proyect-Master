const contenedor = document.getElementById("Mensaje");
const campo_usuario = document.getElementById("usuario");
const campo_pass = document.getElementById("password");
const formulario = document.getElementById("formulario_login");

formulario.addEventListener("submit",(e)=>{

    e.preventDefault();
    let formulario_data = new FormData(formulario);
    if(campo_usuario.value.length == 0 || campo_pass.value.length == 0){
        alert("Debe escribir su usuario y contraseña");
    }else{
        fetch("../../controller/login/login.php",
        {
            method:"POST",
            body: formulario_data
        })
        .then(response => response.json())
        .then(respuesta =>{
            if(respuesta[0] == 0){
                mostrar_mensaje(respuesta[1]);
            }else{
                window.location.href = respuesta[1];
            }
            
        });
    }

    


});

function mostrar_mensaje(mensaje) {

    if(contenedor.hasChildNodes()){
        contenedor.removeChild(contenedor.firstChild)
    }
   
    let etiqueta_p = document.createElement("p");
    let texto = document.createTextNode(mensaje);
    etiqueta_p.appendChild(texto);
    contenedor.appendChild(etiqueta_p);
    
    

    
}