let sal = false

const expresiones = {
    precio: /^[0-9]+(.([0-9])+)*$/
}

let monto = document.getElementById("monto");
monto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    monto.value = valorInput

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
        monto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        monto.value = valorInput;
        sal = false
        validar(sal)
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        valorInput = valorInput.substr(0, valorInput.length - 1);
        monto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        monto.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        monto.value = valorInput;
        sal = false
        validar(sal)
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        monto.style.border = "3px solid red";
        sal = false
        validar(sal)
        
    }
    else {
        monto.removeAttribute("style");
        sal = true;
        validar(sal)
    }

})

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

function validar(bandera){
    const guardar = document.getElementById('boton_registrar');

    if(bandera == false){              
        guardar.disabled=true;
        
    }else{
        guardar.disabled=false;
    }

}
