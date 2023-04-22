let puest= false
let puest2= false
let empr = false
let empr2 = false
let carr = false
let carr2 = false
let carr3 = false
let obj = false
let sal = false
let ced = false
let ced2 = false
let ced3 = false
let acti = false
let acti2 = false

const expresiones = {
    nombre:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,40}$/,
    org:/^[a-zA-ZÁ-Ýá-ý.\s]{1,50}$/,
    horas:/^[0-9]{3}$/,
    objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
    precio: /^[0-9]+(.([0-9])+)*$/,
    cedula:/^[0-9]{7,8}/,
    nombre_carrera:/^[0-9a-zA-ZÁ-Ýá-ý0-9.,\s]{1,40}$/,
    empresa:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,100}$/,
    puesto: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,50}/,
}

let actividad2 = document.getElementById("actividad-antigua-2");
actividad2.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    actividad2.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        actividad2.style.border = "3px solid red";
        acti2 = false
    } else {
        actividad2.removeAttribute("style");
        acti2 = true
    }
    /* validar(Obj); */
})

let actividad = document.getElementById("actividad-antigua-1");
actividad.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    actividad.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        actividad.style.border = "3px solid red";
        acti = false
    } else {
        actividad.removeAttribute("style");
        acti = true
    }
    /* validar(Obj); */
})

let puesto1 = document.getElementById("puesto-antiguo-2");
puesto1.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    puesto1.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.puesto.test(valorInput)) {
        puesto1.style.border = "3px solid red";
        puest2 = false
    } else {
        puesto1.removeAttribute("style");
        puest2 = true
    }
    /* validar(Obj); */
})

let puesto = document.getElementById("puesto-antiguo-1");
puesto.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    puesto.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.puesto.test(valorInput)) {
        puesto.style.border = "3px solid red";
        puest = false
    } else {
        puesto.removeAttribute("style");
        puest = true
    }
    /* validar(Obj); */
})

let empresa2 = document.getElementById("empresa-antigua-2");
empresa2.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
   
    empresa2.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.empresa.test(valorInput)) {
        empresa2.style.border = "3px solid red";
        empr2 = false;
	}else{
        empresa2.removeAttribute("style");
        empr2 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let empresa = document.getElementById("empresa-antigua-1");
empresa.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
   
    empresa.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.empresa.test(valorInput)) {
        empresa.style.border = "3px solid red";
        empr = false;
	}else{
        empresa.removeAttribute("style");
        empr = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let carrera3 = document.getElementById("carrera-3");
carrera3.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera3.value = valorInput
    .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera3.style.border = "3px solid red";
        carr3 = false;
	}else{
        carrera3.removeAttribute("style");
        carr3 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let carrera1 = document.getElementById("carrera-2");
carrera1.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera1.value = valorInput
    .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera1.style.border = "3px solid red";
        carr2 = false;
	}else{
        carrera1.removeAttribute("style");
        carr2 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);


let carrera = document.getElementById("carrera-1");
carrera.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera.value = valorInput
    .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera.style.border = "3px solid red";
        carr = false;
	}else{
        carrera.removeAttribute("style");
        carr = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let objetivo = document.getElementById("objetivo");
objetivo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    objetivo.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        obj = false
    } else {
        objetivo.removeAttribute("style");
        obj = true
    }
    /* validar(Obj); */
})

let salario = document.getElementById("salario");
salario.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    salario.value = valorInput

    //elimina los espacios en blanco
    .replace(/\s+/g, '')
    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒª`´·¨°º¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':" \\|,<>\/?]/g, '')

    //elimina las letras
        .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMéáíóúñÑªº¿®ÁÉ±|Í¶ÓÚ]/g, '')
    
    //elimina el ultimo espacio en blanco
        .trim();

    //elimina el ultimo punto agregado si ya habia otro
    if (verificarPuntos(valorInput) == true) {
        salario.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        salario.value = valorInput;
        sal = false
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        //precioAsoc.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        salario.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        salario.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        salario.value = valorInput;
        sal = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        salario.style.border = "3px solid red";
        sal = false
        
    }
    else {
        salario.removeAttribute("style");
        sal = true;
    }

   /*  validar(precioG) */

})

let cedulas= document.getElementById("cedula-1");
cedulas.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        cedulas.style.border = "3px solid red";
        ced = false;
	}else{ 
        cedulas.removeAttribute("style");
        ced = true;
    }
 /*    validar(bandCedu); */
    }
});

let cedulas2 = document.getElementById("cedula-2");
cedulas2.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas2.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        cedulas2.style.border = "3px solid red";
        ced2 = false;
	}else{ 
        cedulas2.removeAttribute("style");
        ced2 = true;
    }
 /*    validar(bandCedu); */
    }
});

let cedulas3 = document.getElementById("cedula-3");
cedulas3.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas3.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        cedulas3.style.border = "3px solid red";
        ced3 = false;
	}else{ 
        cedulas3.removeAttribute("style");
        ced3= true;
    }
 /*    validar(bandCedu); */
    }
});

/* function validar(bandera){
    const guardar = document.getElementById('boton_registrar');

    if(bandera == false){              
        guardar.disabled=true;
        
    }else{
        guardar.disabled=false;
    }

} */


function datos(){
    if (sal == false){
        salario.style.border = "3px solid red";
    }
    else if (obj == false){
        objetivo.style.border = "3px solid red";
    }
    else if (carr == false){
        carrera.style.border = "3px solid red";
    }
    else if (ced == false){
        cedulas.style.border = "3px solid red";
    }
    else if (carr2 == false){
        carrera1.style.border = "3px solid red";
    }
    else if (ced2 == false){
        cedulas2.style.border = "3px solid red"
    }
    else if (carr3 == false){
        carrera3.style.border = "3px solid red";
    }
    else if (ced3 == false){
        cedulas3.style.border = "3px solid red";
    }
    else if (puest == false){
        puesto.style.border = "3px solid red";
    }
    else if (empr == false){
        empresa.style.border = "3px solid red";
    }
    else if (acti == false){
        actividad.style.border = "3px solid red";
    }
    else if (puest2 == false){
        puesto1.style.border = "3px solid red";
    }
    else if (empr2 == false){
        empresa2.style.border = "3px solid red";
    }
    else if (acti2 == false){
        actividad2.style.border = "3px solid red";
    }
    else {
        console.log("todo bien");
    }


    //ibtener el datos de la combo box con id = residencia-campo
    /* var combo = document.getElementById("residencia-campo").value;
    console.log(combo); */
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


//verifica que la cadena no tenga mas de dos decimales
function validarDecimales(cadena){
    var decimales = 0
    var j = cadena.length - 1
    var puntos = 0;
    console.log(cadena);
    for (i = 0; i < cadena.length; i++) {
        if (cadena[i] == '.') {
            puntos++;
        }
    }

    if (puntos == 1) {
        while (cadena[j] != '.' && j > 1) {
            decimales++;
            j--;
            console.log("decimales: " + decimales);
        }

        if (decimales >= 3) {
            return true
        }

        else {
            return false
        }
    }

    else {
        return false
    }

    
}