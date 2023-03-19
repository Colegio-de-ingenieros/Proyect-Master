let bRFC = false  

const expresiones = {
    rfc: /^[A-Z0-9]{13}$/,
    precio: /^[0-9.]{1,100}$/,
    descripcion: /^[a-zA-ZÁ-ý0-9\s"-.,]{1,10000}$/
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