/* Declara una variable global */
/* Declara una variable global */
let bandNom = false
let bandOrg = false
let bandHrs = false

const expresiones = {
    nombre:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,40}$/,
    org:/^[a-zA-ZÁ-Ýá-ý.\s]{1,50}$/,
    horas:/^[0-9]{1,3}$/,
}

/* Input nombres */
formulario.nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nombre.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý0-9.,\s]/g, '');
   
    if (!expresiones.nombre.test(valorInput)) {
        formulario.nombre.style.border = "3px solid red";
        bandNom = false;
	}else{
        formulario.nombre.removeAttribute("style");
        bandNom = true;
    }
    validar(bandNom);
});

/* Input apellidos */
formulario.organizacion.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    formulario.organizacion.value = valorInput
    
    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý.\s]/g, '');

    if (!expresiones.org.test(valorInput)) {
        formulario.organizacion.style.border = "3px solid red";
        bandOrg = false;
    }else{
        formulario.organizacion.removeAttribute("style");
        bandOrg = true;
    }
    validar(bandOrg);

	
});

/* Input apellidos */
formulario.totalhoras.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    formulario.totalhoras.value = valorInput
    
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();


    if (!expresiones.horas.test(valorInput)) {
        formulario.totalhoras.style.border = "3px solid red";
        bandHrs = false;
    }else{
        formulario.totalhoras.removeAttribute("style");
        bandHrs = true;
    }
    validar(bandHrs);

	
});

const boton_enviar = document.getElementById("boton_registrar");
boton_enviar.addEventListener("click",(e)=>{

    if(bandNom == false){
        formulario.nombre.style.border = "3px solid red";
    }else if(bandOrg == false){
        formulario.organizacion.style.border = "3px solid red";
    }else if(bandHrs == false){
        formulario.totalhoras.style.border = "3px solid red";
    }else{
        validar(true);
    }


});

function validar(bandera){
    const guardar = document.getElementById('boton_registrar');

    if(bandera == false){              
        guardar.disabled=true;
        
    }else{
        guardar.disabled=false;
    }

}