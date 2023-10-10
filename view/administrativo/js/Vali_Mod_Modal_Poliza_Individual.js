

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





