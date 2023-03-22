//declara las variables para los input
let nom = false
let precioG = false
let precioA = false
let desc = false


//detecta tl click del boton
let botonRegistrar = document.getElementById("registrar");
botonRegistrar.addEventListener("click", (e) =>
{

    if (nom == false) {
        nombre.style.border = "3px solid red";
    }

    else if (precioG == false) {
        precioGen.style.border = "3px solid red";
    }
        
    else if (precioA == false) {
        precioAsoc.style.border = "3px solid red";
    }


    else if (desc == false) {
        descripcion.style.border = "3px solid red";
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
formulario.nombre.addEventListener('keyup', (e) =>
{
    let valorInput = e.target.value;
    formulario.nombre.value = valorInput

    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.name.test(valorInput)) {
        nombre.style.border = "3px solid red";
    }

    else {
        nombre.removeAttribute("style");
        nom = true;
    }

    //validar(nombre);
})

//revisa el campo precio general
formulario.precioGen.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario.precioGen.value = valorInput

    //elimina caracteres especiales
    .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    //elimina las letras
    .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '');

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        precioGen.style.border = "3px solid red";
    }

    else {
        precioGen.removeAttribute("style");
        precioG = true;
    }
})
    
//revisa el campo precio asociado
    formulario.precioAsoc.addEventListener('keyup', (e) =>
    {
        let valorInput = e.target.value;
        formulario.precioAsoc.value = valorInput

            //elimina caracteres especiales
            .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

            //elimina las letras
            .replace(/[qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM]/g, '');

        //verifica que se cumpla con la expresion correpondiente    
        if (!expresiones.precio.test(valorInput)) {
            precioAsoc.style.border = "3px solid red";
        }

        else {
            precioAsoc.removeAttribute("style");
            precioA = true;
        }
    })

//revisa el campo descripcion
formulario.descripcion.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formulario.descripcion.value = valorInput

        //elimina caracteres especiales
        .replace(/[☺☻♥♦•○◙♂♀üâäàåçê♪ëèïîìÄÅæÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')
    

    //verifica que se cumpla con la expresion correpondiente
    if (!expresiones.descripcion.test(valorInput)) {
        descripcion.style.border = "3px solid red";
    }

    else {
        descripcion.removeAttribute("style");
        desc = true;
    }
})

/*Funcion que se encarga de habiliatar o deshabilitar el boton, segun el valor del parametro que reciba*/
function validar(bandera){
    const guardar = document.getElementById('registrar');
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}
