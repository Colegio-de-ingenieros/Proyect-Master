let baderas = {
     brfc: false,
     bnombre_empresa: false,
     bcorreo_empresa: false,
     bcontra: false,
     bcontra_conf: false,
     brazon: false,

     bcodigo_postal: false,
     bcalle: false,
     bciudad: true,
     bestado: true,

     brh_nombre: false,
     brh_pa:  false,
     brh_ma: true,
     brh_te: false,
     brh_exten: false,
     brh_correo: false,

     bti_nombre: false,
     bti_pa:  false,
     bti_ma: true,
     bti_te: false,
     bti_exten: false,
     bti_correo: false,

     bca_nombre: false,
     bca_pa:  false,
     bca_ma: true,
     bca_te: false,
     bca_exten: false,
     bca_correo: false
}

const expresiones = {
    rfc:/^[A-Z]{3}[0-9]{6}[A-Z0-9]{3}$/,
    nombre:/^[a-zA-ZÁ-Ýá-ý\-\s]{1,100}$/,
    calle:/^[a-zA-ZÁ-Ýá-ý\.\s]+#?[0-9\s]{1,100}$/,
    email:/^[a-zA-Z0-9.\-_][^@]+@[^@][a-zA-Z]+\.[a-zA-Z](?:.*[\.])?(?:.*[a-zA-Z])?$/,
    password:/^(?=(?:.*\d){1})(?=(?:.*[A-Z]){1})(?=(?:.*[a-z]){1})(?=(?:.*[@$\#\-_.!*\/+]){1})\S{8,16}$/,
    razon:/^[a-zA-ZÁ-ý\s,\.]{1,100}$/,
    postal:/^[0-9]{5}$/,
    estado:/^[a-zA-ZÁ-Ýá-ý\s]{1,50}$/,
    nombre_area:/^[a-zA-ZÁ-Ýá-ý\.\s]{1,40}$/,
    apellidos:/^[a-zA-ZÁ-Ýá-ý\.\s]{1,20}$/,
    telefono:/^[0-9]{10}$/,
    exten:/^[0-9]{3}$/



}




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
    
});
/* password confrimacion*/
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
formulario.codigo_postal.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.codigo_postal.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.postal.test(valorInput2)) {
        formulario.codigo_postal.style.border = "3px solid red";
        baderas.bcodigo_postal = false;
	}else{
        formulario.codigo_postal.removeAttribute("style");
        baderas.bcodigo_postal = true;
        baderas.bestado = true;
        baderas.bciudad = true;
    }
    
});
/**calle  */
formulario.calle.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.calle.value = valorInput
    .trimEnd();
});
formulario.calle.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.calle.value = valorInput
     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý0-9#\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.calle.test(valorInput2)) {
        formulario.calle.style.border = "3px solid red";
        baderas.bcalle = false;
	}else{
        formulario.calle.removeAttribute("style");
        baderas.bcalle = true;
    }
    
});

/* rh nombre */
formulario.rh_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.rh_nombre.value = valorInput
    .trimEnd();
});
formulario.rh_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_nombre.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formulario.rh_nombre.style.border = "3px solid red";
        baderas.brh_nombre = false;
	}else{
        formulario.rh_nombre.removeAttribute("style");
        baderas.brh_nombre = true;
    }

});
/* rh paterno */
formulario.rh_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.rh_paterno.value = valorInput
    .trimEnd();
});
formulario.rh_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_paterno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.rh_paterno.style.border = "3px solid red";
        baderas.brh_pa = false;
	}else{
        formulario.rh_paterno.removeAttribute("style");
        baderas.brh_pa = true;
    }
    
});

/* rh materno */
formulario.rh_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.rh_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formulario.rh_materno.removeAttribute("style");
        baderas.brh_ma = true;
    }
});
formulario.rh_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_materno.value = valorInput

     
      // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;

    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.rh_materno.style.border = "3px solid red";
        baderas.brh_ma = false;
	}else{
        formulario.rh_materno.removeAttribute("style");
        baderas.brh_ma = true;
    }
    
});
/**rh telefono */
formulario.rh_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formulario.rh_tele.style.border = "3px solid red";
        baderas.brh_te = false;
	}else{
        formulario.rh_tele.removeAttribute("style");
        baderas.brh_te = true;
    }
    
});
/**rh  extension telefono */
formulario.rh_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formulario.rh_exten.style.border = "3px solid red";
        baderas.brh_exten = false;
	}else{
        formulario.rh_exten.removeAttribute("style");
        baderas.brh_exten = true;
    }
    
});
/**rh correo */
formulario.rh_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formulario.rh_correo.style.border = "3px solid red";
        baderas.brh_correo = false;
	}else{
        formulario.rh_correo.removeAttribute("style");
        baderas.brh_correo = true;
    }
    
});

/////////////////////////////   ti  ///////////////////////////////////////////
/* ti nombre */
formulario.ti_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ti_nombre.value = valorInput
    .trimEnd();
});
formulario.ti_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_nombre.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formulario.ti_nombre.style.border = "3px solid red";
        baderas.bti_nombre = false;
	}else{
        formulario.ti_nombre.removeAttribute("style");
        baderas.bti_nombre = true;
    }
    
});
/* ti paterno */
formulario.ti_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ti_paterno.value = valorInput
    .trimEnd();
});
formulario.ti_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_paterno.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

     let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.ti_paterno.style.border = "3px solid red";
        baderas.bti_pa = false;
	}else{
        formulario.ti_paterno.removeAttribute("style");
        baderas.bti_pa = true;
    }
   
});

/* ti materno */
formulario.ti_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ti_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formulario.ti_materno.removeAttribute("style");
        baderas.bti_ma = true;
    }
});
formulario.ti_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');
    let valorInput2 = e.target.value;


    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.ti_materno.style.border = "3px solid red";
        baderas.bti_ma = false;
	}else{
        formulario.ti_materno.removeAttribute("style");
        baderas.bti_ma = true;
    }

});
/**ti telefono */
formulario.ti_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
     .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formulario.ti_tele.style.border = "3px solid red";
        baderas.bti_te = false;
	}else{
        formulario.ti_tele.removeAttribute("style");
        baderas.bti_te = true;
    }
    
});
/**ti  extension telefono */
formulario.ti_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
     .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formulario.ti_exten.style.border = "3px solid red";
        baderas.bti_exten = false;
	}else{
        formulario.ti_exten.removeAttribute("style");
        baderas.bti_exten = true;
    }
    
});
/**ti correo */
formulario.ti_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formulario.ti_correo.style.border = "3px solid red";
        baderas.bti_correo = false;
	}else{
        formulario.ti_correo.removeAttribute("style");
        baderas.bti_correo = true;
    }
    
    
});

/////////////////////////////   cp  ///////////////////////////////////////////
/* capacitacion nombre */
formulario.ac_nombre.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ac_nombre.value = valorInput
    .trimEnd();
});
formulario.ac_nombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_nombre.value = valorInput

     // Eliminar caracteres especiales
     .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

     let valorInput2 = e.target.value;
    if (!expresiones.nombre_area.test(valorInput2)) {
        formulario.ac_nombre.style.border = "3px solid red";
        baderas.bca_nombre = false;
	}else{
        formulario.ac_nombre.removeAttribute("style");
        baderas.bca_nombre = true;
    }
   
});
/* ca paterno */
formulario.ac_paterno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ac_paterno.value = valorInput
    .trimEnd();
});
formulario.ac_paterno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_paterno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.ac_paterno.style.border = "3px solid red";
        baderas.bca_pa = false;
	}else{
        formulario.ac_paterno.removeAttribute("style");
        baderas.bca_pa = true;
    }
   
    
});

/* ca materno */
formulario.ac_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ac_materno.value = valorInput
    .trimEnd();
    if(e.target.value.length == 0 ){
        formulario.ac_materno.removeAttribute("style");
        baderas.bca_ma = true;
    }
});
formulario.ac_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[^a-zA-ZÁ-Ýá-ý\.\s]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.apellidos.test(valorInput2)) {
        formulario.ac_materno.style.border = "3px solid red";
        baderas.bca_ma = false;
	}else{
        formulario.ac_materno.removeAttribute("style");
        baderas.bca_ma = true;
    }
   
    
});
/**ca telefono */
formulario.ac_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.telefono.test(valorInput2)) {
        formulario.ac_tele.style.border = "3px solid red";
        baderas.bca_te = false;
	}else{
        formulario.ac_tele.removeAttribute("style");
        baderas.bca_te = true;
    }
    
});
/**ca  extension telefono */
formulario.ac_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.exten.test(valorInput2)) {
        formulario.ac_exten.style.border = "3px solid red";
        baderas.bca_exten = false;
	}else{
        formulario.ac_exten.removeAttribute("style");
        baderas.bca_exten = true;
    }
   
    
});
/**ca correo */
formulario.ac_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^a-zA-Z0-9.\-_@\.]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.email.test(valorInput2)) {
        formulario.ac_correo.style.border = "3px solid red";
        baderas.bca_correo = false;
	}else{
        formulario.ac_correo.removeAttribute("style");
        baderas.bca_correo = true;
    }
    
    
});
const boton_enviar = document.getElementById("boton_registrar");
boton_enviar.addEventListener("click",(e)=>{
    
    
    if(baderas.brfc == false){
        rfc.style.border = "3px solid red";
    }
    if(baderas.bnombre_empresa == false){
        document.getElementById("nombre").style.border = "3px solid red";
    }
    if(baderas.bcorreo_empresa == false){
        document.getElementById("correo_m").style.border = "3px solid red";
    }
    if(baderas.bcontra == false ){
        document.getElementById("password").style.border = "3px solid red";
    }
    if(baderas.bcontra_conf == false){
        document.getElementById("password_confirmacion").style.border = "3px solid red";
    }
    if(baderas.brazon == false){
        document.getElementById("razon").style.border = "3px solid red";
    }
    if(baderas.bcodigo_postal == false){
        document.getElementById("codigo_postal").style.border = "3px solid red";
    }
    if(baderas.bcalle == false){
        document.getElementById("calle").style.border = "3px solid red";
    }
    // if(baderas.bciudad == false){
    //     document.getElementById("ciudad").style.border = "3px solid red";
    // }
    // if(baderas.bestado == false){
    //     document.getElementById("estado").style.border = "3px solid red";
    // }
    if(baderas.brh_nombre == false){
        document.getElementById("rh_nombre").style.border = "3px solid red";
    }
    if(baderas.brh_pa == false){
        document.getElementById("rh_paterno").style.border = "3px solid red";
    }
    if(baderas.brh_ma == false){
        document.getElementById("rh_materno").style.border = "3px solid red";
    }
    if(baderas.brh_te == false){
        document.getElementById("rh_tele").style.border = "3px solid red";
    }
    if(baderas.brh_exten == false){
        document.getElementById("rh_exten").style.border = "3px solid red";
    }
    if(baderas.brh_correo == false){
        document.getElementById("rh_correo").style.border = "3px solid red";
    }
    if(baderas.bti_nombre == false){
        document.getElementById("ti_nombre").style.border = "3px solid red";
    }
    
    if(baderas.bti_pa == false){
        document.getElementById("ti_paterno").style.border = "3px solid red";
    }
    if(baderas.bti_ma == false){
        document.getElementById("ti_materno").style.border = "3px solid red";
    }
    if(baderas.bti_te == false){
        document.getElementById("ti_tele").style.border = "3px solid red";
    }
    if(baderas.bti_exten == false){
        document.getElementById("ti_exten").style.border = "3px solid red";
    }
    if(baderas.bti_correo == false){
        document.getElementById("ti_correo").style.border = "3px solid red";
    }
    if(baderas.bca_nombre == false){
        document.getElementById("ac_nombre").style.border = "3px solid red";
    }
    if(baderas.bca_pa == false){
        document.getElementById("ac_paterno").style.border = "3px solid red";
    }
    if(baderas.bca_ma == false){  
        document.getElementById("ac_materno").style.border = "3px solid red";
    }
    if(baderas.bca_te == false){
        document.getElementById("ac_tele").style.border = "3px solid red";
    }
    if(baderas.bca_exten == false){
        document.getElementById("ac_exten").style.border = "3px solid red";
    }
    if(baderas.bca_correo == false){
        document.getElementById("ac_correo").style.border = "3px solid red";
    }
    validar(e);
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
        document.getElementById("ciudad").disabled = false;
        document.getElementById("estado").disabled = false;
    }
}

    

    
