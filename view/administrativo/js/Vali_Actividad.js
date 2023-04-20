let montoGasto = false
let montoIngreso = false

//detecta el click del boton anadir2
let botonDos = document.getElementById("anadir2");
botonDos.addEventListener("click", (e) =>{
    console.log(montoGasto)
    if (montoGasto == false) {
        gastos_monto.style.border = "3px solid red";
    } else {
        validarUno(true)
    }
})

//detecta el click del boton anadir3
let botonTres = document.getElementById("anadir3");
botonTres.addEventListener("click", (e) =>{
    console.log(montoIngreso)
    if (montoIngreso == false) {
        ingresos_monto.style.border = "3px solid red";
    } else {
        validarDos(true)
    }
})


//definicion de las expresiones regulares
const expresiones = {
    monto: /^[0-9]+(.([0-9])+)*$/,
}

//revisa el campo monto de gastos
formulario_Gastos.gastos_monto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario_Gastos.gastos_monto.value = valorInput

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
        gastos_monto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario_Gastos.gastos_monto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        gastos_monto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario_Gastos.gastos_monto.value = valorInput;
    }

    if (validarDecimales(valorInput) == true) {
        valorInput = valorInput.substr(0, valorInput.length - 1);
        //alert(valorInput.length);
        formulario_Gastos.gastos_monto.value = valorInput;
    }

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.monto.test(valorInput)) {
        gastos_monto.style.border = "3px solid red";
        montoGasto = false
    } else {
        gastos_monto.removeAttribute("style");
        montoGasto = true;
    }



    validarUno(montoGasto);
})


//revisa el campo monto de ingresos
formulario_Ingresos.ingresos_monto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario_Ingresos.ingresos_monto.value = valorInput

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
        ingresos_monto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario_Ingresos.ingresos_monto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        ingresos_monto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario_Ingresos.ingresos_monto.value = valorInput;
    }

    if (validarDecimales(valorInput) == true) {
        valorInput = valorInput.substr(0, valorInput.length - 1);
        //alert(valorInput.length);
        formulario_Ingresos.ingresos_monto.value = valorInput;
    }

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.monto.test(valorInput)) {
        ingresos_monto.style.border = "3px solid red";
        montoIngreso = false
    } else {
        ingresos_monto.removeAttribute("style");
        montoIngreso = true;
    }

    validarDos(montoIngreso);
})


function validarUno(bandera){
    const anadir2 = document.getElementById('anadir2');
    if(bandera == false){     
        console.log("bloqueado")        
        anadir2.disabled=true;
    }else{
        console.log("desbloqueado") 
        anadir2.disabled=false;
    }
}

function validarDos(bandera){
    const anadir3 = document.getElementById('anadir3');
    if(bandera == false){     
        console.log("bloqueadoDos")        
        anadir3.disabled=true;
    }else{
        console.log("desbloqueadoDos") 
        anadir3.disabled=false;
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
