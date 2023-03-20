let bRFC = false  
let bNom = false
let bAP = false
let bAM = true
let bEmail = false
let bandPas1 = false
let bandPas2 = false
let bandTel = false

let botonRegresar = document.getElementById("boton_registro");
botonRegresar.addEventListener("click", (e) => {

    if (bRFC==false){
        caja_rfc.style.border = "3px solid red";
    }else if(bNom==false){
        caja_nombre.style.border = "3px solid red";
    }else if(bAP==false){
        caja_ap_paterno.style.border = "3px solid red";
    }else if(bAM==false){
        caja_ap_materno.style.border = "3px solid red";
    }else if(bEmail==false){
        caja_correo.style.border = "3px solid red";
    }else if(bandTel==false){
        caja_telefono.style.border = "3px solid red";
    }else if(bandPas1==false){
        caja_contra.style.border = "3px solid red";
    }else if(bandPas2==false){
        caja_contra_verificar.style.border = "3px solid red";
    }else{
        validar(true);
    }
});

const expresiones = {
    rfc: /^[A-Z0-9]{13}$/,
    nombre:/^[a-zA-ZÁ-ý.\s]{3,40}$/,
    apellidos:/^[a-zA-ZÁ-ý\s]{3,20}$/,
    apeMa:/^[a-zA-ZÁ-ý\s]{0,20}$/,
    email:/^[a-zA-Z0-9.-_+]+@[a-zA-Z]+\.[a-zA-Z]/,
    telefono:/^[0-9]{10}$/,
    passw:/^[a-zA-Z0-9üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]{8,255}$/
}

formulario.caja_rfc.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_rfc.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
    .replace(/[a-záéíóúÁÉÍÓÚñÑ]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.rfc.test(valorInput)) {
        caja_rfc.style.border = "3px solid red";
        bRFC = false
	}else{
        caja_rfc.removeAttribute("style");
        bRFC = true
    }
    //validar(bRFC);
})

/* Input del nombre del trabajador*/
formulario.caja_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_nombre.value = valorInput
   // Eliminar numeros
   .replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    if (!expresiones.nombre.test(valorInput)) {
        caja_nombre.style.border = "3px solid red";
        bNom = false
	}else{
        caja_nombre.removeAttribute("style");
        bNom = true
    }
    //validar(bNom);
})

/* Input del apellido paterno*/
formulario.caja_ap_paterno.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    formulario.caja_ap_paterno.value = valorInput
// Eliminar numeros
.replace(/[0-9]/g, '')
// Eliminar caracteres especiales
.replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

    if (!expresiones.apellidos.test(valorInput)) {
        caja_ap_paterno.style.border = "3px solid red";
        bAP = false
    }else{
        caja_ap_paterno.removeAttribute("style");
        bAP = true
    }
    //validar(bAP);
})

/* Input del apellido materno*/
formulario.caja_ap_materno.addEventListener('keyup', (e) => {
let valorInput = e.target.value;

formulario.caja_ap_materno.value = valorInput
// Eliminar numeros
.replace(/[0-9]/g, '')
// Eliminar caracteres especiales
.replace(/[üâäàåçê♪ëèïîì·ÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

if (!expresiones.apeMa.test(valorInput)) {
    caja_ap_materno.style.border = "3px solid red";
    bAM = false
}else{
    caja_ap_materno.removeAttribute("style");
    bAM = true
}
//validar(bAM);
})

formulario.caja_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.email.test(valorInput)) {
        caja_correo.style.border = "3px solid red";
        bEmail = false
	}else{
        caja_correo.removeAttribute("style");
        bEmail = true
    }
    //validar(bEmail);
})

/* Input telefono*/
formulario.caja_telefono.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_telefono.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
	// Eliminar letras
	.replace(/\D/g, '')
	// Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.telefono.test(valorInput)) {
        caja_telefono.style.border = "3px solid red";
        bandTel = false
	}else{
        caja_telefono.removeAttribute("style");
        bandTel = true
    }
    //validar(bandTel);
})

/* Input de la constrasenia*/
formulario.caja_contra.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_contra.value = valorInput
    // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar caracteres especiales
    //.replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
        // Eliminar el ultimo espaciado
    .trim();

    if (!expresiones.passw.test(valorInput)) {
        caja_contra.style.border = "3px solid red";
        bandPas1 = false
	}else{
        caja_contra.removeAttribute("style");
        bandPas1 = true
    }
    validarPassword2();
    //validar(bandPas1);
})

/* Input de la confirmacion de la constrasenia*/
formulario.caja_contra_verificar.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.caja_contra_verificar.value = valorInput
    // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar caracteres especiales
    //.replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
        // Eliminar el ultimo espaciado
    .trim();

    validarPassword2();
})

// verifica que la contrasenia y su confirmacion coincidan
const validarPassword2 = () =>{
    const inputPass1 = document.getElementById('caja_contra');
    const inputPass2 = document.getElementById('caja_contra_verificar');

    if (inputPass1.value !== inputPass2.value){
        caja_contra_verificar.style.border = "3px solid red";
        bandPas2 = false
    }else{
        caja_contra_verificar.removeAttribute("style");
        bandPas2 = true
    }
    //validar(bandPas2);
}



/*Funcion que se encarga de habiliatar o deshabilitar el boton, segun el valor del parametro que reciba*/
function validar(bandera){
    const guardar = document.getElementById('boton_registro');
    if(bandera == true ){        
        guardar.removeAttribute("style");
        guardar.disabled=false;
        //console.log("pase validacion");
        
    }
    else{
        guardar.style.border = "3px solid red";        
        guardar.disabled=true;
        //console.log("no pase validacion");

    }

}