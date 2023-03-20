/* Declara una variable global */
let bNomPro = false
let bObjPro = false
let bMonPro = false    

/*Detecta cuando el boton fue presionado*/
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) => {

    if (bNomPro==false){
        nom_proyecto.style.border = "3px solid red";
    }else if(bObjPro=false){
        obj_proyecto.style.border = "3px solid red";
    }else if(bMonPro==false){
        monto_proyecto.style.border = "3px solid red";
    }else{
        validar(true);
    }
});

/*Funciones que define las distinas expresiones para validar los campos*/
const expresiones = {
    NomPro:/^[a-zA-ZÁ-ý0-9\s .,]{1,60}$/,
    ObjPro:/^[a-zA-ZÁ-ý\s ,."]{1,10000}$/,
    MonPro:/^[0-9.]{0,100}$/,

}

/* Input Nombre del Proyecto */
formulario.nombre_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nombre_proyecto.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?]/g, '')
    
    if (!expresiones.NomPro.test(valorInput)) {
        nombre_proyecto.style.border = "3px solid red";
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

/* Input Monto Proyecto*/
formulario.monto_proyecto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.monto_proyecto.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    //Elimina letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '')
    // Eliminar caracteres especiales
   .replace(/[üâäàåçê♪ëèï·îìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    .trim();

    if (!expresiones.MonPro.test(valorInput)) {
        monto_proyecto.style.border = "3px solid red";
        bMonPro = false
	}else{
        monto_proyecto.removeAttribute("style");
        bMonPro = true
    }
    validar(bMonPro);
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