let puest= false
let puest2= false
let empr = false
let empr2 = false
let carr = false
let carr2 = false
let carr3 = false
let obj = false
let sal = false
let ced = false
let ced2 = false
let ced3 = false
let acti = false
let acti2 = false

let segunda_carrera = 0;
let tercer_carrera = 0;

let segundo_puesto = 0;



const expresiones = {
    nombre:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,40}$/,
    org:/^[a-zA-ZÁ-Ýá-ý.\s]{1,50}$/,
    horas:/^[0-9]{3}$/,
    objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,\n]+$/,
    precio: /^[0-9]+(.([0-9])+)*$/,
    cedula:/^[0-9]{7,8}/,
    nombre_carrera:/^[0-9a-zA-ZÁ-Ýá-ý.,\s]{1,40}$/,
    empresa:/^[a-zA-ZÁ-Ýá-ý0-9.,\s]{1,100}$/,
    puesto: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,50}/,
}

let actividad2 = document.getElementById("actividad-antigua-2");
actividad2.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    actividad2.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
       /*  actividad2.style.border = "3px solid red"; */
        acti2 = false
        if (actividad2.value==="") {
            actividad2.removeAttribute("style");
        }
    } else {
        actividad2.removeAttribute("style");
        acti2 = true
    }
    /* validar(Obj); */
})

let actividad = document.getElementById("actividad-antigua-1");
actividad.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    actividad.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        actividad.style.border = "3px solid red";
        acti = false
    } else {
        actividad.removeAttribute("style");
        acti = true
    }
    /* validar(Obj); */
})

let puesto1 = document.getElementById("puesto-antiguo-2");
puesto1.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    puesto1.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.puesto.test(valorInput)) {
        /* puesto1.style.border = "3px solid red"; */
        puest2 = false
        if (puesto1.value==="") {
            puesto1.removeAttribute("style");
        }
    } else {
        puesto1.removeAttribute("style");
        puest2 = true
    }
    /* validar(Obj); */
})

let puesto = document.getElementById("puesto-antiguo-1");
puesto.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    puesto.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.puesto.test(valorInput)) {
        puesto.style.border = "3px solid red";
        puest = false
    } else {
        puesto.removeAttribute("style");
        puest = true
    }
    /* validar(Obj); */
})

let empresa2 = document.getElementById("empresa-antigua-2");
empresa2.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
   
    empresa2.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.empresa.test(valorInput)) {
        /* empresa2.style.border = "3px solid red"; */
        empr2 = false;
        if (empresa2.value==="") {
            empresa2.removeAttribute("style");
        }
	}else{
        empresa2.removeAttribute("style");
        empr2 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let empresa = document.getElementById("empresa-antigua-1");
empresa.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
   
    empresa.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.empresa.test(valorInput)) {
        empresa.style.border = "3px solid red";
        empr = false;
	}else{
        empresa.removeAttribute("style");
        empr = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let carrera3 = document.getElementById("carrera-3");
carrera3.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera3.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera3.style.border = "3px solid red";
        carr3 = false;
        if (carrera3.value.trim().length == 0) {
            carrera3.removeAttribute("style");
        }
	}else{
        carrera3.removeAttribute("style");
        carr3 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let carrera1 = document.getElementById("carrera-2");
carrera1.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera1.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera1.style.border = "3px solid red";
        carr2 = false;
        if (carrera1.value.trim().length == 0) {
            carrera1.removeAttribute("style");
        }
	}else{
        carrera1.removeAttribute("style");
        carr2 = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);


let carrera = document.getElementById("carrera-1");
carrera.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    /* let laboral=document.getElementById('checkboxlaboral');

    if(valorInput !="" && laboral.checked){

    
	carrera.value = valorInput */

    // Eliminar caracteres especiales
    carrera.value = valorInput
    .replace(/[0-9üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')

    if (!expresiones.nombre_carrera.test(valorInput)) {
        carrera.style.border = "3px solid red";
        carr = false;
	}else{
        carrera.removeAttribute("style");
        carr = true;
    }
    /* validar(bandEmpLab); */
    }/* else{
        validar(true);
    } */
);

let objetivo = document.getElementById("objetivo");
objetivo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    objetivo.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        obj = false
    } else {
        objetivo.removeAttribute("style");
        obj = true
    }
    /* validar(Obj); */
})

let salario = document.getElementById("salario");
salario.addEventListener('keyup', (e) =>{
    let valorInput = e.target.value;
    salario.value = valorInput

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
        salario.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length-1);
        salario.value = valorInput;
        sal = false
    }

    //elimina el tercer decimal
    if (validarDecimales(valorInput) == true) {
        //precioAsoc.style.border = "3px solid red";
        valorInput = valorInput.substr(0, valorInput.length - 1);
        salario.value = valorInput;
    }

    //elimina el primer caracter si es un punto
    if (primeroNum(valorInput) == true) {
        salario.style.border = "3px solid red";
        valorInput = valorInput.substr(1, valorInput.length);
        //alert(valorInput.length);
        salario.value = valorInput;
        sal = false
    }

    //verifica que se cumpla con la expresion correpondiente    
    if (!expresiones.precio.test(valorInput)) {
        salario.style.border = "3px solid red";
        sal = false
        
    }
    else {
        salario.removeAttribute("style");
        sal = true;
    }

   /*  validar(precioG) */

})

let cedulas= document.getElementById("cedula-1");
cedulas.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        cedulas.style.border = "3px solid red";
        ced = false;
	}else{ 
        cedulas.removeAttribute("style");
        ced = true;
    }
 /*    validar(bandCedu); */
    }
});

let cedulas2 = document.getElementById("cedula-2");
cedulas2.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas2.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        /* cedulas2.style.border = "3px solid red"; */
        ced2 = false;
        if (cedulas2.value.trim().length >= 7 || cedulas2.value.trim().length == 0) {
            cedulas2.removeAttribute("style");
        }
	}else{ 
        cedulas2.removeAttribute("style");
        ced2 = true;
    }
 /*    validar(bandCedu); */
    }
});

let cedulas3 = document.getElementById("cedula-3");
cedulas3.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;
    if(valorInput !==""){
	cedulas3.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
    // Eliminar caracteres especiales
   .replace(/[^0-9]/g, '')
    // Eliminar el ultimo espaciado
   .trim();

    if (!expresiones.cedula.test(valorInput)) {
        /* cedulas3.style.border = "3px solid red"; */
        ced3 = false;
        if (cedulas3.value.trim().length >= 7 || cedulas3.value.trim().length == 0) {
            cedulas3.removeAttribute("style");
        }
	}else{ 
        cedulas3.removeAttribute("style");
        ced3= true;
    }
 /*    validar(bandCedu); */
    }
});

/* function validar(bandera){
    const guardar = document.getElementById('boton_registrar');

    if(bandera == false){              
        guardar.disabled=true;
        
    }else{
        guardar.disabled=false;
    }

} */


function datos(){
    if (salario.value.trim().length != 0){
        sal = true;
    }
    if (objetivo.value.trim().length != 0){
        obj = true;
    }
    if (carrera.value.trim().length != 0){
        carr = true;
    }
    if (cedulas.value.trim().length >= 7){
        ced = true;
    }
    if (puesto.value.trim().length != 0){
        puest = true;
    }
    if (empresa.value.trim().length != 0){
        empr = true;
    }
    if (actividad.value.trim().length != 0){
        acti = true;
    }
    console.log(sal, obj, carr, ced, puest, empr, acti)

    if (sal == false){
        salario.style.border = "3px solid red";
    }
    else if (obj == false){
        objetivo.style.border = "3px solid red";
    }
    else if (carr == false){
        carrera.style.border = "3px solid red";
    }
    else if (ced == false){
        cedulas.style.border = "3px solid red";
    }
    else if ((document.getElementById("carrera-2").value !== "" && document.getElementById("cedula-2").value === "")
    ||(document.getElementById("carrera-2").value === "" && document.getElementById("cedula-2").value !== "")){
    alert("llene correctamente los campos de la segunda carrera");
    }
    else if (document.getElementById("carrera-2").value !== "" && document.getElementById("cedula-2").value.trim().length < 7){
        alert("llene correctamente los campos de la segunda carrera");
    }
    else if ((document.getElementById("carrera-3").value !== "" && document.getElementById("cedula-3").value === "")
    ||(document.getElementById("carrera-3").value === "" && document.getElementById("cedula-3").value !== "")){
    alert("llene correctamente los campos de la tercera carrera");
    }
    else if (document.getElementById("carrera-3").value !== "" && document.getElementById("cedula-3").value.trim().length < 7){
        alert("llene correctamente los campos de la tercera carrera");
    }
    else if ((document.getElementById("puesto-antiguo-2").value !== "" && document.getElementById("empresa-antigua-2").value === "" && document.getElementById("actividad-antigua-2").value === "")
    ||(document.getElementById("puesto-antiguo-2").value === "" && document.getElementById("empresa-antigua-2").value !== "" && document.getElementById("actividad-antigua-2").value === "")
    ||(document.getElementById("puesto-antiguo-2").value === "" && document.getElementById("empresa-antigua-2").value === "" && document.getElementById("actividad-antigua-2").value !== "")
    ||(document.getElementById("puesto-antiguo-2").value === "" && document.getElementById("empresa-antigua-2").value !== "" && document.getElementById("actividad-antigua-2").value !== "")
    ||(document.getElementById("puesto-antiguo-2").value !== "" && document.getElementById("empresa-antigua-2").value === "" && document.getElementById("actividad-antigua-2").value !== "")
    ||(document.getElementById("puesto-antiguo-2").value !== "" && document.getElementById("empresa-antigua-2").value !== "" && document.getElementById("actividad-antigua-2").value === "")){
    alert("llene los campos de la segunda experiencia laboral");
    }
    else if (puest == false){
        puesto.style.border = "3px solid red";
    }
    else if (empr == false){
        empresa.style.border = "3px solid red";
    }
    else if (acti == false){
        actividad.style.border = "3px solid red";
    }
    else {
        segunda_carrera = 0;
        tercer_carrera = 0;
        segundo_puesto= 0;
        if (document.getElementById("carrera-2").value !== "" && document.getElementById("cedula-2").value !== ""){
            segunda_carrera = 1;
        }
        if (document.getElementById("carrera-3").value !== "" && document.getElementById("cedula-3").value !== ""){
            tercer_carrera = 1;
        }
        if(document.getElementById("puesto-antiguo-2").value !== "" && document.getElementById("empresa-antigua-2").value !== "" && document.getElementById("actividad-antigua-2").value !== ""){
            segundo_puesto= 1;
        }

        // Seleccionar el elemento del tipo "date" por su id
        const date_inicio1 = document.getElementById('periodo-inicio-antigua-1').value;
        const date_fin1 = document.getElementById('periodo-fin-antigua-1').value;
        // Verificar si el elemento existe
        if ((date_inicio1  === "" && date_fin1 !== "") || (date_inicio1  !== "" && date_fin1  === "") || (date_inicio1  === "" && date_fin1  === "")) {
        // El elemento existe y es de tipo "date"
        alert('Indique periodo de inicio y fin de la primera experiencia profesional');
        } 
        else{

        const date_inicio2 = document.getElementById('periodo-inicio-antigua-2').value;
        const date_fin2 = document.getElementById('periodo-fin-antigua-2').value;

        if (((date_inicio2  === "" && date_fin2 !== "") || (date_inicio2  !== "" && date_fin2  === "") || (date_inicio2  === "" && date_fin2  === "")) && segundo_puesto == 1) {
        alert('Indique periodo de inicio y fin de la segunda experiencia profesional');
        } 
        else{

        console.log("todo bien");
        datos_generales = [];
        experiencia_academica_general = [];
        experiencia_profesional_general = [];

        experiencia_academica_particular = [];
        experiencia_profesional_particular = [];

        var combo = document.getElementById("residencia-campo").value;
        /* combo = combo-1; */
        var miVariable = localStorage.getItem('miVariable');
        datos_generales.push(miVariable);
        datos_generales.push(combo);
        datos_generales.push(document.getElementById("salario").value);
        datos_generales.push(document.getElementById("objetivo").value);

        experiencia_academica_particular.push(document.getElementById("carrera-1").value);
        experiencia_academica_particular.push(document.getElementById("cedula-1").value);
        experiencia_academica_general.push(experiencia_academica_particular);

        if (segunda_carrera == 1){
            experiencia_academica_particular = [];
            experiencia_academica_particular.push(document.getElementById("carrera-2").value);
            experiencia_academica_particular.push(document.getElementById("cedula-2").value);
            experiencia_academica_general.push(experiencia_academica_particular);
        }
        if (tercer_carrera == 1){
            experiencia_academica_particular = [];
            experiencia_academica_particular.push(document.getElementById("carrera-3").value);
            experiencia_academica_particular.push(document.getElementById("cedula-3").value);
            experiencia_academica_general.push(experiencia_academica_particular);
        }

        experiencia_profesional_particular.push(document.getElementById("puesto-antiguo-1").value);
        experiencia_profesional_particular.push(document.getElementById("empresa-antigua-1").value);
        experiencia_profesional_particular.push(document.getElementById('periodo-inicio-antigua-1').value);
        experiencia_profesional_particular.push(document.getElementById('periodo-fin-antigua-1').value);
        experiencia_profesional_particular.push(document.getElementById("actividad-antigua-1").value);
        experiencia_profesional_general.push(experiencia_profesional_particular);

        if (segundo_puesto == 1){
            experiencia_profesional_particular = [];
            experiencia_profesional_particular.push(document.getElementById("puesto-antiguo-2").value);
            experiencia_profesional_particular.push(document.getElementById("empresa-antigua-2").value);
            experiencia_profesional_particular.push(document.getElementById('periodo-inicio-antigua-2').value);
        experiencia_profesional_particular.push(document.getElementById('periodo-fin-antigua-2').value);
            experiencia_profesional_particular.push(document.getElementById("actividad-antigua-2").value);
            experiencia_profesional_general.push(experiencia_profesional_particular);
        }

        console.log(datos_generales);
        console.log(experiencia_academica_general);
        console.log(experiencia_profesional_general);

        // Crear un objeto FormData
        const datos = new FormData();

        // Agregar variables al objeto FormData
        datos.append('datos_generales',JSON.stringify(datos_generales));
        datos.append('experiencia_academica_general', JSON.stringify(experiencia_academica_general));
        datos.append('experiencia_profesional_general', JSON.stringify(experiencia_profesional_general));

        fetch('../../controller/socio-asociado/Reg_CV.php', {
            method: 'POST',
            body: datos
        })
            .then(res => res.json())
            .then(data =>
            {
                if (data == 'Fechas'){
                    alert("Fecha de finalización debe ser posterior a fecha de inicio en la primera experiencia profesional");
                }
                else if (data == 'Fechas2'){
                    alert("Fecha de finalización debe ser posterior a fecha de inicio en la segunda experiencia profesional");
                }
                else{
                alert(data);
                }
                
                /* if (data === 'Correcto') {
                    alert("Registro exitoso");
                    location.href = '../../view/administrativo/Reg_Proyectos.html';
                }
    
                else if (data === 'Fechas') {
                    alert("Fecha de finalización debe ser posterior a fecha de inicio");
                }
                else {
                    alert(data);
                } */
            })

        }        
        }
    }


    //ibtener el datos de la combo box con id = residencia-campo
    /* var combo = document.getElementById("residencia-campo").value;
    console.log(combo); */
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