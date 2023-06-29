let checkbox_rh = document.getElementById("rh_ck");
let checkbox_it = document.getElementById("ti_ck");
let checkbox_ac = document.getElementById("ac_ck");


const btn_generales = document.getElementById("btn_generales");
const btn_domicilio = document.getElementById("btn_domicilio");

const btn_rh = document.getElementById("btn_rh");
const btn_it = document.getElementById("btn_it");
const btn_ac = document.getElementById("btn_ac");



const expresiones = {
    rfc:/^[A-Z]{3}[0-9]{6}[A-Z0-9]{3}$/,
    nombre:/^[a-zA-ZÁ-Ýá-ý\-\s]{1,100}$/,
    calle:/^[a-zA-ZÁ-Ýá-ý\.\s]+([\/\s#]?)((?:.*[0-9\s])?)([a-zA-Z]?)?$/,
    email:/^[a-zA-Z0-9.\-_][^@]+@[^@][a-zA-Z]+\.[a-zA-Z](?:.*[\.])?(?:.*[a-zA-Z])?$/,
    password:/^(?=(?:.*\d){1})(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){1})(?=(?:.*[@$\#\-_.!*\/+]){1})\S{8,16}$/,
    razon:/^[a-zA-ZÁ-ý\s,\.]{1,100}$/,
    postal:/^[0-9]{5}$/,
    estado:/^[a-zA-ZÁ-Ýá-ý\s]{1,50}$/,
    nombre_area:/^[a-zA-ZÁ-Ýá-ý\.\s]{1,40}$/,
    apellidos:/^[a-zA-ZÁ-Ýá-ý\s]{1,20}$/,
    telefono:/^[0-9]{10}$/,
    exten:/^[0-9]{3}$/



}

/** que se activen los campos del check  recursos humanos*/
checkbox_rh.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {

        rh_nombre.disabled = false; 
        rh_paterno.disabled = false;
        rh_materno.disabled = false;
        rh_tele.disabled = false;
        rh_exten.disabled = false;
        rh_correo.disabled = false;

        baderas.brh_nombre= false;
        baderas.brh_pa =  false;
        baderas.brh_ma = true;
        baderas.brh_te = false;
        baderas.brh_exten = true;
        baderas.brh_correo = false;

        btn_rh.removeAttribute("disabled");


    } else {
        rh_nombre.disabled = true; 
        rh_paterno.disabled = true;
        rh_materno.disabled = true;
        rh_tele.disabled = true;
        rh_exten.disabled = true;
        rh_correo.disabled = true;

        rh_nombre.value = "";
        rh_paterno.value = "";
        rh_materno.value = "";
        rh_tele.value = "";
        rh_exten.value = "";
        rh_correo.value = "";

        rh_nombre.removeAttribute("style");
        rh_paterno.removeAttribute("style");
        rh_materno.removeAttribute("style");
        rh_tele.removeAttribute("style");
        rh_exten.removeAttribute("style");
        rh_correo.removeAttribute("style");

        baderas.brh_nombre= true;
        baderas.brh_pa =  true;
        baderas.brh_ma = true;
        baderas.brh_te = true;
        baderas.brh_exten = true;
        baderas.brh_correo = true;

        btn_rh.setAttribute("disabled", "disabled");
    }
});
checkbox_it.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
        it_nombre.disabled = false;
        it_paterno.disabled = false;
        it_materno.disabled = false;
        it_tele.disabled = false;
        it_exten.disabled = false;
        it_correo.disabled = false;

        baderas.bti_nombre = false;
        baderas.bti_pa =  false;
        baderas.bti_ma = true;
        baderas.bti_te = false;
        baderas.bti_exten = true;
        baderas.bti_correo = false;
        btn_it.removeAttribute("disabled");
    } else {
        it_nombre.disabled = true;
        it_paterno.disabled = true;
        it_materno.disabled = true;
        it_tele.disabled = true;
        it_exten.disabled = true;
        it_correo.disabled = true;

        it_nombre.value = "";
        it_paterno.value = "";
        it_materno.value = "";
        it_tele.value = "";
        it_exten.value = "";
        it_correo.value = "";

        it_nombre.removeAttribute("style");
        it_paterno.removeAttribute("style");
        it_materno.removeAttribute("style");
        it_tele.removeAttribute("style");
        it_exten.removeAttribute("style");
        it_correo.removeAttribute("style");

        baderas.bti_nombre = true;
        baderas.bti_pa =  true;
        baderas.bti_ma = true;
        baderas.bti_te = true;
        baderas.bti_exten = true;
        baderas.bti_correo = true;

        btn_it.setAttribute("disabled", "disabled");
        
    }
});
checkbox_ac.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
        ac_nombre.disabled = false;
        ac_paterno.disabled = false;
        ac_materno.disabled = false;
        ac_tele.disabled = false;
        ac_exten.disabled = false;
        ac_correo.disabled = false;

        baderas.bca_nombre = false;
        baderas.bca_pa =  false;
        baderas.bca_ma = true;
        baderas.bca_te = false;
        baderas.bca_exten = true;
        baderas.bca_correo = false;

        btn_ac.removeAttribute("disabled");

    } else {
        ac_nombre.disabled = true;
        ac_paterno.disabled = true;
        ac_materno.disabled = true;
        ac_tele.disabled = true;
        ac_exten.disabled = true;
        ac_correo.disabled = true;

        ac_nombre.value = "";
        ac_paterno.value = "";
        ac_materno.value = "";
        ac_tele.value = "";
        ac_exten.value = "";
        ac_correo.value = "";

        ac_nombre.removeAttribute("style");
        ac_paterno.removeAttribute("style");
        ac_materno.removeAttribute("style");
        ac_tele.removeAttribute("style");
        ac_exten.removeAttribute("style");
        ac_correo.removeAttribute("style");

        baderas.bca_nombre = true;
        baderas.bca_pa =  true;
        baderas.bca_ma = true;
        baderas.bca_te = true;
        baderas.bca_exten = true;
        baderas.bca_correo = true;

        btn_ac.setAttribute("disabled", "disabled");
    }
  })


/**rfc */
formulario.rfc.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rfc.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^A-Z0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.rfc.test(valorInput2)) {
        formulario.rfc.style.border = "3px solid red";
        baderas.brfc = false;
	}else{
        formulario.rfc.removeAttribute("style");
        baderas.brfc = true;
    }
    
});
/**nombre */
formulario.nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.nombre.value = valorInput
    .trimEnd();
});
formulario.nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.nombre.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\-\s]/g, '');
    let valorInput2 = e.target.value;
    if (!expresiones.nombre.test(valorInput2)) {
        formulario.nombre.style.border = "3px solid red";
        baderas.bnombre_empresa = false;
	}else{
        formulario.nombre.removeAttribute("style");
        baderas.bnombre_empresa = true;
    }

});
/**correo empresa */
formulario.correo_m.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.correo_m.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
     .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')

     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formulario.correo_m.style.border = "3px solid red";
        baderas.bcorreo_empresa = false;
	}else{
        formulario.correo_m.removeAttribute("style");
        baderas.bcorreo_empresa = true;
    }
    
});

/* password*/
formulario.password.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.password.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formulario.password.removeAttribute("style");
        baderas.bcontra = true;
    }
});
formulario.password.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.password.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    // Eliminar el ultimo espaciado
   .trim();
   let valorInput2 = e.target.value;
    if (!expresiones.password.test(valorInput2)) {
        password.style.border = "3px solid red";
        baderas.bcontra = false
	}else{
        password.removeAttribute("style");
        baderas.bcontra = true
    }
    let valorpassword = formulario.password_confirmacion.value;
    if((valorpassword == valorInput2) == false){
        password_confirmacion.style.border = "3px solid red";
        bcontra_conf = false
    }else{
        password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true
    }

});
/* password confirmacion*/
formulario.password_confirmacion.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.password_confirmacion.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formulario.password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true;
    }
});
formulario.password_confirmacion.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.password_confirmacion.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9$\#\-_.@,!*\/+]/g, '')
    .trim();
    let valorInput2 = e.target.value;

    if (!expresiones.password.test(valorInput2)) {
        password_confirmacion.style.border = "3px solid red";
        baderas.bcontra_conf = false
	}else{
        password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true
        let valorpassword = formulario.password.value;
        if((valorpassword == valorInput2) == false){
            password_confirmacion.style.border = "3px solid red";
            bcontra_conf = false
        }
    }

    
});

/**razon social */
formulario.razon.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.razon.value = valorInput
    .trimEnd();
});
formulario.razon.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.razon.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-ý\.,\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.razon.test(valorInput2)) {
        formulario.razon.style.border = "3px solid red";
        baderas.brazon = false;
	}else{
        formulario.razon.removeAttribute("style");
        baderas.brazon = true;
    }
    
});
/**codigo postal */
formDomicilio.codigo_postal.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formDomicilio.codigo_postal.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.postal.test(valorInput2)) {
        formDomicilio.codigo_postal.style.border = "3px solid red";
        baderas.bcodigo_postal = false;
	}else{
        formDomicilio.codigo_postal.removeAttribute("style");
        baderas.bcodigo_postal = true;
        baderas.bestado = true;
        baderas.bciudad = true;
    }
    
});


/**calle  */
formDomicilio.calle.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formDomicilio.calle.value = valorInput
    .trimEnd();
});
formDomicilio.calle.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formDomicilio.calle.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý0-9#\.\/\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.calle.test(valorInput2)) {
        formDomicilio.calle.style.border = "3px solid red";
        baderas.bcalle = false;
	}else{
        formDomicilio.calle.removeAttribute("style");
        baderas.bcalle = true;
    }
    
});




/* rh nombre */
formularioRH.rh_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioRH.rh_nombre.value = valorInput
    .trimEnd();
});
formularioRH.rh_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_nombre.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formularioRH.rh_nombre.style.border = "3px solid red";
        baderas.brh_nombre = false;
	}else{
        formularioRH.rh_nombre.removeAttribute("style");
        baderas.brh_nombre = true;
    }

});
/* rh paterno */
formularioRH.rh_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioRH.rh_paterno.value = valorInput
    .trimEnd();
});
formularioRH.rh_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_paterno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formularioRH.rh_paterno.style.border = "3px solid red";
        baderas.brh_pa = false;
	}else{
        formularioRH.rh_paterno.removeAttribute("style");
        baderas.brh_pa = true;
    }
    
});

/* rh materno */
formularioRH.rh_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioRH.rh_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formularioRH.rh_materno.removeAttribute("style");
        baderas.brh_ma = true;
    }
});
formularioRH.rh_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_materno.value = valorInput

     
      // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formularioRH.rh_materno.style.border = "3px solid red";
        baderas.brh_ma = false;
	}else{
        formularioRH.rh_materno.removeAttribute("style");
        baderas.brh_ma = true;
    }
    
});
/**rh telefono */
formularioRH.rh_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formularioRH.rh_tele.style.border = "3px solid red";
        baderas.brh_te = false;
	}else{
        formularioRH.rh_tele.removeAttribute("style");
        baderas.brh_te = true;
    }
    
});
/**rh  extension telefono */
formularioRH.rh_exten.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
    formularioRH.rh_exten.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formularioRH.rh_exten.removeAttribute("style");
        baderas.brh_exten = true;
    }

});
formularioRH.rh_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formularioRH.rh_exten.style.border = "3px solid red";
        baderas.brh_exten = false;
	}else{
        formularioRH.rh_exten.removeAttribute("style");
        baderas.brh_exten = true;
    }
    
});
/**rh correo */
formularioRH.rh_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioRH.rh_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formularioRH.rh_correo.style.border = "3px solid red";
        baderas.brh_correo = false;
	}else{
        formularioRH.rh_correo.removeAttribute("style");
        baderas.brh_correo = true;
    }
    
});

/////////////////////////////   ti  ///////////////////////////////////////////
/* ti nombre */
formularioIT.ti_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioIT.ti_nombre.value = valorInput
    .trimEnd();
});
formularioIT.ti_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_nombre.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formularioIT.ti_nombre.style.border = "3px solid red";
        baderas.bti_nombre = false;
	}else{
        formularioIT.ti_nombre.removeAttribute("style");
        baderas.bti_nombre = true;
    }
    
});
/* ti paterno */
formularioIT.ti_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioIT.ti_paterno.value = valorInput
    .trimEnd();
});
formularioIT.ti_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_paterno.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

     let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formularioIT.ti_paterno.style.border = "3px solid red";
        baderas.bti_pa = false;
	}else{
        formularioIT.ti_paterno.removeAttribute("style");
        baderas.bti_pa = true;
    }
   
});

/* ti materno */
formularioIT.ti_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioIT.ti_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formularioIT.ti_materno.removeAttribute("style");
        baderas.bti_ma = true;
    }
});
formularioIT.ti_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');
    let valorInput2 = e.target.value;

    if (!expresiones.apellidos.test(valorInput2)) {
        formularioIT.ti_materno.style.border = "3px solid red";
        baderas.bti_ma = false;
	}else{
        formularioIT.ti_materno.removeAttribute("style");
        baderas.bti_ma = true;
    }

});
/**ti telefono */
formularioIT.ti_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
     .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formularioIT.ti_tele.style.border = "3px solid red";
        baderas.bti_te = false;
	}else{
        formularioIT.ti_tele.removeAttribute("style");
        baderas.bti_te = true;
    }
    
});
/**ti  extension telefono */
formularioIT.ti_exten.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
    formularioIT.ti_exten.value = valorInput.trimEnd();
    if(e.target.value.length == 0 ){
        formularioIT.ti_exten.removeAttribute("style");
        baderas.bti_exten = true;
    }
});
formularioIT.ti_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
     .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formularioIT.ti_exten.style.border = "3px solid red";
        baderas.bti_exten = false;
	}else{
        formularioIT.ti_exten.removeAttribute("style");
        baderas.bti_exten = true;
    }
    
});
/**ti correo */
formularioIT.ti_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioIT.ti_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formularioIT.ti_correo.style.border = "3px solid red";
        baderas.bti_correo = false;
	}else{
        formularioIT.ti_correo.removeAttribute("style");
        baderas.bti_correo = true;
    }
    
    
});

/////////////////////////////   cp  ///////////////////////////////////////////
/* capacitacion nombre */
formularioAC.ac_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioAC.ac_nombre.value = valorInput
    .trimEnd();
});
formularioAC.ac_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_nombre.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

     let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formularioAC.ac_nombre.style.border = "3px solid red";
        baderas.bca_nombre = false;
	}else{
        formularioAC.ac_nombre.removeAttribute("style");
        baderas.bca_nombre = true;
    }
   
});
/* ca paterno */
formularioAC.ac_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioAC.ac_paterno.value = valorInput
    .trimEnd();
});
formularioAC.ac_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_paterno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formularioAC.ac_paterno.style.border = "3px solid red";
        baderas.bca_pa = false;
	}else{
        formularioAC.ac_paterno.removeAttribute("style");
        baderas.bca_pa = true;
    }
   
    
});

/* ca materno */
formularioAC.ac_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formularioAC.ac_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formularioAC.ac_materno.removeAttribute("style");
        baderas.bca_ma = true;
    }
});
formularioAC.ac_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formularioAC.ac_materno.style.border = "3px solid red";
        baderas.bca_ma = false;
	}else{
        formularioAC.ac_materno.removeAttribute("style");
        baderas.bca_ma = true;
    }
   
    
});
/**ca telefono */
formularioAC.ac_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formularioAC.ac_tele.style.border = "3px solid red";
        baderas.bca_te = false;
	}else{
        formularioAC.ac_tele.removeAttribute("style");
        baderas.bca_te = true;
    }
    
});
/**ca  extension telefono */
formularioAC.ac_exten.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
    formularioAC.ac_exten.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formularioAC.ac_exten.removeAttribute("style");
        baderas.bca_exten = true;
    }
});
formularioAC.ac_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formularioAC.ac_exten.style.border = "3px solid red";
        baderas.bca_exten = false;
	}else{
        formularioAC.ac_exten.removeAttribute("style");
        baderas.bca_exten = true;
    }
   
    
});
/**ca correo */
formularioAC.ac_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formularioAC.ac_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formularioAC.ac_correo.style.border = "3px solid red";
        baderas.bca_correo = false;
	}else{
        formularioAC.ac_correo.removeAttribute("style");
        baderas.bca_correo = true;
    }
    
    
});


btn_generales.addEventListener("click",(e)=>{
    // valida los campos de datos generales
    if(!formulario.checkValidity()){
        formulario.reportValidity();
    }
    if(baderas.brfc == false){
        rfc.style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bnombre_empresa == false){
        document.getElementById("nombre").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bcorreo_empresa == false){
        document.getElementById("correo_m").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bcontra == false ){
        document.getElementById("password").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bcontra_conf == false){
        document.getElementById("password_confirmacion").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brazon == false){
        document.getElementById("razon").style.border = "3px solid red";
        e.preventDefault();
    }
    

    
});

btn_domicilio.addEventListener("click", (e)=>{

    if(baderas.bcodigo_postal == false){
        document.getElementById("codigo_postal").style.border = "3px solid red";
    }else if(baderas.bcalle == false){
        document.getElementById("calle").style.border = "3px solid red";
    }
    validar(e);
});

btn_rh.addEventListener("click",(e)=>{
    
    if(baderas.brh_nombre == false){
        document.getElementById("rh_nombre").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brh_pa == false){
        document.getElementById("rh_paterno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brh_ma == false){
        document.getElementById("rh_materno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brh_te == false){
        document.getElementById("rh_tele").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brh_exten == false){
        document.getElementById("rh_exten").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.brh_correo == false){
        document.getElementById("rh_correo").style.border = "3px solid red";
        e.preventDefault();
    }
    
});
btn_it.addEventListener("click",(e)=>{

    if(baderas.bti_nombre == false){
        document.getElementById("ti_nombre").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bti_pa == false){
        document.getElementById("ti_paterno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bti_ma == false){
        document.getElementById("ti_materno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bti_te == false){
        document.getElementById("ti_tele").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bti_exten == false){
        document.getElementById("ti_exten").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bti_correo == false){
        document.getElementById("ti_correo").style.border = "3px solid red";
        e.preventDefault();
    }
});
btn_ac.addEventListener("click",(e)=>{

    if(baderas.bca_nombre == false){
        document.getElementById("ac_nombre").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bca_pa == false){
        document.getElementById("ac_paterno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bca_ma == false){  
        document.getElementById("ac_materno").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bca_te == false){
        document.getElementById("ac_tele").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bca_exten == false){
        document.getElementById("ac_exten").style.border = "3px solid red";
        e.preventDefault();
    }else if(baderas.bca_correo == false){
        document.getElementById("ac_correo").style.border = "3px solid red";
        e.preventDefault();
    }
    
});

function validar(e) {
    //si hay una bandera en falso la coloca en rojo

    let is_ok = true;
    
    for (const key in baderas) {

        if(baderas[key] == false){
            is_ok = false;
        }

    }
    if(is_ok == false){
        e.preventDefault();
    }else{
        
        estado.disabled = false;
        
        if(estado.value.length == 0){
            alert("Por favor, ingrese un código postal válido.");
            e.preventDefault();
            estado.disabled = true;
        }else{
            ciudad.disabled = false;
            
        }
    }
}




    
