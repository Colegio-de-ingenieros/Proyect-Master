//declara las variables para los input
let nombre = false
let precio = false
let descripcion = false


//detecta tl click del boton
let botonRegistrar = document.getElementById("botonRegistrar");
botonRegistrar.addEventListener("click", (e) =>
{

    if (nombre == false) {
        inputNombre.style.border = "3px solid red";
    }

    else if (precio == false) {
        inputPrecio.style.border = "3px solid red";
    }

    else if (descripcion == false) {
        inputDescripcion.style.border = "3px solid red";
    }

    else {
        validar(true)
    }

})


//definicion de las expresiones regulares
const expresiones = {
    name: /^[a-zA-ZÁ-ý0-9\s .,]{1,60}$/,
    precio: /^[0-9.]{1,100}$/,
    descripcion: /^[a-zA-ZÁ-ý0-9\s"-.,]{1,10000}$/
}

//revisa el campo nombre
formulario.inputNombre.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.inputNombre.value = valorInput

    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.name.test(valorInput)) {
        inputNombre.style.border = "3px solid red";
    }

    else {
        inputNombre.removeAttribute("style");
        nombre = true;
    }

    //validar(nombre);
})

//revisa el campo precio
formulario.inputPrecio.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.inputPrecio.value = valorInput

    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    //elimina las letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '');

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        inputPrecio.style.border = "3px solid red";
    }

    else {
        inputPrecio.removeAttribute("style");
        precio = true;
    }

    //validar(precio);
})

//revisa el campo descripcion
formulario.inputDescripcion.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.inputDescripcion.value = valorInput

        //elimina caracteres especiales
        .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
    

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.descripcion.test(valorInput)) {
        inputDescripcion.style.border = "3px solid red";
    }

    else {
        inputDescripcion.removeAttribute("style");
        descripcion = true;
    }

    //validar(descripcion);
})

/*Funcion que se encarga de habiliatar o deshabilitar el boton, segun el valor del parametro que reciba*/
function validar(bandera)
{
    const guardar = document.getElementById('botonRegistrar');
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}
