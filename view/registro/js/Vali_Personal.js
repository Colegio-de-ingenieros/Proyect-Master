/* Declara una variable global */
let bandNom = false
let bandAP = false
let bandAM = true
let bandEmail = false
let bandCedu = false
let bandTelF = false
let bandTelM = false
let bandCP = false
let bandCalle = false
let bandColonia = false
let bandCiudad = false
let bandEstado = false
let bandCerti = false
let bandMaxG = false
let bandPasantia = false
let bandEmpLab = false
let bandPuesto = false
let bandCorreoLab = false
let bandTelMofi = false
let bandFunciones = false
let bandAntecedentes = false
let bandVerifidica = false
let bandAviso = false

const expresiones = {
    cadenas:/^[a-zA-ZÁ-ý\s]{3,40}$/,
    cadAm:/^[a-zA-ZÁ-ý\s]{0,20}$/,
    email:/^[a-zA-Z0-9.-_+]+@[a-zA-Z]+\.[a-zA-Z]{2,40}/,
    cedula:/^[0-9]{8}/,
    telefono:/^[0-9]{10}/,
    passw:/^[a-zA-Z0-9-_@#./*+]{8,16}$/,
    codigoP:/^[0-9]{5}/
}

/* Input nombres */
formulario.nomPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.Nombre.value = valorInput
    // Eliminar numeros
    .replace(/[0-9]/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

    if (!expresiones.cadenas.test(valorInput)) {
        Nombre.style.border = "3px solid red";
        bandNom = false
	}else{
        Nombre.removeAttribute("style");
        bandNom = true
    }
    validar();
})