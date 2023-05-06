/* Expresiones regulares */
const expresiones = {
    nombre: /^[a-zA-ZÁ-Ýá-ý\s.]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidos: /^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/, // Letras y espacios, pueden llevar acentos.
}

const banderas = {
    nombre: false,
    paterno: false,
    materno: false
}

/* Validación para el nombre */
const nombre_campo = document.getElementById('nombre');
nombre_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    nombre_campo.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '');

    if (!expresiones.nombres.test(valorInput)) {
        nombre_campo.style.border = "3px solid red";
        banderas.nombre = false;
    }
    else {
        nombre_campo.removeAttribute("style");
        banderas.nombre = true;
    }
});

/* Validación para el apellido paterno */
const paterno_campo = document.getElementById('paterno');
paterno_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    paterno_campo.value = valorInput.replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '');

    if (!expresiones.apellidos.test(valorInput)) {
        paterno_campo.style.border = "3px solid red";
        banderas.paterno = false;
    }
    else {
        paterno_campo.removeAttribute("style");
        banderas.paterno = true;
    }
});

/* Validación para el apellido materno */
const materno_campo = document.getElementById('materno');
materno_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    if (valorInput !== "") {
        materno_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

        if (!expresiones.apellidos.test(valorInput)) {
            materno_campo.style.border = "3px solid red";
            banderas.materno = false;
        } else {
            materno_campo.removeAttribute("style");
            banderas.materno = true;
        }
    }
});