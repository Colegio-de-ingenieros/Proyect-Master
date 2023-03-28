const leyenda = document.getElementById("leyenda");

const caja_titulo = document.getElementById("titulo-curso");
const caja_subtitulo = document.getElementById("subtitulo-curso");

const btn_add_tema = document.getElementById("btn_tema-add");
const btn_add_new_tema = document.getElementById("btn_tema-new-add");
const btn_mod_tema = document.getElementById("btn-tema-modificar");
const btn_del_tema = document.getElementById("btn-tema-eliminar");

const btn_add_subtema = document.getElementById("btn-subtema-add");
const btn_mod_subtema = document.getElementById("btn-subtema-modificar");
const btn_del_subtema = document.getElementById("btn-subtema-eliminar");

const visualizar_listas = document.getElementById("visualizar_modificar");
const listado = document.getElementById("lista");
const elemento_inicial = document.getElementById("inicial");


let lista_temario_completo = [];
let lista_temario_parcial = [];

let contador_temas = 1;
let contador_subtemas = 1;

caja_subtitulo.style.display = "none";
btn_add_new_tema.style.display = "none";

btn_add_subtema.style.display = "none";


function agregar_tema(){
    contenido = caja_titulo.value;

    if(contenido == ""){
        alert("El campo del tema no se puede encontrar vacio");
        return;
    }
    else{
        const nuevo_elemento = document.createElement("li");
        lista_temario_parcial.push(contenido);
        elemento_inicial.remove();

        elemento_inicial.display = "none";
        console.log("Se ha presionado el boton del tema");
        leyenda.innerHTML = "Añadir subtema*";

        caja_titulo.style.display = "none";
        caja_subtitulo.style.display = "flex";

        btn_add_tema.style.display = "none";
        btn_add_subtema.style.display = "flex";
        btn_add_new_tema.style.display = "flex";

        size = lista_temario_parcial.length;

        contenido = "Tema "+contador_temas+": "+contenido;

        /* Creacion del elemento en la lista */
        nuevo_elemento.innerHTML = contenido;
        nuevo_elemento.setAttribute("id","t"+size);
        nuevo_elemento.classList.add("label-3", "elemento-tema");
        nuevo_elemento.setAttribute("onclick","retornar_tema('t"+size+"')");
        listado.appendChild(nuevo_elemento);

        caja_titulo.value = "";
        contador_temas++;
    }
}

function agregar_subtema(){
    contenido = caja_subtitulo.value;

    if(contenido == ""){
        alert("El campo no puede estar vacio");
        return;
    }
    else{
        const nuevo_elemento = document.createElement("li");
        lista_temario_parcial.push(contenido);
        console.log("Se ha presionado el boton del subtema");

        btn_add_subtema.style.display = "flex";
        btn_add_new_tema.style.display = "flex";

        size = lista_temario_parcial.length;

        contenido = "Subtema "+contador_subtemas+": "+contenido;

        /* Creacion del elemento en la lista */
        nuevo_elemento.innerHTML = contenido;
        nuevo_elemento.setAttribute("id","s"+size);
        nuevo_elemento.classList.add("label-3", "elemento-subtema");
        nuevo_elemento.setAttribute("onclick","retornar_subtema('t"+(contador_temas - 1)+"s"+size+"')");
        listado.appendChild(nuevo_elemento);

        caja_subtitulo.value = "";
        contador_subtemas++;
    }
}

function agregar_nuevo_tema(){
    console.log("Se ha presionado el boton de añadir nuevo tema");
    caja_titulo.style.display = "flex";
    caja_subtitulo.style.display = "none";

    btn_add_tema.style.display = "flex";
    btn_add_subtema.style.display = "none";
    btn_add_new_tema.style.display = "none";

    leyenda.innerHTML = "Añadir Tema*";

    lista_temario_completo.push(lista_temario_parcial);
    contador_subtemas = 1;

    lista_temario_parcial = [];

    for(let i = 0; i < lista_temario_completo.length; i++){
        console.log(lista_temario_completo[i]);
    }
}