
const cerrar_modal = document.getElementById("close");
const guardar_modal = document.getElementById("guardar_modal");
const modal = document.getElementById("modal-container");
const modalContainer = document.getElementById("modal");




function mostrar_modal() {
    
    modal.classList.add("show");
    cerrar_modal.setAttribute("onclick", "ocultar_modal()");
    
}




function ocultar_modal() {
    let respuesta = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(respuesta){
       
        modal.classList.remove("show");
        modal.classList.add("#close");
    }
    
}