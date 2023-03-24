/* Declara una variable global */
let bNomPro = false
let bObjPro = false
let bMonPro = false  
let bFechaIni = false
let bFechaFin = false
let bCompara = false

/*Detecta cuando el boton fue presionado*/
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) => {

    if (bNomPro==false){
        nom_proyecto.style.border = "3px solid red";
    }else if(bObjPro=false){
        obj_proyecto.style.border = "3px solid red";
    }else if(bMonPro==false){
        monto_proyecto.style.border = "3px solid red";
    }else if(bFechaIni==false){
        ini_proyecto.style.border = "3px solid red";
    }else if(bFechaFin==false){
        fin_proyecto.style.border = "3px solid red";
    }else if(bCompara==false){
        fin_proyecto.style.border = "3px solid red";
    }else{
        validar(true);
    }
});

/*Funciones que define las distinas expresiones para validar los campos*/
const expresiones = {
    NomPro:/^[a-zA-ZÁ-Ýá-ý0-9\s .,]{1,60}$/,
    ObjPro:/^[a-zA-ZÁ-ý\s ,.]{1,10000}$/,
    MonPro: /^[0-9]+(.[0-9])*$/,
    FechaIni:/^[0-9-]{10}$/,
    FechaFin:/^[0-9-]{10}$/,

}

/* Input Nombre del Proyecto */
formulario.nom_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nom_proyecto.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+='\[\]{};:"\\|<>\/?]/g, '')
    
    if (!expresiones.NomPro.test(valorInput)) {
        nom_proyecto.style.border = "3px solid red";
        bNomPro= false
	}else{
        nom_proyecto.removeAttribute("style");
        bNomPro = true
    }
    validar(bNomPro);
})

/* Input Objetivo Proyecto*/
formulario.obj_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.obj_proyecto.value = valorInput
    // Eliminar numeros
	.replace(/[0-9]/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäà·åçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_\-+=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.ObjPro.test(valorInput)) {
        obj_proyecto.style.border = "3px solid red";
        bObjPro = false
	}else{
        obj_proyecto.removeAttribute("style");
        bObjPro = true
    }
    validar(bObjPro);
})

/* Input Fecha Inicio*/
formulario.ini_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ini_proyecto.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèï·îìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\=,\[\]{};':"\\|<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    .trim();

    if (!expresiones.FechaIni.test(valorInput)) {
        ini_proyecto.style.border = "3px solid red";
        bFechaIni = false
	}else{
        ini_proyecto.removeAttribute("style");
        bFechaIni = true
    }
    validar(bFechaIni);
})

/* Input Fecha Fin*/
formulario.fin_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.fin_proyecto.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèï·îìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\=,\[\]{};':"\\|<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    .trim();

    if (!expresiones.FechaFin.test(valorInput)) {
        fin_proyecto.style.border = "3px solid red";
        bFechaFin = false
	}else{
        fin_proyecto.removeAttribute("style");
        bFechaFin = true
    }
    validar(bFechaFin);
})

/*Compara que la fecha fin sea posterior*/
formulario.fin_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    
	formulario.fin_proyecto.value = valorInput
    if( (new Date(ini_proyecto.value).getTime() >= new Date(fin_proyecto.value).getTime()))
    {
        fin_proyecto.style.border = "3px solid red";
        bCompara = false
    }else{
        fin_proyecto.removeAttribute("style");
        bCompara = true
    }
    validar(bCompara);
})

/* Input Monto Proyecto*/
formulario.monto_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
	formulario.monto_proyecto.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèï·îìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=,\[\]{};':"\\|<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    .trim();

    //elimina el ultimo punto agregado si ya habia otro
    if (verificarPuntos(valorInput) == true) {
        monto_proyecto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario.monto_proyecto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        monto_proyecto.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        formulario.monto_proyecto.value = valorInput;
    }
    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.MonPro.test(valorInput)) {
        monto_proyecto.style.border = "3px solid red";
        bMonPro= false
    }

    else {
        monto_proyecto.removeAttribute("style");
        bMonPro = true;
    }

    validar(bMonPro)
})

   

function validar(bandera){
    const registrar = document.getElementById('registrar');
    if(bandera == true){
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
    //alert(cadena.length);
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