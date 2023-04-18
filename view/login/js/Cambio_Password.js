const campo_password = document.getElementById("password");
const campo_password_confirmacion = document.getElementById("password_confirmacion");
const formulario = document.getElementById("formulario");

window.addEventListener("load", (e)=>{

    let formulario_data = new FormData();
    formulario_data.append("sesion","nada");
    fetch("../../controller/login/Cambio_De_Password.php",
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
    






let baderas = {
    bcontra: false,
     bcontra_conf: false
}
const expresiones = {
    password:/^(?=(?:.*\d){1})(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){1})(?=(?:.*[@$\#\-_.!*\/+]){1})\S{8,16}$/
}
formulario.addEventListener("submit",(e)=>{

    e.preventDefault();
    let formulario_data = new FormData(formulario);
    if(baderas.bcontra && baderas.bcontra_conf){
        fetch("../../controller/login/cambio_de_password.php",
        {
            method:"POST",
            body: formulario_data
        })
        .then(response => response.json())
        .then(respuesta =>{

            if(respuesta[0].lenght != 0){
                window.location.href = respuesta[0];
            }else{
                alert("No se pudo cambiar la contraseña")
            }
           
        });
    }

});

// expresiones regulares para la contraseña
/* password*/
campo_password.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	campo_password.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    // Eliminar el ultimo espaciado
   .trim();
   let valorInput2 = e.target.value;
    if (!expresiones.password.test(valorInput2)) {
        campo_password.style.border = "3px solid red";
        baderas.bcontra = false
	}else{
        campo_password.removeAttribute("style");
        baderas.bcontra = true
    }
    let valorpassword = campo_password_confirmacion.value;
    if((valorpassword == valorInput2) == false){
        campo_password_confirmacion.style.border = "3px solid red";
        bcontra_conf = false
    }else{
        campo_password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true
    }

});
/* password confirmacion*/
campo_password_confirmacion.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	campo_password_confirmacion.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    .trim();
    let valorInput2 = e.target.value;

    if (!expresiones.password.test(valorInput2)) {
        campo_password_confirmacion.style.border = "3px solid red";
        baderas.bcontra_conf = false
	}else{
        campo_password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true
        let valorpassword = campo_password.value;
        if((valorpassword == valorInput2) == false){
            campo_password_confirmacion.style.border = "3px solid red";
            bcontra_conf = false
        }
    }

    
});
