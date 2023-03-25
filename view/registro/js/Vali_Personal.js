/* Declara una variable global */
/* Declara una variable global */
let bandNom = false
let bandAP = false
let bandAM = true
let bandEmail = false
let bandContra = false
let bandConfiContra = false
let bandCedu = false
let bandTelF = false
let bandTelM = false

let bandCP = false
let bandCalle = false
let bandColonia = false
let bandCiudad = false
let bandEstado = false

let bandCerti = false
let bandNomCerti = false
let bandOrgCerti = false
let bandFechaICerti = false
let bandFechaFCerti = false
let bandMaxG = false
let bandPasantia = false

let bandEmpLab = false
let bandPuesto = false
let bandCorreoLab = false
let bandExtTelMofi = false
let bandTelMofi = false
let bandFunciones = false
let bandAntecedentes = false
let bandVerifidica = false
let bandAviso = false

const expresiones = {
    nombre:/^[a-zA-ZÁ-ý\s.]{3,40}$/,
    apellidos:/^[a-zA-ZÁ-ý\s]{3,20}$/,
    email:/^[a-zA-Z0-9.-_+]+@[a-zA-Z]+\.[a-zA-Z]/,
    passw:/^[a-zA-Z0-9üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]{8,255}$/,
    cedula:/^[0-9]{8}/,
    telefono:/^[0-9]{10}/,
    codigoP:/^[0-9]{5}/,
    exten:/^[0-9]{3}$/,
    nombre_c:/^[a-zA-ZÁ-ý\s.,]{3,40}$/,
    calle:/^[a-zA-ZÁ-ý\s0-9#-.]{3,100}$/,
    noCert:/^[0-9]{6}$/,
}

/* Input nombres */
formulario.nomPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nomPerso.value = valorInput
    // Eliminar numeros
    .replace(/[0-9]/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')
   

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

    if(valorInput !==""){
        formulario.apePPerso.value = valorInput
        // Eliminar numeros
        .replace(/[0-9]/g, '')
         // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
    
        if (!expresiones.apellidos.test(valorInput)) {
            formulario.apePPerso.style.border = "3px solid red";
            bandAP = false;
        }else{
            formulario.apePPerso.removeAttribute("style");
            bandAP = true;
        }
        validar(bandAP);
    }
	
});

/* Input apellidos */
formulario.apeMPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){
        formulario.apeMPerso.value = valorInput
    // Eliminar numeros
    .replace(/[0-9]/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

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
   .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Üáéíóú¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\+=\[\]{};':"\\|,<>\/?]/g, '')
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

/* Input contraseña */
formulario.contraPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.contraPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   //.replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\=\[\]{};':\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.passw.test(valorInput)) {
        formulario.contraPerso.style.border = "3px solid red";
        bandContra = false;
	}else{
        formulario.contraPerso.removeAttribute("style");
        bandContra = true;
    }
    validarPassword2();
    validar(bandContra);
});

/* password confirmacion*/
formulario.confiContraPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.confiContraPerso.value = valorInput
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
    const inputPass1 = document.getElementById('contraPerso');
    const inputPass2 = document.getElementById('confiContraPerso');

    if (inputPass1.value !== inputPass2.value){
        confiContraPerso.style.border = "3px solid red";
        bandConfiContra = false
    }else{
        confiContraPerso.removeAttribute("style");
        bandConfiContra = true
    }
    validar(bandConfiContra);
}

/* Input cedula*/
formulario.cedulaPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.cedulaPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar letras
	.replace(/\D/g, '')
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
});

/* Input telefono fijo*/
formulario.telFPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){
        formulario.telFPerso.value = valorInput
        // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar letras
        .replace(/\D/g, '')
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

    if(valorInput !==""){
        formulario.telMPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar letras
	.replace(/\D/g, '')
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
    }
	
});

/* Input codigo postal*/
formulario.cpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.cpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar letras
	.replace(/\D/g, '')
     // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.codigoP.test(valorInput)) {
        formulario.cpPerso.style.border = "3px solid red";
        bandCP = false;
	}else{
        formulario.cpPerso.removeAttribute("style");
        bandCP = true;
    }
    validar(bandCP);
});

/* Input calle*/
formulario.callePerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.callePerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    if (!expresiones.calle.test(valorInput)) {
        formulario.callePerso.style.border = "3px solid red";
        bandCalle = false;
	}else{
        formulario.callePerso.removeAttribute("style");
        bandCalle = true;
    }
    validar(bandCalle);
});


/* Input nombre certificaciones*/
formulario.nomCert.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){
        formulario.nomCert.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

        if (!expresiones.nombre_c.test(valorInput)) {
            formulario.nomCert.style.border = "3px solid red";
            bandNomCerti = false;
        }else{
            formulario.nomCert.removeAttribute("style");
            bandNomCerti = true;
        }
        validar(bandNomCerti);
    }
});

/* Input organizacion certificaciones*/
formulario.orgCert.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.orgCert.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.nombre_c.test(valorInput)) {
        formulario.orgCert.style.border = "3px solid red";
        bandOrgCerti = false;
	}else{
        formulario.orgCert.removeAttribute("style");
        bandOrgCerti = true;
    }
    validar(bandOrgCerti);
    }
});

/* Input nombre empresa*/
formulario.nomEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.nomEmpPerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*_+\-=\[\]{};\\|<>\?]/g, '')

    if (!expresiones.nombre_c.test(valorInput)) {
        formulario.nomEmpPerso.style.border = "3px solid red";
        bandEmpLab = false;
	}else{
        formulario.nomEmpPerso.removeAttribute("style");
        bandEmpLab = true;
    }
    validar(bandEmpLab);
    }
});

/* Input puesto empresa*/
formulario.puestoEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.puestoEmpPerso.value = valorInput

    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*_+\-=\[\]{};\\|<>\/?]/g, '')

    if (!expresiones.nombre_c.test(valorInput)) {
        formulario.puestoEmpPerso.style.border = "3px solid red";
        bandPuesto = false;
	}else{
        formulario.puestoEmpPerso.removeAttribute("style");
        bandPuesto = true;
    }
    validar(bandPuesto);
    }
});

/* Input correo empresa*/
formulario.correoEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.correoEmpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Üáéíóú¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\+=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.correoEmpPerso.style.border = "3px solid red";
        bandCorreoLab = false;
	}else{
        formulario.correoEmpPerso.removeAttribute("style");
        bandCorreoLab = true;
    }
    validar(bandCorreoLab);
}
});

/* Input ext telefono fijo*/
formulario.ExtTelFEmp.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.ExtTelFEmp.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar letras
	.replace(/\D/g, '')
     // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.exten.test(valorInput)) {
        formulario.ExtTelFEmp.style.border = "3px solid red";
        bandExtTelMofi = false;
	}else{
        formulario.ExtTelFEmp.removeAttribute("style");
        bandExtTelMofi = true;
    }
    validar(bandExtTelMofi);
    }
});

/* Input telefono fijo empresa*/
formulario.telFEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    if(valorInput !==""){

    
	formulario.telFEmpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar letras
	.replace(/\D/g, '')
     // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario.telFEmpPerso.style.border = "3px solid red";
        bandTelMofi = false;
	}else{
        formulario.telFEmpPerso.removeAttribute("style");
        bandTelMofi = true;
    }
    validar(bandTelMofi);
    }
});

/* Input puesto empresa*/
formulario.funcionEmpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

    
    if(valorInput !==""){

    
	formulario.funcionEmpPerso.value = valorInput
     // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|+<>\/?]/g, '')

    if (!expresiones.nombre_c.test(valorInput)) {
        formulario.funcionEmpPerso.style.border = "3px solid red";
        bandFunciones = false;
	}else{
        formulario.funcionEmpPerso.removeAttribute("style");
        bandFunciones = true;
    }
    validar(bandFunciones);
    }
});

const boton_enviar = document.getElementById("boton_registrar");
boton_enviar.addEventListener("click",(e)=>{

    if(bandNom == false){
        formulario.nomPerso.style.border = "3px solid red";
    }else if(bandAP == false){
        formulario.apePPerso.style.border = "3px solid red";
    }else if(bandAM == false){
        formulario.apeMPerso.style.border = "3px solid red";
    }else if(bandEmail == false){
        formulario.correoPerso.style.border = "3px solid red";
    }else if(bandContra == false){
        formulario.contraPerso.style.border = "3px solid red";
    }else if(bandConfiContra == false){
        formulario.confiContraPerso.style.border = "3px solid red";
    }else if(bandCedu == false){
        formulario.cedulaPerso.style.border = "3px solid red";
    }else if(bandTelF == false){
        formulario.telFPerso.style.border = "3px solid red";
    }else if(bandTelM == false){
        formulario.telMPerso.style.border = "3px solid red";
    }else if(bandCP == false){
        formulario.cpPerso.style.border = "3px solid red";
    }else if(bandCalle == false){
        formulario.callePerso.style.border = "3px solid red";
    }else if(bandCerti == false){
        formulario.noCert.style.border = "3px solid red";
    }else if(bandNomCerti == false){
        formulario.nomCert.style.border = "3px solid red";
    }else if(bandOrgCerti == false){
        formulario.orgCert.style.border = "3px solid red";
    }else if(bandEmpLab == false){
        formulario.nomEmpPerso.style.border = "3px solid red";
    }else if(bandPuesto == false){
        formulario.puestoEmpPerso.style.border = "3px solid red";
    }else if(bandCorreoLab == false){
        formulario.correoEmpPerso.style.border = "3px solid red";
    }else if(bandExtTelMofi == false){
        formulario.ExtTelFEmp.style.border = "3px solid red";
    }else if(bandTelMofi == false){
        formulario.telFEmpPerso.style.border = "3px solid red";
    }else if(bandFunciones == false){
        formulario.funcionEmpPerso.style.border = "3px solid red";
    }else{
        validar(true);
    }


});

function validar(bandera){
    const guardar = document.getElementById('boton_registrar');
    if(bandera == false ){        
        guardar.style.border = "3px solid red";        
        guardar.disabled=true;
        //console.log("no pase validacion");
        
    }
    else{
        guardar.removeAttribute("style");
        guardar.disabled=false;
        //console.log("pase validacion");
        

    }

}