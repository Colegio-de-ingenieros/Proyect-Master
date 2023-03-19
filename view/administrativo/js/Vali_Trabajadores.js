let bRFC = false  
let bNom = false

const expresiones = {
    rfc: /^[A-Z0-9]{13}$/,
    nombre:/^[a-zA-ZÁ-ý\s]{3,40}$/,
    apellidos:/^[a-zA-ZÁ-ý\s]{3,20}$/,
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
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

    if (!expresiones.nombre.test(valorInput)) {
        caja_nombre.style.border = "3px solid red";
        bNom = false
	}else{
        caja_nombre.removeAttribute("style");
        bNom = true
    }
    validar(bNom);
})