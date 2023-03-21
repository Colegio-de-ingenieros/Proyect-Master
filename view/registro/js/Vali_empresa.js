let baderas = {
     brfc: false,
     bnombre_empresa: false,
     bcorreo_empresa: false,
     bcontra: false,
     bcontra_conf: false,
     brazon: false,

     bcodigo_postal: false,
     bcalle: false,
     bciudad: false,
     bestado: false,

     brh_nombre: false,
     brh_pa:  false,
     brh_ma: false,
     brh_te: false,
     brh_exten: false,
     brh_correo: false,

     bti_nombre: false,
     bti_pa:  false,
     bti_ma: false,
     bti_te: false,
     bti_exten: false,
     bti_correo: false,

     bca_nombre: false,
     bca_pa:  false,
     bca_ma: false,
     bca_te: false,
     bca_exten: false,
     bca_correo: false
}

const expresiones = {
    rfc:/^[A-Z0-9]{3}[0-9]{6}[A-Z0-9]{3}$/,
    nombre:/^[a-zA-ZÁ-Ýá-ý\s]{3,100}$/,
    calle:/^[a-zA-ZÁ-Ýá-ý\s]+#[0-9\s]{1,100}$/,
    email:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
    password:/^(?=.*[0-9])(?=.*[!@#$*-_\.])[a-zA-Z0-9!@#$*-_\.]{8,16}$/,
    razon:/^[a-zA-ZÁ-ý\s,\.]{3,100}$/,
    postal:/^[0-9]{5}$/,
    estado:/^[a-zA-ZÁ-Ýá-ý\s]{3,50}$/,
    nombre_area:/^[a-zA-ZÁ-Ýá-ý\s]{3,40}$/,
    apellidos:/^[a-zA-ZÁ-Ýá-ý\s]{3,20}$/,
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.rfc.test(valorInput)) {
        formulario.rfc.style.border = "3px solid red";
        baderas.brfc = false;
	}else{
        formulario.rfc.removeAttribute("style");
        baderas.brfc = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');

    if (!expresiones.nombre.test(valorInput)) {
        formulario.nombre.style.border = "3px solid red";
        baderas.bnombre_empresa = false;
	}else{
        formulario.nombre.removeAttribute("style");
        baderas.bnombre_empresa = true;
    }
    validar();
});
/**correo empresa */
formulario.correo_m.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.correo_m.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.correo_m.style.border = "3px solid red";
        baderas.bcorreo_empresa = false;
	}else{
        formulario.correo_m.removeAttribute("style");
        baderas.bcorreo_empresa = true;
    }
    validar();
});

/* password*/
formulario.password.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.password.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!%^&^()\-=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.password.test(valorInput)) {
        password.style.border = "3px solid red";
        baderas.bcontra = false
	}else{
        password.removeAttribute("style");
        baderas.bcontra = true
    }
    validar();
});
/* password confrimacion*/
formulario.password_confirmacion.addEventListener('blur', (e) => {
    let valorpassword = document.getElementById("password").value;
    let valor2 = document.getElementById("password_confirmacion").value ;

	if((valorpassword == valor2) == false){
        password_confirmacion.style.border = "3px solid red";
        bcontra_conf = false
    }
});
formulario.password_confirmacion.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.password_confirmacion.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!%^&^()\-=\[\]{};':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.password.test(valorInput)) {
        password_confirmacion.style.border = "3px solid red";
        baderas.bcontra_conf = false
	}else{
        password_confirmacion.removeAttribute("style");
        baderas.bcontra_conf = true
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?]/g, '');


    if (!expresiones.razon.test(valorInput)) {
        formulario.razon.style.border = "3px solid red";
        baderas.brazon = false;
	}else{
        formulario.razon.removeAttribute("style");
        baderas.brazon = true;
    }
    validar();
});
/**codigo postal */
formulario.codigo_postal.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.codigo_postal.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.postal.test(valorInput)) {
        formulario.codigo_postal.style.border = "3px solid red";
        baderas.bcodigo_postal = false;
	}else{
        formulario.codigo_postal.removeAttribute("style");
        baderas.bcodigo_postal = true;
        baderas.bestado = true;
        baderas.bciudad = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.calle.test(valorInput)) {
        formulario.calle.style.border = "3px solid red";
        baderas.bcalle = false;
	}else{
        formulario.calle.removeAttribute("style");
        baderas.bcalle = true;
    }
    validar(); 
});
/**ciudad */
formulario.ciudad.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ciudad.value = valorInput
    .trimEnd();
});
formulario.ciudad.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ciudad.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.nombre.test(valorInput)) {
        formulario.ciudad.style.border = "3px solid red";
        baderas.bciudad = false;
	}else{
        formulario.ciudad.removeAttribute("style");
        baderas.bciudad = true;
    }
    validar();
});
/**estado */
formulario.estado.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.estado.value = valorInput
    .trimEnd();
});
formulario.estado.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.estado.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.estado.test(valorInput)) {
        formulario.estado.style.border = "3px solid red";
        baderas.bestado = false;
	}else{
        formulario.estado.removeAttribute("style");
        baderas.bestado = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.nombre_area.test(valorInput)) {
        formulario.rh_nombre.style.border = "3px solid red";
        baderas.brh_nombre = false;
	}else{
        formulario.rh_nombre.removeAttribute("style");
        baderas.brh_nombre = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.rh_paterno.style.border = "3px solid red";
        baderas.brh_pa = false;
	}else{
        formulario.rh_paterno.removeAttribute("style");
        baderas.brh_pa = true;
    }
    validar();
});

/* rh materno */
formulario.rh_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.rh_materno.value = valorInput
    .trimEnd();
});
formulario.rh_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.rh_materno.style.border = "3px solid red";
        baderas.brh_ma = false;
	}else{
        formulario.rh_materno.removeAttribute("style");
        baderas.brh_ma = true;
    }
    validar();
});
/**rh telefono */
formulario.rh_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario.rh_tele.style.border = "3px solid red";
        baderas.brh_te = false;
	}else{
        formulario.rh_tele.removeAttribute("style");
        baderas.brh_te = true;
    }
    validar();
});
/**rh  extension telefono */
formulario.rh_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.exten.test(valorInput)) {
        formulario.rh_exten.style.border = "3px solid red";
        baderas.brh_exten = false;
	}else{
        formulario.rh_exten.removeAttribute("style");
        baderas.brh_exten = true;
    }
    validar();
});
/**rh correo */
formulario.rh_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.rh_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.rh_correo.style.border = "3px solid red";
        baderas.brh_correo = false;
	}else{
        formulario.rh_correo.removeAttribute("style");
        baderas.brh_correo = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.nombre_area.test(valorInput)) {
        formulario.ti_nombre.style.border = "3px solid red";
        baderas.bti_nombre = false;
	}else{
        formulario.ti_nombre.removeAttribute("style");
        baderas.bti_nombre = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.ti_paterno.style.border = "3px solid red";
        baderas.bti_pa = false;
	}else{
        formulario.ti_paterno.removeAttribute("style");
        baderas.bti_pa = true;
    }
    validar();
});

/* ti materno */
formulario.ti_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ti_materno.value = valorInput
    .trimEnd();
});
formulario.ti_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.ti_materno.style.border = "3px solid red";
        baderas.bti_ma = false;
	}else{
        formulario.ti_materno.removeAttribute("style");
        baderas.bti_ma = true;
    }
    validar();
});
/**ti telefono */
formulario.ti_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario.ti_tele.style.border = "3px solid red";
        baderas.bti_te = false;
	}else{
        formulario.ti_tele.removeAttribute("style");
        baderas.bti_te = true;
    }
    validar();
});
/**ti  extension telefono */
formulario.ti_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.exten.test(valorInput)) {
        formulario.ti_exten.style.border = "3px solid red";
        baderas.bti_exten = false;
	}else{
        formulario.ti_exten.removeAttribute("style");
        baderas.bti_exten = true;
    }
    validar();
});
/**ti correo */
formulario.ti_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ti_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.ti_correo.style.border = "3px solid red";
        baderas.bti_correo = false;
	}else{
        formulario.ti_correo.removeAttribute("style");
        baderas.bti_correo = true;
    }
    validar();
    
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.nombre_area.test(valorInput)) {
        formulario.ac_nombre.style.border = "3px solid red";
        baderas.bca_nombre = false;
	}else{
        formulario.ac_nombre.removeAttribute("style");
        baderas.bca_nombre = true;
    }
    validar();
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
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.ac_paterno.style.border = "3px solid red";
        baderas.bca_pa = false;
	}else{
        formulario.ac_paterno.removeAttribute("style");
        baderas.bca_pa = true;
    }
    validar();
    
});

/* ca materno */
formulario.ac_materno.addEventListener('blur', (e) => {
    let valorInput = e.target.value;
	formulario.ac_materno.value = valorInput
    .trimEnd();
});
formulario.ac_materno.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_materno.value = valorInput

     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?]/g, '');


    if (!expresiones.apellidos.test(valorInput)) {
        formulario.ac_materno.style.border = "3px solid red";
        baderas.bca_ma = false;
	}else{
        formulario.ac_materno.removeAttribute("style");
        baderas.bca_ma = true;
    }
    validar();
    
});
/**ca telefono */
formulario.ac_tele.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_tele.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.telefono.test(valorInput)) {
        formulario.ac_tele.style.border = "3px solid red";
        baderas.bca_te = false;
	}else{
        formulario.ac_tele.removeAttribute("style");
        baderas.bca_te = true;
    }
    validar();
});
/**ca  extension telefono */
formulario.ac_exten.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_exten.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.exten.test(valorInput)) {
        formulario.ac_exten.style.border = "3px solid red";
        baderas.bca_exten = false;
	}else{
        formulario.ac_exten.removeAttribute("style");
        baderas.bca_exten = true;
    }
    validar();
    
});
/**ti correo */
formulario.ac_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.ac_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖ·Ü¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡#$%^&^*()\-=\[\]{};':"\\|,<>\/?]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.email.test(valorInput)) {
        formulario.ac_correo.style.border = "3px solid red";
        baderas.bca_correo = false;
	}else{
        formulario.ac_correo.removeAttribute("style");
        baderas.bca_correo = true;
    }
    validar();
    
});
const boton_enviar = document.getElementById("boton_registrar");

function validar() {
    //si hay una bandera en falso la coloca en rojo

    let is_ok = true;
    
    for (const key in baderas) {

        if(baderas[key] == false){
            is_ok = false;
        }

    }
    if(is_ok){
        boton_enviar.disabled=false;
    }else{
        boton_enviar.disabled=true;
    }
}

    

    