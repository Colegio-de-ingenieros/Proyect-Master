let bNom = false
let bAcad = false
let bTech = false
let bDesc = false
let bEmail = false
let bcodigo_postal= false
let bcalle= false
let bciudad= true
let bestado= true
let bExp= false 
let bBruto = false
let bMensual = false
let bandTel = false
console.log("entro a validar");
let botonRegresar = document.getElementById("boton_registro");
botonRegresar.addEventListener("click", (e) => {


    if(bNom==false){
        nom_vacante.style.border = "3px solid red";
    }else if(bExp==false){
        experiencia_lab.style.border = "3px solid red";
    }else if(bAcad==false){
        requi_academicos.style.border = "3px solid red";
    }else if(bTech==false){
        requi_tecnicos.style.border = "3px solid red";
    }else if(bDesc==false){
        descri_puesto.style.border = "3px solid red";
    }else if(bBruto==false){
        sal_bruto.style.border = "3px solid red";
    }else if(bMensual==false){
        sal_mensual.style.border = "3px solid red";
    }else if(bandTel==false){
        caja_telefono.style.border = "3px solid red";
    }else if(bEmail==false){
        caja_correo.style.border = "3px solid red";
    }else if(bcodigo_postal==false){
        cpPerso.style.border = "3px solid red";
    }else if(bcalle==false){
        calle.style.border = "3px solid red";
    }else if(bciudad==false){
        ciudad.style.border = "3px solid red";
    }else if(bestado==false){
        estado.style.border = "3px solid red";
    
    }else{
        validar(true);
    }
});

const expresiones = {
    cadenasGeneral:/^[a-zA-ZÁ-ý 0-9.\s]{1,50}$/,
    cadenasAcademicos:/^[a-zA-ZÁ-ý 0-9,.\s]{1,50}$/,
    cadenasDescripcion:/^[a-zA-ZÁ-ý 0-9,.\s]{1,100}$/,
    postal:/^[0-9]{5}$/,
    estado:/^[a-zA-ZÁ-Ýá-ý\s]{1,50}$/,
    calle:/^[a-zA-ZÁ-Ýá-ý\.\s]+([\/\s#]?)((?:.*[0-9\s])?)([a-zA-Z]?)?$/,
    experiencia:/^[0-9]{1,2}$/,
    precio: /^[0-9]+(.([0-9])+)*$/,
    email:/^[a-zA-Z0-9.-_+]+@[a-zA-Z]+\.[a-zA-Z]/,
    telefono:/^[0-9]{10}$/,
    passw:/^((?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])).{8,16}$/,
}
//validar nombre de vacante
formula.nom_vacante.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    
    //console.log(valorInput);
	formula.nom_vacante.value = valorInput
   // Eliminar numeros
   //.replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    if (!expresiones.cadenasGeneral.test(valorInput)) {
        nom_vacante.style.border = "3px solid red";
        bNom = false
	}else{
        nom_vacante.removeAttribute("style");
        bNom = true
    }
    validar(bNom);
})
//validar tecnologias
formula.requi_academicos.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    //console.log(valorInput);
	formula.requi_academicos.value = valorInput
   // Eliminar numeros
   //.replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.cadenasAcademicos.test(valorInput)) {
        requi_academicos.style.border = "3px solid red";
        bAcad = false
	}else{
        requi_academicos.removeAttribute("style");
        bAcad = true
    }
    validar(bAcad);
})
//validar tecnicos
formula.requi_tecnicos.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    //console.log(valorInput);
	formula.requi_tecnicos.value = valorInput
   // Eliminar numeros
   //.replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|,<>\/?]/g, '')

    if (!expresiones.cadenasGeneral.test(valorInput)) {
        requi_tecnicos.style.border = "3px solid red";
        bTech = false
	}else{
        requi_tecnicos.removeAttribute("style");
        bTech = true
    }
    validar(bTech);
})
//validar descripcion
formula.descri_puesto.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    //console.log(valorInput);
    console.log(valorInput.length);
	formula.descri_puesto.value = valorInput
   // Eliminar numeros
   //.replace(/[0-9]/g, '')
   // Eliminar caracteres especiales
  .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@#$%^&^*()_+\-=\[\]{};':"\\|<>\/?]/g, '')

    if (!expresiones.cadenasDescripcion.test(valorInput)) {
        descri_puesto.style.border = "3px solid red";
        bDesc = false
	}else{
        descri_puesto.removeAttribute("style");
        bDesc = true
    }
    validar(bDesc);
})
//validar codigo postal
formula.cpPerso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formula.cpPerso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    let valorInput2 = e.target.value;
    if (!expresiones.postal.test(valorInput2)) {
        formula.cpPerso.style.border = "3px solid red";
        bcodigo_postal = false;
	}else{
        cpPerso.removeAttribute("style");
        bcodigo_postal = true;
        bestado = true;
        bciudad = true;
    }
    document.getElementById("cpPerso").addEventListener('blur', (e) => {
        let contenido =  document.getElementById("cpPerso").value;
        
        if(contenido.length == 5){
            //console.log(contenido);
            let formulario_data = new FormData();
            formulario_data.append("cpPerso",contenido);
            
    
            fetch("../../controller/registro/codigo_postal.php",
            {
                method: 'POST',
                body: formulario_data,
            })
            .then(response => response.json())
            .then(data => {
                if(data.length != 0){
                    cpPerso.removeAttribute("style");
                    bcodigo_postal = true;
                }else{
                    formula.cpPerso.style.border = "3px solid red";
                    bcodigo_postal = false;
                    contenido.value="";
                }
                
            });
    
        }
      });
    validar(bcodigo_postal);
})
formula.calle.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formula.calle.value = valorInput
     // Eliminar caracteres especiales
     .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôö·òûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷°¨±~!¡@$%^&^*()_+\-=\[\]{};,':"\\|<>\/?]/g, '');

    let valorInput2 = e.target.value;
    if (!expresiones.calle.test(valorInput2)) {
        calle.style.border = "3px solid red";
        bcalle = false;
	}else{
        calle.removeAttribute("style");
        bcalle = true;
    }
    validar(bcalle);
});
//validar años de experiencia
formula.experiencia_lab.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formula.experiencia_lab.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[^0-9]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    if (!expresiones.experiencia.test(valorInput)) {
        experiencia_lab.style.border = "3px solid red";
        bExp = false;
	}else{
        experiencia_lab.removeAttribute("style");
        bExp = true;
    }
    validar(bExp);
})

formula.sal_bruto.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formula.sal_bruto.value = valorInput

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
        sal_bruto.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        formula.sal_bruto.value = valorInput;
        bBruto  = false
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        //precioAsoc.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formula.sal_bruto.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        sal_bruto.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        formula.sal_bruto.value = valorInput;
        bBruto  = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        sal_bruto.style.border = "3px solid red";
        bBruto  = false
        
    }
    else {
        sal_bruto.removeAttribute("style");
        bBruto  = true;
    }

    validar(bBruto);

})

formula.sal_mensual.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    formula.sal_mensual.value = valorInput

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
        sal_mensual.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        formula.sal_mensual.value = valorInput;
        bMensual  = false
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        //precioAsoc.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        formula.sal_mensual.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        sal_mensual.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        formula.sal_mensual.value = valorInput;
        bMensual  = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        sal_mensual.style.border = "3px solid red";
        bMensual  = false
        
    }
    else {
        sal_mensual.removeAttribute("style");
        bMensual  = true;
    }

    validar(bMensual);

})
formula.caja_correo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formula.caja_correo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæÆôöòûùÿÖÜñÑ¢£¥₧ƒªº¿⌐¬½¼«»°¨÷±~!¡#$%^&^*()¨+`´\-=\[\]{};·':"\\|,<>\/?]/g, '')
    // Eliminar el ultimo espaciado
    //condicional para que no inice con un numero
    .replace(/^[0-9]/g, '')
    //condicional para que no haya mas de un arroba
    .replace(/@{2,}/g, '@')
   .trim();

    if (!expresiones.email.test(valorInput)) {
        caja_correo.style.border = "3px solid red";
        bEmail = false
	}else{
        caja_correo.removeAttribute("style");
        bEmail = true
    }
    validar(bEmail);
})

/* Input telefono*/
formula.caja_telefono.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formula.caja_telefono.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
	// Eliminar letras
	.replace(/\D/g, '')
	// Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.telefono.test(valorInput)) {
        caja_telefono.style.border = "3px solid red";
        bandTel = false
	}else{
        caja_telefono.removeAttribute("style");
        bandTel = true
    }
    validar(bandTel);
})
function validar(bandera){
    const guardar = document.getElementById('boton_registro');
    if(bandera == false){              
        guardar.disabled=true;
        
    }
    else if (bandera == true){
        guardar.disabled=false;
        

    }
    else{
        guardar.disabled=true;
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
