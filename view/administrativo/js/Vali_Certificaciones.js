//declara las variables para los input
let nom = true
let precioG = true
let precioA = true
let desc = true
let abre = true

//validar()

//detecta tl click del boton
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) =>
{
    

    if (nom == false) {
        nombre.style.border = "3px solid red";
        e.preventDefault()
    }

    else if (precioG == false) {
        precioGen.style.border = "3px solid red";
        e.preventDefault()
    }
        
    else if (precioA == false) {
        precioAsoc.style.border = "3px solid red";
        e.preventDefault()
    }


    else if (desc == false) {
        descripcion.style.border = "3px solid red";
        e.preventDefault()
    }
        
    else if (abre == false) {
        abreviacion.style.border = "3px solid red";
        e.preventDefault()
    }

    else {
        validar(true)
    }

})


//definicion de las expresiones regulares
const expresiones = {
    name: /^[a-zA-ZÁ-ý0-9\s .,]{1,60}$/,
    precio: /^[0-9]+(.([0-9])+)*$/,
    descripcion: /^[a-zA-ZÁ-ý0-9\s"-.,]{1,10000}$/,
    abreviacion: /^[a-zA-ZÁ-ý]{4,8}$/
}

//revisa el campo abreviacion
formulario.abreviacion.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.abreviacion.value = valorInput
        
        //elimina los espacios en blanco
        .replace(/\s+/g, '')

        //elimina caracteres especiales
        .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·¨·°¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
    
        //elimina numeros
        .replace(/[0123456789]/g, '')

        //.toUpperCase()

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.abreviacion.test(valorInput)) {
        abreviacion.style.border = "3px solid red";
        abre = false
    }

    else {
        abreviacion.removeAttribute("style");
        abre = true;
    }

    //validar();
})

//revisa el campo nombre
formulario.nombre.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.nombre.value = valorInput

    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº`´·¨°¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.name.test(valorInput)) {
        nombre.style.border = "3px solid red";
        nom = false
    }

    else {
        nombre.removeAttribute("style");
        nom = true;
    }

    //validar();
})

//revisa el campo precio general
formulario.precioGen.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario.precioGen.value = valorInput

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
        precioGen.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        formulario.precioGen.value = valorInput;
        precioG = false
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        //precioAsoc.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formulario.precioGen.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        precioGen.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        formulario.precioGen.value = valorInput;
        precioG = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        precioGen.style.border = "3px solid red";
        precioG = false
        
    }
    else {
        precioGen.removeAttribute("style");
        precioG = true;
    }

    validar(precioG)

})
    
//revisa el campo precio asociado
    formulario.precioAsoc.addEventListener('keyup', (e) =>
    {
        let valorInput = e.target.value;
        formulario.precioAsoc.value = valorInput

            //elimina los espacios en blanco
            .replace(/\s+/g, '')
            //elimina caracteres especiales
            .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿`´·¨°⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

            //elimina las letras
            .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMéáíóúñÑªº¿®ÁÉ±|Í¶ÓÚ]/g, '')

            //elimina el ultimo espacio en blanco
            .trim();

        //elimina el ultimo punto agregado si ya habia otro
        if (verificarPuntos(valorInput) == true) {
            precioAsoc.style.border = "3px solid red";
            valorInput = valorInput.substr(0, valorInput.length - 1);
            formulario.precioAsoc.value = valorInput;
            precioA = false
        }

        //elimina el tercer decimal
        if (validarDecimales(valorInput) == true) {
            //precioAsoc.style.border = "3px solid red";
            valorInput = valorInput.substr(0, valorInput.length - 1);
            formulario.precioAsoc.value = valorInput;
        }

        //elimina el primer caracter si es un punto
        if (primeroNum(valorInput) == true) {
            precioAsoc.style.border = "3px solid red";
            valorInput = valorInput.substr(1, valorInput.length);
            //alert(valorInput.length);
            formulario.precioAsoc.value = valorInput;
            precioA = false
        }
        //verifica que se cumpla con la expresion correpondiente    
        if (!expresiones.precio.test(valorInput)) {
            precioAsoc.style.border = "3px solid red";
            precioA = false
        }

        else {
            precioAsoc.removeAttribute("style");
            precioA = true;
        }

        validar(precioA)
    })

//revisa el campo descripcion
formulario.descripcion.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    var enter = '\n'
    formulario.descripcion.value = valorInput

        //elimina caracteres especiales
        .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬`´·¨°½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?\n]/g, '')
    

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.descripcion.test(valorInput)) {
        descripcion.style.border = "3px solid red";
        desc = false
    }

    else {
        descripcion.removeAttribute("style");
        desc = true;
    }
    //validar()
})

/*Funcion que se encarga de habiliatar o deshabilitar el boton, segun el valor del parametro que reciba*/
function validar(bandera)
{
    
    const guardar = document.getElementById('registrar');
    //alert(ultimoNum(formulario.precioGen.value) == true);
    if (ultimoNum(formulario.precioGen.value) == true) {
        precioG = false;
        guardar.disabled = true;
    }

    if (ultimoNum(formulario.precioAsoc.value) == true) {
        precioA = false;
        guardar.disabled = true;
    }

    else {
        guardar.disabled = false;
    }

    if (bandera == false) {
        guardar.disabled = true;
    }

    else {
        guardar.disabled = false;
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
