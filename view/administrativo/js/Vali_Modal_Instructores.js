/** validaciones ventana modal */
/* Expresiones regulares */

const banderas_modal = {
    nombre_modi:true,
    organizacion_modi:true
}
/* Validación para el nombre de la certificación externa */
const nombre_certificacion_campo_modi = document.getElementById('nombre-cert-externa-modi');

nombre_certificacion_campo_modi.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    /* Crea una expresión regular que tenga las siguientes especificaciónes: solo aceptará letras, espacios intermedios, números, la coma “,” y el punto “.” */
    nombre_certificacion_campo_modi.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý0-9\.\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.certificacion.test(valorInput2)) {
        nombre_certificacion_campo_modi.style.border = "3px solid red";
        banderas_modal.nombre_modi = false;
    }
    else {
        nombre_certificacion_campo_modi.removeAttribute("style");
        banderas_modal.nombre_modi = true;
    }
   
});

/* Validacion para el campo de organización */
const organizacion_campo_modi = document.getElementById('organizacion-externa-modi');

organizacion_campo_modi.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;
    organizacion_campo_modi.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.nombre.test(valorInput2)) {
        organizacion_campo_modi.style.border = "3px solid red";
        banderas_modal.organizacion_modi = false;
    }
    else {
        organizacion_campo_modi.removeAttribute("style");
        banderas_modal.organizacion_modi = true;
    }
   
});
