/* Declara una variable global */
/* Declara una variable global */
let bandNom = true
let bandAP = true
let bandAM = true
let bandEmail = true
let bandCedu = true
let bandTelF = true
let bandTelM = true

let bandContraold = flase
let bandContra = flase
let bandConfiContra = false

let bandCP = true
let bandCalle = true

let bandNomCerti = false
let bandOrgCerti = false

let bandEmpLab = false
let bandPuesto = false
let bandCorreoLab = false
let bandExtTelMofi = true
let bandTelMofi = false
let bandFunciones = false

const expresiones = {
    nombre:/^[a-zA-ZÁ-Ýá-ý\s.]{1,40}$/,
    apellidos:/^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/,
    email:/^[a-zA-Z0-9.\-_][^@]+@[^@][a-zA-Z]+\.[a-zA-Z](?:.*[\.])?(?:.*[a-zA-Z])?$/,
    passw:/^(?=(?:.*\d){1})(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){1})(?=(?:.*[@$\#\-_.!*\/+]){1})\S{8,16}$/,
    cedula:/^[0-9]{7,8}/,
    telefono:/^[0-9]{10}/,
    codigoP:/^[0-9]{5}/,
    exten:/^[0-9]{3}$/,
    nombre_c:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,60}$/,
    nombre_o:/^[a-zA-ZÁ-Ýá-ý\s.]{1,50}$/,
    calle:/^[a-zA-ZÁ-Ýá-ý\.\s]+([\/\s#]?)((?:.*[0-9\s])?)([a-zA-Z]?){1,100}$/,
    ///^[a-zA-ZÁ-Ýá-ý\.\s]+#?([0-9\s]+)([\/\s]*)([0-9a-zA-ZÁ-Ýá-ý\s]*){1,100}$/,
    nombre_e:/^[a-zA-ZÁ-Ýá-ý0-9.\s]{1,100}$/,
    puesto_e:/^[a-zA-ZÁ-Ýá-ý\s.]{1,50}$/,
    funcion_e:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,60}$/,
}

/* Input nombres */
formulario.nomPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nomPerso.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý\s.]/g, '');
   
    if (!expresiones.nombre.test(valorInput)) {
        formulario.nomPerso.style.border = "3px solid red";
        bandNom = false;
	}else{
        formulario.nomPerso.removeAttribute("style");
        bandNom = true;
    }
    validar(bandNom);
});

/* Input apellidos */
formulario.apePPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    formulario.apePPerso.value = valorInput
    
    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    if (!expresiones.apellidos.test(valorInput)) {
        formulario.apePPerso.style.border = "3px solid red";
        bandAP = false;
    }else{
        formulario.apePPerso.removeAttribute("style");
        bandAP = true;
    }
    validar(bandAP);

	
});

/* Input apellidos */
formulario.apeMPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){
        formulario.apeMPerso.value = valorInput
    
        // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    if (!expresiones.apellidos.test(valorInput)) {
        formulario.apeMPerso.style.border = "3px solid red";
        bandAM = false;
	}else{
        formulario.apeMPerso.removeAttribute("style");
        bandAM = true;
    }
    validar(bandAM);
    }

	
});

/* Input correo */
formulario.correoPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.correoPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.correoPerso.style.border = "3px solid red";
        bandEmail = false;
	}else{
        formulario.correoPerso.removeAttribute("style");
        bandEmail = true;
    }
    validar(bandEmail);
});





/* Input cedula*/
formulario.cedulaPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	formulario.cedulaPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        formulario.cedulaPerso.style.border = "3px solid red";
        bandCedu = false;
	}else{ 
        formulario.cedulaPerso.removeAttribute("style");
        bandCedu = true;
    }
    validar(bandCedu);
    }
});

/* Input telefono fijo*/
formulario.telFPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){
        formulario.telFPerso.value = valorInput
        // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar caracteres especiales
        .replace(/[^0-9]/g, '')
        // Eliminar el ultimo espaciado
        .trim();
    
        if (!expresiones.telefono.test(valorInput)) {
            formulario.telFPerso.style.border = "3px solid red";
            bandTelF = false;
        }else{
            formulario.telFPerso.removeAttribute("style");
            bandTelF = true;
        }
        validar(bandTelF);
    }
	
});

/* Input telefono movil*/
formulario.telMPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    formulario.telMPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario.telMPerso.style.border = "3px solid red";
        bandTelM = false;
	}else{
        formulario.telMPerso.removeAttribute("style");
        bandTelM = true;
    }
    validar(bandTelM);
    
	
});

/* Input contraseña vieja */
formulario1.password_old.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario1.password_old.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.passw.test(valorInput)) {
        formulario1.password_old.style.border = "3px solid red";
        bandContraold = false;
	}else{
        formulario1.password_old.removeAttribute("style");
        bandContraold = true;
    }
    validar(bandContraold);
});

/* Input contraseña */
formulario1.password.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario1.password.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.passw.test(valorInput)) {
        formulario1.password.style.border = "3px solid red";
        bandContra = false;
	}else{
        formulario1.password.removeAttribute("style");
        bandContra = true;
    }
    validarPassword2();
    validar(bandContra);
});

/* password confirmacion*/
formulario1.password_confirmacion.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario1.password_confirmacion.value = valorInput
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
    const inputPass1 = document.getElementById('password');
    const inputPass2 = document.getElementById('password_confirmacion');

    if (inputPass1.value !== inputPass2.value){
        password_confirmacion.style.border = "3px solid red";
        bandConfiContra = false
    }else{
        password_confirmacion.removeAttribute("style");
        bandConfiContra = true
    }
    validar(bandConfiContra);
}


/* Input codigo postal*/
formulario2.cpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario2.cpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.codigoP.test(valorInput)) {
        formulario2.cpPerso.style.border = "3px solid red";
        bandCP = false;
	}else{
        formulario2.cpPerso.removeAttribute("style");
        bandCP = true;
    }
    validar(bandCP);
});

/* Input calle*/
formulario2.callePerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario2.callePerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý0-9#\.\/\s]/g, '');

    if (!expresiones.calle.test(valorInput)) {
        formulario2.callePerso.style.border = "3px solid red";
        bandCalle = false;
	}else{
        formulario2.callePerso.removeAttribute("style");
        bandCalle = true;
    }
    validar(bandCalle);
});


/* Input nombre certificaciones*/
formulario4.nomCert.addEventListener('keyup', (e) => {

	let valorInput = e.target.value;
    let certificaciones=document.getElementById('checkboxcertificacion');

    if(valorInput !="" && certificaciones.checked){
        formulario4.nomCert.value = valorInput

         // Eliminar caracteres especiales
        .replace(/[^a-zA-ZÁ-Ýá-ý0-9\s,.]/g, '');

        if (!expresiones.nombre_c.test(valorInput)) {
            formulario4.nomCert.style.border = "3px solid red";
            bandNomCerti = false;
        }else{
            formulario4.nomCert.removeAttribute("style");
            bandNomCerti = true;
        }
        validar(bandNomCerti);
    }else{
        validar(true);
    }
    
});

/* Input organizacion certificaciones*/
formulario4.orgCert.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let certificaciones=document.getElementById('checkboxcertificacion');

    if(valorInput !="" && certificaciones.checked){

    
	formulario4.orgCert.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s.]/g, '');

    if (!expresiones.nombre_o.test(valorInput)) {
        formulario4.orgCert.style.border = "3px solid red";
        bandOrgCerti = false;
	}else{
        formulario4.orgCert.removeAttribute("style");
        bandOrgCerti = true;
    }
    validar(bandOrgCerti);
    }else{
        validar(true);
    }
});

/* Input nombre empresa*/
formulario5.nomEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	formulario5.nomEmpPerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý0-9\.\s.]/g, '');

    if (!expresiones.nombre_e.test(valorInput)) {
        formulario5.nomEmpPerso.style.border = "3px solid red";
        bandEmpLab = false;
	}else{
        formulario5.nomEmpPerso.removeAttribute("style");
        bandEmpLab = true;
    }
    validar(bandEmpLab);
    }else{
        validar(true);
    }
});

/* Input puesto empresa*/
formulario5.puestoEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	formulario5.puestoEmpPerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s.]/g, '');

    if (!expresiones.puesto_e.test(valorInput)) {
        formulario5.puestoEmpPerso.style.border = "3px solid red";
        bandPuesto = false;
	}else{
        formulario5.puestoEmpPerso.removeAttribute("style");
        bandPuesto = true;
    }
    validar(bandPuesto);
    }else{
        validar(true);
    }
});

/* Input correo empresa*/
formulario5.correoEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	formulario5.correoEmpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.email.test(valorInput)) {
        formulario5.correoEmpPerso.style.border = "3px solid red";
        bandCorreoLab = false;
	}else{
        formulario5.correoEmpPerso.removeAttribute("style");
        bandCorreoLab = true;
    }
    validar(bandCorreoLab);
    }else{
        validar(true);
    }
    
});

/* Input ext telefono fijo*/
formulario5.ExtTelFEmp.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	formulario5.ExtTelFEmp.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.exten.test(valorInput)) {
        formulario5.ExtTelFEmp.style.border = "3px solid red";
        bandExtTelMofi = false;
	}else{
        formulario5.ExtTelFEmp.removeAttribute("style");
        bandExtTelMofi = true;
    }
    validar(bandExtTelMofi);
    }else{
        validar(true);
    }
});

/* Input telefono fijo empresa*/
formulario5.telFEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	formulario5.telFEmpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario5.telFEmpPerso.style.border = "3px solid red";
        bandTelMofi = false;
	}else{
        formulario5.telFEmpPerso.removeAttribute("style");
        bandTelMofi = true;
    }
    validar(bandTelMofi);
    }else{
        validar(true);
    }
});

/* Input funcion empresa*/
formulario5.funcionEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    let laboral=document.getElementById('checkboxlaboral');

    
    if(valorInput !="" && laboral.checked){

    
	formulario5.funcionEmpPerso.value = valorInput
     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý0-9,.\s]/g, '');

    if (!expresiones.nombre_c.test(valorInput)) {
        formulario5.funcionEmpPerso.style.border = "3px solid red";
        bandFunciones = false;
	}else{
        formulario5.funcionEmpPerso.removeAttribute("style");
        bandFunciones = true;
    }
    validar(bandFunciones);
    }else{
        validar(true);
    }
});


const boton_enviar = document.getElementById("btn_generales1");
boton_enviar.addEventListener("click",(e)=>{

    if(bandNom == false){
        formulario.nomPerso.style.border = "3px solid red";
    }else if(bandAP == false){
        formulario.apePPerso.style.border = "3px solid red";
    }else if(bandEmail == false){
        formulario.correoPerso.style.border = "3px solid red";
    }else if(bandTelM == false){
        formulario.telMPerso.style.border = "3px solid red";
    }else{
        validar(true);
    }
});
function validar(bandera1){
    const guardar1 = document.getElementById('btn_generales1');

    if(bandera1 == false){              
        guardar1.disabled=true;
        
    }else{
        guardar1.disabled=false;
    }

}

const boton_enviar2 = document.getElementById("btn_generales2");
boton_enviar.addEventListener("click",(e)=>{

    if(bandNom == false){
        formulario1.bandContraold.style.border = "3px solid red";
    }else if(bandAP == false){
        formulario1.bandContra.style.border = "3px solid red";
    }else if(bandEmail == false){
        formulario1.bandConfiContra.style.border = "3px solid red";
    }else{
        validar(true);
    }
});
function validar(bandera1){
    const guardar2 = document.getElementById('btn_generales2');

    if(bandera1 == false){              
        guardar2.disabled=true;
        
    }else{
        guardar2.disabled=false;
    }

}