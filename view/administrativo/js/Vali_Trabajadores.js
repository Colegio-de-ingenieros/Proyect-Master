let bRFC = false  
let bNom = false
let bAP = false
let bAM = true
let bEmail = false
let bandPas1 = false
let bandPas2 = false


const expresiones = {
    rfc: /^[A-Z0-9]{13}$/,
    nombre:/^[a-zA-ZÁ-ý.\s]{3,40}$/,
    apellidos:/^[a-zA-ZÁ-ý\s]{3,20}$/,
    apeMa:/^[a-zA-ZÁ-ý\s]{0,20}$/,
    email:/^[a-zA-Z0-9.-_+]+@[a-zA-Z]+\.[a-zA-Z]/,
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
    validar(bRFC);
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
    validar(bNom);
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
    validar(bAP);
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
validar(bAM);
})

formulario.correoE.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.correoE.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.email.test(valorInput)) {
        correoE.style.border = "3px solid red";
        bEmail = false
	}else{
        correoE.removeAttribute("style");
        bEmail = true
    }
    validar(bEmail);
})