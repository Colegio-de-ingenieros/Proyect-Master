
/* Expresiones regulares */
const expresiones = {
    nombre: /^[a-zA-ZÁ-Ýá-ý\s.]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidos: /^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/, // Letras y espacios, pueden llevar acentos.
    especialidades: /^[a-zA-ZÁ-Ýá-ý\s]{1,60}$/, // Letras y espacios, pueden llevar acentos.
    fecha: /^\d{4}-\d{2}-\d{2}$/, // Fecha en formato yyyy-mm-dd
    hora: /^\d{2}:\d{2}$/, // Hora en formato hh:mm
    texto_comas: /^[a-zA-ZÁ-Ýá-ý\s,.]{1,60}$/, // Letras y espacios, pueden llevar acentos y comas.
}
/* Conjunto de banderas para realizar verificación */
const banderas = {
    nombre: false,
    paterno: false,
    materno: true,
    especialidad: false
}

/* Conjunto de banderas para realizar verificación al añadir una certificación externa */
const banderas_externas = {
    nombre: false,
    organizacion: false,
    emision: false,
    vencimiento: false,
};

/* Validación para el nombre */
const nombre_campo = document.getElementById('nombre');
nombre_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	nombre_campo.value = valorInput
    .trimEnd();
});
nombre_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    nombre_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s.]/g, '');

    let valorInput2 = e.target.value;

    if (!expresiones.nombre.test(valorInput2)) {
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
paterno_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	paterno_campo.value = valorInput
    .trimEnd();
});
paterno_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    paterno_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
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
materno_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	materno_campo.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        materno_campo.removeAttribute("style");
        banderas.materno = true;
    }
});
materno_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    if (valorInput !== "") {
        materno_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');
        let valorInput2 = e.target.value;
        if (!expresiones.apellidos.test(valorInput2)) {
            materno_campo.style.border = "3px solid red";
            banderas.materno = false;
        } else {
            materno_campo.removeAttribute("style");
            banderas.materno = true;
        }
    }
});

/* Validación para la especialidad */
const especialidad_campo = document.getElementById('especialidad');
especialidad_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	especialidad_campo.value = valorInput
    .trimEnd();
});
especialidad_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    especialidad_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.especialidades.test(valorInput2)) {
        especialidad_campo.style.border = "3px solid red";
        banderas.especialidad = false;
    }
    else {
        especialidad_campo.removeAttribute("style");
        banderas.especialidad = true;
    }
});

/* Validación para el nombre de la certificación externa */
const nombre_certificacion_campo = document.getElementById('nombre-cert-externa');
nombre_certificacion_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	nombre_certificacion_campo.value = valorInput
    .trimEnd();
});
nombre_certificacion_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    nombre_certificacion_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s,.]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.texto_comas.test(valorInput2)) {
        nombre_certificacion_campo.style.border = "3px solid red";
        banderas_externas.nombre = false;
    }
    else {
        nombre_certificacion_campo.removeAttribute("style");
        banderas_externas.nombre = true;
    }
});

/* Validacion para el campo de organización */
const organizacion_campo = document.getElementById('organizacion-externa');
organizacion_campo.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	organizacion_campo.value = valorInput
    .trimEnd();
});
organizacion_campo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    organizacion_campo.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s.]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.nombre.test(valorInput2)) {
        organizacion_campo.style.border = "3px solid red";
        banderas_externas.organizacion = false;
    }
    else {
        organizacion_campo.removeAttribute("style");
        banderas_externas.organizacion = true;
    }
});

