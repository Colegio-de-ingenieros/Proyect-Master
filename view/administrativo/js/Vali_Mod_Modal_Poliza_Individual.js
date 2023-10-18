

const banderasModal = {
    descripcionMod1:false,
    descripcionMod2:false,
    montoMod:false
}

formulario2.descripcionMod1.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario2.descripcionMod1.value = valorInput
    .trimEnd();
});

formulario2.descripcionMod1.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario2.descripcionMod1.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.descripcion.test(valorInput2)) {
        formulario2.descripcionMod1.style.border = "3px solid red";
        banderasModal.descripcionMod1 = false;
    }else {
        formulario2.descripcionMod1.removeAttribute("style");
        banderasModal.descripcionMod1 = true;
    }
});

formulario2.montoMod.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario2.montoMod.value = valorInput
    .trimEnd();
});

formulario2.montoMod.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario2.montoMod.value = valorInput.replace(/[^0-9\.]/g, '');
    let valorInput2 = e.target.value;

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput2) == true) {
        formulario2.montoMod.style.border = "3px solid red";
        valorInput2 = valorInput2.substr(0, valorInput2.length - 1);
        formulario2.montoMod.value = valorInput2;
        banderasModal.montoMod = false;
    }
    if (validarDecimales(valorInput2) == true) {
        valorInput2 = valorInput2.substr(0, valorInput2.length - 1);
        formulario2.montoMod.value = valorInput2;
    }

    if (!expresiones.monto.test(valorInput2)) {
        formulario2.montoMod.style.border = "3px solid red";
        banderasModal.montoMod = false;
    }else {
        formulario2.montoMod.removeAttribute("style");
        banderasModal.montoMod = true;
    }
});


formulario2.descripcionMod2.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario2.descripcionMod2.value = valorInput
    .trimEnd();
});

formulario2.descripcionMod2.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario2.descripcionMod2.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.descripcion.test(valorInput2)) {
        formulario2.descripcionMod2.style.border = "3px solid red";
        banderasModal.descripcionMod2 = false;
    }else {
        formulario2.descripcionMod2.removeAttribute("style");
        banderasModal.descripcionMod2 = true;
    }
});




//verifica que la cadena no tenga mas de dos decimales
function validarDecimales(cadena){
    var decimales = 0
    var j = cadena.length - 1
    var puntos = 0;

    for (i = 0; i < cadena.length; i++) {
        if (cadena[i] == '.') {
            puntos++;
        }
    }

    if (puntos == 1) {
        while (cadena[j] != '.' && j > 1) {
            decimales++;
            j--;
            
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

