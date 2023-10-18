
const expresiones = {
    descripcion: /^[a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]{1,200}$/, // Letras y espacios, pueden llevar acentos.
    monto: /^\d+(\.\d{1,2})?$/
}
const banderas = {
    descripcion1:false,
    descripcion2:false,
    monto:false
}
formulario.descripcion1.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.descripcion1.value = valorInput
    .trimEnd();
});

formulario.descripcion1.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario.descripcion1.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.descripcion.test(valorInput2)) {
        formulario.descripcion1.style.border = "3px solid red";
        banderas.descripcion1 = false;
    }else {
        formulario.descripcion1.removeAttribute("style");
        banderas.descripcion1 = true;
    }
});

formulario.monto.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.monto.value = valorInput
    .trimEnd();
});

formulario.monto.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario.monto.value = valorInput.replace(/[^0-9\.]/g, '');
    let valorInput2 = e.target.value;

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput2) == true) {
        formulario.monto.style.border = "3px solid red";
        valorInput2 = valorInput2.substr(0, valorInput2.length - 1);
        formulario.monto.value = valorInput2;
        banderas.monto = false;
    }
    if (validarDecimales(valorInput2) == true) {
        valorInput2 = valorInput2.substr(0, valorInput2.length - 1);
        formulario.monto.value = valorInput2;
    }
    if (!expresiones.monto.test(valorInput2)) {
        formulario.monto.style.border = "3px solid red";
        banderas.monto = false;
    }else {
        formulario.monto.removeAttribute("style");
        banderas.monto = true;
    }
});


formulario.descripcion2.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.descripcion2.value = valorInput
    .trimEnd();
});

formulario.descripcion2.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    formulario.descripcion2.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\;\:\_\-\"\#\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.descripcion.test(valorInput2)) {
        formulario.descripcion2.style.border = "3px solid red";
        banderas.descripcion2 = false;
    }else {
        formulario.descripcion2.removeAttribute("style");
        banderas.descripcion2 = true;
    }
});

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
