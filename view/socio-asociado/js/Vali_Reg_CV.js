let bandNom = false
let bandOrg = false
let bandHrs = false

const expresiones = {
    nombre:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,40}$/,
    org:/^[a-zA-ZÁ-Ýá-ý.\s]{1,50}$/,
    horas:/^[0-9]{3}$/,
    objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
    precio: /^[0-9]+(.([0-9])+)*$/,
    cedula:/^[0-9]{7,8}/,
    nombre_carrera:/^[0-9a-zA-ZÁ-Ýá-ý0-9.\s]{1,40}$/,
}

let carrera = document.getElementById("carrera-1");
carrera.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera.style.border = "3px solid red";
        bandEmpLab = false;
	}else{
        carrera.removeAttribute("style");
        bandEmpLab = true;
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
        Obj = false
    } else {
        objetivo.removeAttribute("style");
        Obj = true
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
        precioG = false
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
        precioG = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        salario.style.border = "3px solid red";
        precioG = false
        
    }
    else {
        salario.removeAttribute("style");
        precioG = true;
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
        bandCedu = false;
	}else{ 
        cedulas.removeAttribute("style");
        bandCedu = true;
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
        bandCedu = false;
	}else{ 
        cedulas2.removeAttribute("style");
        bandCedu = true;
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