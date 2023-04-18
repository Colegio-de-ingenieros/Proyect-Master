const contenedor = document.getElementById("Mensaje");
const campo_codigo = document.getElementById("codigo");
const formulario = document.getElementById("formulario");
const boton_reenviar = document.getElementById("reenviar");

window.addEventListener("load", (e)=>{

    let formulario_data = new FormData();
    formulario_data.append("sesion","nada");
    fetch("../../controller/login/Comparar_Codigo.php",
    {
        method:"POST",
        body: formulario_data
    })
        .then(response => response.json())
        .then(respuesta =>{
           
            if(respuesta[0] == 0){
                window.location.href = respuesta[1];
            }
            
           
            
    });

});
    


boton_reenviar.addEventListener("click",(e)=>{
    let formulario_data = new FormData();
    formulario_data.append("nuevo_codigo","nada");
    fetch("../../controller/login/Comparar_Codigo.php",
        {
            method:"POST",
            body: formulario_data
        })
       
});

formulario.addEventListener("submit",(e)=>{

    e.preventDefault();
    let formulario_data = new FormData(formulario);
    if(campo_codigo.value.length == 0 ){
        alert("Debe escribir el código");
    }else{
        fetch("../../controller/login/Comparar_Codigo.php",
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


