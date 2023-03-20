/* crear validaciones en los campos de validaciones.html */
let bId = false
let bNom = false
let Obj = false    
let dur = false
let tem= false    
let sub = false
const lista = [];

const expresiones = {
    clave:/^[0-9]{6}$/,
    duracion:/^[0-9]{3}$/,
    nombre:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    objetivo:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    tema:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
    subtema:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ .,]{1,40}$/,
}
let nombrecurso = document.getElementById("nombre-curso");
nombrecurso.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	nombrecurso.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ·´ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
     // Eliminar el ultimo espaciado
	.trim();

    if (!expresiones.nombre.test(valorInput)) {
        nombrecurso.style.border = "3px solid red";
        bNom = false
	}else{
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
	}else{
        clavecurso.removeAttribute("style");
        bId = true
    }
    validar(bId);
})

let objetivo = document.getElementById("objetivo");
objetivo.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	objetivo.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    

    if (!expresiones.objetivo.test(valorInput)) {
        objetivo.style.border = "3px solid red";
        Obj = false
	}else{
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
	}else{
        duracion.removeAttribute("style");
        dur = true
    }
    validar(dur);
})

let tema = document.getElementById("titulo-curso");
tema.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	tema.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    

    if (!expresiones.tema.test(valorInput)) {
        tema.style.border = "3px solid red";
        tem = false
	}else{
       tema.removeAttribute("style");
       tem = true
    }
    /* validar(tem); */
})

let subtema = document.getElementById("Subtitulo-curso");
subtema.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	subtema.value = valorInput
    // Eliminar espacios en blanco
	.replace(/\s/g, '')
     // Eliminar caracteres especiales
    .replace(/[üâäàåçê♪ëèïîìÄÅÉæ´·ÆôöòûùÿÖÜ¢£¥₧ƒªº¿⌐¬½¼«»÷±~!¡@#$%^&^*()_+=\[\]{};':"\\|,.<>\/?-]/g, '')
     // Eliminar el ultimo espaciado
	.trim();
    

    if (!expresiones.subtema.test(valorInput)) {
        subtema.style.border = "3px solid red";
        sub = false
	}else{
       subtema.removeAttribute("style");
       sub = true
    }
    validar(sub);
})


function validar(bandera)
{
    const guardar = document.getElementById('botonRegistrar');
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}
function validar2(bandera)
{
    const guardar = document.getElementById('botonRegistrar');
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}
function validar3(bandera)
{
    const guardar = document.getElementById('botonRegistrar');
    if (bandera == true) {
        guardar.disabled = false;
    }
    else {
        guardar.disabled = true;
    }

}

function regi()
{
    const bre = document.getElementById('btem');
    if (bId == true && bNom == true && Obj == true && dur == true) {
        bre.disabled = false;
    }
    else {
        bre.disabled = true;
    }
}

function te()
{
   lista.push(document.getElementById("titulo-curso").value); 
    console.log(lista);
}