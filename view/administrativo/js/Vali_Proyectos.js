/* Declara una variable global */
let bNomPro = false
let bObjPro = false
let bMonPro = false  
//let bFechaFin = false

/*Detecta cuando el boton fue presionado*/
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) => {
   /* registrar.disabled=true;*/
    if (ultimoNum(formulario.monto_proyecto.value) == true) {
        bMonPro= false;
        formulario.monto_proyecto.value = formulario.monto_proyecto.value + '0'
    }
    else if (bNomPro==false){
        nom_proyecto.style.border = "3px solid red";
    }else if(bObjPro==false){
        obj_proyecto.style.border = "3px solid red";
    }else if(bMonPro==false){
        monto_proyecto.style.border = "3px solid red";
    }else{
        validar(true);
        /*registrar.disabled=false;*/
    }
});

/*Funciones que define las distinas expresiones para validar los campos*/
const expresiones = {
    NomPro:/^[a-zA-ZÁ-Ýá-ý0-9\s.,]{1,60}$/,
    ObjPro:/^[a-zA-ZÁ-ý\s ,.]{1,10000}$/,
    MonPro:/^([0-9]+\.?[0-9]{0,2})$/,

}

/* Input Nombre del Proyecto */
formulario.nom_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nom_proyecto.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·¨°¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.NomPro.test(valorInput)) {
        nom_proyecto.style.border = "3px solid red";
        bNomPro= false
	}else{
        nom_proyecto.removeAttribute("style");
        bNomPro = true
    }
    //validar(bNomPro);
})

/* Input Objetivo Proyecto*/
formulario.obj_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.obj_proyecto.value = valorInput
    // Eliminar numeros
	.replace(/[0-9]/g, '')
     // Eliminar caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·¨°¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.ObjPro.test(valorInput)) {
        obj_proyecto.style.border = "3px solid red";
        bObjPro = false
	}else{
        obj_proyecto.removeAttribute("style");
        bObjPro = true
    }
    //validar(bObjPro);
})

/* Input Monto Proyecto*/
formulario.monto_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
	formulario.monto_proyecto.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMéáíóúñÑªº¿®ÁÉ±|Í¶ÓÚ]/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèï·îìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=,\[\]{};´':"\\|<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    .trim();

    //elimina el ultimo punto agregado si ya habia otro
    if (verificarPuntos(valorInput) == true) {
        monto_proyecto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario.monto_proyecto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    else if (primeroNum(valorInput) == true) {
        monto_proyecto.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        formulario.monto_proyecto.value = valorInput;
    }
    //verifica que se cumpla con la expresion correpondiente    
    else if (!expresiones.MonPro.test(valorInput)) {
        monto_proyecto.style.border = "3px solid red";
        bMonPro= false
    }

    else {
        monto_proyecto.removeAttribute("style");
        bMonPro = true;
    }

    //validar(bMonPro)
})

   

function validar(bandera){
    const registrar = document.getElementById('registrar');
    if (ultimoNum(formulario.monto_proyecto.value) == true) {
        bMonPro = false;
        registrar.disabled = true;
    }

    else if(bandera == true){
        registrar.disabled=false;
       
    }
    else{
        registrar.disabled=true;
       
    }

}


//funcion para verificar que la cadena no tenga mas de un punto
function verificarPuntos(cadena){
    var puntos = 0;

    for (i = 0; i < cadena.length; i++){
        if (cadena[i] == '.') {
            puntos++;
        }
    }
    if (puntos >= 2) {
        return true
    }
    else {
        return false
    }
}

//funcion para verificar que el primer caracter no sea un punto, retorna true si si es un punto
function primeroNum(cadena){
    if (cadena[0] == '.') {
        return true
    }
    else {
        return false
    }
}

//verifica que si el ultimo caracter de una cadena es un punto
function ultimoNum(cadena)
{
    alert(cadena.length);
    if (cadena.length >= 1) {
        if (cadena[cadena.length - 1] == '.') {
            return true
        }
        else {
            return false
        }
    }
    else {
        return false;
    }
}


