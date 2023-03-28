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
let c = 0

let conta = -1;



document.getElementById("registraform").disabled = false;

const expresiones = {
    clave: /^[0-9]{6}$/,
    duracion: /^[0-9]{0,3}$/,
    nombres: /^[a-zA-ZÁ-ý0-9\s .,]{1,40}$/,
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
        //.replace(/[üâäàåçê♪ëèïîìÄÅæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-°¨]/g, '')
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


    if (!expresiones.nombres.test(valorInput)) {
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
        .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
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
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


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
        .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·°¨´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
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
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')



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
        .replace(/[üâäàåçê♪ëèïîìÄÅæ´°¨·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|<>\/?-]/g, '')


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

function regi() {
    if (bNom == false) {
        nombrecurso.style.border = "3px solid red";
    }
    else if (bId == false) {
        clavecurso.style.border = "3px solid red";
    }
    else if (dur == false) {
        duracion.style.border = "3px solid red";
    }
    else if (Obj == false) {
        objetivo.style.border = "3px solid red";
    }

    if (document.getElementById("titulo-curso") != "" && c == 1) {

        if (lista.length != 0 && c == 1) {
            if (bId == true && bNom == true && Obj == true && dur == true) {
                var arrayin = new Array(4);
                arrayin[0] = document.getElementById("clave-curso").value;
                arrayin[1] = document.getElementById("nombre-curso").value;
                arrayin[2] = document.getElementById("objetivo").value;
                arrayin[3] = document.getElementById("duración").value;
                console.log(arrayin);

                /* Sending the data to the server. */
                var formData = new FormData();
                formData.append("arrayin", JSON.stringify(arrayin));
                formData.append("lista", JSON.stringify(lista));


                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../../controller/administrativo/Registro_Cursos.php");

                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        alert(this.responseText);
                    }
                };


                xmlhttp.send(formData);

                lista = [];
                su = [];


                document.getElementById("clave-curso").value = "";
                document.getElementById("nombre-curso").value = "";
                document.getElementById("objetivo").value = "";
                document.getElementById("duración").value = "";
                document.getElementById("titulo-curso").value = "";
                document.getElementById("Subtitulo-curso").value = "";

                c = 0;

                /* alert("Registro del curso completado"); */

            }
            else {
                alert("Faltan campos por llenar");
            }
        }
        else {
            alert("Ingresar temas y subtemas es necesario");
        }
    }
    else {
        if (bId == true && bNom == true && Obj == true && dur == true)
            alert("Ingresar temas y subtemas es necesario");
    }
}




function te() {
    if (document.getElementById("titulo-curso").value && lista.length > 0) {
        document.getElementById("titulo-curso").disabled = false;
        document.getElementById("titulo-curso").value = "";
        document.getElementById("Subtitulo-curso").value = "";
        contador = 0;
        console.log(lista);
        document.getElementById("titulo-curso").disabled = false;
    }
    else if (document.getElementById("titulo-curso").value && document.getElementById("Subtitulo-curso").value) {
        alert("Presione el boton de Añadir")
    }
    else if (document.getElementById("Subtitulo-curso").value == "" && document.getElementById("titulo-curso").value == "") {
        alert("Agregue tema y subtema")
    }
    else if (document.getElementById("Subtitulo-curso").value == "") {
        alert("Agregue tema")
    }
    else if (document.getElementById("titulo-curso").value == "") {
        alert("Agregue subtema");

    }
}
function subt() {

    if (contador == 0 && document.getElementById("Subtitulo-curso").value && document.getElementById("titulo-curso").value) {
        su = [];
        su.push(document.getElementById("titulo-curso").value);

        su.push(document.getElementById("Subtitulo-curso").value);
        document.getElementById("Subtitulo-curso").value = "";
        console.log(("if"));
        contador++;
        lista.push(su);
        console.log(lista);
        alert("Se ha añadido el tema con su subtema");
        conta++;
        b = true;
        c = 1;
        /* bloque el campo tema */
        document.getElementById("titulo-curso").disabled = true;
        document.getElementById("registraform").disabled = false;
    }
    else if (contador != 0 && document.getElementById("Subtitulo-curso").value) {

        console.log(("else"));
        lista[conta].push(document.getElementById("Subtitulo-curso").value);
        console.log(lista);
        console.log(su);
        document.getElementById("Subtitulo-curso").value = "";
        alert("Se ha añadido un subtema");


    }

    else {
        alert("Completa los campos de titulo y subtitulo, campos necesarios para agregar un tema");
    }
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
