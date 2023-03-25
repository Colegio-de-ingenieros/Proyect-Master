/* crear validaciones en los campos de validaciones.html */
let bId = false
let bNom = false
let Obj = false
let dur = false
let tem = false
let sub = false
let lista = [];
let su = [];
let contador = 0;
let b = false
let c = false

const expresiones = {
    clave: /^[0-9]{6}$/,
    duracion: /^[0-9]+$/,
    nombre: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    objetivosjhg: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    objetivo: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]+$/,
    tema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    subtema: /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
}


let nombrecurso = document.getElementById("nombre-curso");
nombrecurso.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    nombrecurso.value = valorInput
        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ·´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.nombre.test(valorInput)) {
        nombrecurso.style.border = "3px solid red";
        bNom = false
    } else {
        nombrecurso.removeAttribute("style");
        bNom = true
    }
    validar(bNom);
})

let clavecurso = document.getElementById("clave-curso");
clavecurso.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    clavecurso.value = valorInput
        // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
        // Eliminar el ultimo espaciado
        .replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, '')
        .trim();


    if (!expresiones.clave.test(valorInput)) {
        clavecurso.style.border = "3px solid red";
        bId = false
    } else {
        clavecurso.removeAttribute("style");
        bId = true
    }
    validar(bId);
})

let objetivo = document.getElementById("objetivo");
objetivo.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    objetivo.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        Obj = false
    } else {
        objetivo.removeAttribute("style");
        Obj = true
    }
    validar(Obj);
})

let duracion = document.getElementById("duración");
duracion.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    duracion.value = valorInput
        // Eliminar espacios en blanco
        .replace(/\s/g, '')
        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
        // Eliminar el ultimo espaciado
        .replace(/[a-zA-ZáéíóúÁÉÍÓÚñÑ.,]/g, '')
        .trim();


    if (!expresiones.duracion.test(valorInput)) {
        duracion.style.border = "3px solid red";
        dur = false
    } else {
        duracion.removeAttribute("style");
        dur = true
    }
    validar(dur);
})

let tema = document.getElementById("titulo-curso");
tema.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    tema.value = valorInput
        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')



    if (!expresiones.tema.test(valorInput)) {
        tema.style.border = "3px solid red";
        tem = false
    } else {
        tema.removeAttribute("style");
        tem = true
    }
    validar2(tem);
})

let subtema = document.getElementById("Subtitulo-curso");
subtema.addEventListener('keyup', (e) => {
    let valorInput = e.target.value;

    subtema.value = valorInput

        // Eliminar caracteres especiales
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.subtema.test(valorInput)) {
        subtema.style.border = "3px solid red";
        sub = false
    } else {
        subtema.removeAttribute("style");
        sub = true
    }
    validar3(sub);
})


function validar(bandera) {
    const guarda = document.getElementById('registraform');
    if (bandera == true) {
        guarda.disabled = false;
    }
    else {
        guarda.disabled = true;
    }

}
function validar2(bandera) {
    const guardar = document.getElementById("temas");
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}
function validar3(bandera) {
    const guardar1 = document.getElementById("subtemas");
    if (bandera == true) {
        guardar1.disabled = false;
    }
    else {
        guardar1.disabled = true;
    }

}

function regi()
{
    if (document.getElementById("titulo-curso") != ""){
    if (lista.length != 0 && c==1){
    if (bId == true && bNom == true && Obj == true && dur == true ) {
        /* crear un arreglo de 6 posiciones donde se almacenen los contenidos de las cajas de texto del form "formulario-cursos" */
        var arrayin = new Array(4);
        arrayin[0] = document.getElementById("clave-curso").value;
        arrayin[1] = document.getElementById("nombre-curso").value;
        arrayin[2] = document.getElementById("objetivo").value;
        arrayin[3] = document.getElementById("duración").value;
        console.log(arrayin);

            var formData = new FormData();
            formData.append("arrayin", JSON.stringify(arrayin));
            formData.append("lista", JSON.stringify(lista));
            /* formData.append("su", JSON.stringify(su)); */

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "../../controller/administrativo/Registro_Cursos.php");

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Imprimimos la respuesta del archivo PHP
                    console.log(this.responseText);
                }
            };

            // Enviamos los datos mediante AJAX
            xmlhttp.send(formData);

            lista = [];
            su = [];

            /* resetea los campos de las cajas de texto*/
            document.getElementById("clave-curso").value = "";
            document.getElementById("nombre-curso").value = "";
            document.getElementById("objetivo").value = "";
            document.getElementById("duración").value = "";
            document.getElementById("titulo-curso").value = "";
            document.getElementById("Subtitulo-curso").value = "";

            c = 0;

            alert("Registro del curso completado");

        }
        else {
            alert("Faltan campos por llenar");
        }
    }
    else {
        alert("Ingresar temas y subtemas es necesario");
    }
}
else{
    alert("Ingresar temas y subtemas es necesario");
}
    }
    else{
        alert("Ingresar un tema es necesario");
    }   
}

function te() {
    console.log()
    if(su.length >= 2 && b==true){
    /* lista.push(document.getElementById("titulo-curso").value);  */
    console.log(lista);
    document.getElementById("titulo-curso").value = ""; 
    document.getElementById("titulo-curso").value = ""; 
    lista.push([su]);
    document.getElementById("titulo-curso").disabled = false;
    su = []
    contador = 0;
        document.getElementById("registraform").disabled = false;
    alert("Se ha agregado un tema al registro");
    b=false;
    c=1;
    }
    else {
        alert("Necesita escribir un tema y añadirle un subtema para registrarlo");
    }
}

function subt()
{
if (document.getElementById("Subtitulo-curso").value && document.getElementById("titulo-curso").value){
    if (contador == 0){
        su.push(document.getElementById("titulo-curso").value);
        
        document.getElementById("titulo-curso").disabled = true;
        su.push(document.getElementById("Subtitulo-curso").value);
        document.getElementById("Subtitulo-curso").value = "";
        console.log(("if")); 
        contador++;
        alert("Se ha agregado un subtema al tema");
        b=true;
        document.getElementById("registraform").disabled = true;
    } else{
        
        console.log(("else"));
        su.push(document.getElementById("Subtitulo-curso").value); 
        console.log(su);
        document.getElementById("Subtitulo-curso").value = "";
        alert("Se ha agregado un subtema");
        document.getElementById("registraform").disabled = true;
    }
    else {
        alert("Completa los campos de titulo y subtitulo, campos necesarios para agregar un tema");
    }

    /* if (document.getElementById("titulo-curso").value){
        su.push(document.getElementById("titulo-curso").value);
        
        document.getElementById("titulo-curso").disabled = true;
        su.push(document.getElementById("Subtitulo-curso").value);
        document.getElementById("Subtitulo-curso").value = "";
        console.log(("if"));
    }
    else{
        
        console.log(("else"));
        su.push(document.getElementById("Subtitulo-curso").value); 
        console.log(su);
        document.getElementById("Subtitulo-curso").value = "";
    }
    console.log(su); */
}