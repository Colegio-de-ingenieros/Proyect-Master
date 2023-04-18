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
    /* validar(bNom); */
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
    /* validar(bId); */
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
    /* validar(Obj); */
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
    /* validar(dur); */
})