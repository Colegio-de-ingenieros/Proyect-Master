const leyenda = document.getElementById("leyenda");

const caja_titulo = document.getElementById("titulo-curso");
const caja_subtitulo = document.getElementById("subtitulo-curso");

const btn_add_tema = document.getElementById("btn_tema-add");
const btn_add_new_tema = document.getElementById("btn_tema-new-add");

const btn_add_subtema = document.getElementById("btn-subtema-add");
const btn_end_proceso = document.getElementById("btn-end-proceso");

const visualizar_listas = document.getElementById("visualizar_modificar");
const listado = document.getElementById("lista");
/* const elemento_inicial = document.getElementById("inicial"); */

let flag_almacenar = false;
let existencia_inicial = false;

let lista_temario_completo = [];
let lista_temario_parcial = [];

let contador_temas = 1;
let contador_subtemas = 1;

caja_subtitulo.style.display = "none";
btn_add_new_tema.style.display = "none";

btn_add_subtema.style.display = "none";
btn_end_proceso.style.display = "none";

function agregar_tema() {
    contenido = caja_titulo.value;
    flag_almacenar = false;
    console.log("El contenido de la bandera en agregar tema es: " + flag_almacenar + "");

    if (contenido == "") {
        caja_titulo.style.border = "3px solid red";
        alert("Ingrese un tema");
        return;
    }
    else {
        const nuevo_elemento = document.createElement("li");
        lista_temario_parcial.push(contenido);

        /* elemento_inicial.style.display = "none"; */

        /* elemento_inicial.display = "none"; */
        console.log("Se ha presionado el boton del tema");
        leyenda.innerHTML = "Añadir subtema";

        caja_titulo.style.display = "none";
        caja_subtitulo.style.display = "flex";

        btn_add_tema.style.display = "none";
        btn_end_proceso.style.display = "flex";
        btn_add_subtema.style.display = "flex";
        btn_add_new_tema.style.display = "flex";
        btn_end_proceso.style.display = "flex";

        size = lista_temario_parcial.length;

        contenido = "Tema " + contador_temas + ": " + contenido;

        /* Creacion del elemento en la lista */
        nuevo_elemento.innerHTML = contenido;
        nuevo_elemento.setAttribute("id", "t" + size);
        nuevo_elemento.classList.add("label-3", "elemento-tema");
        nuevo_elemento.setAttribute("onclick", "retornar_tema('t" + size + "')");
        listado.appendChild(nuevo_elemento);

        caja_titulo.value = "";
        contador_temas++;
    }
}

function agregar_subtema() {
    contenido = caja_subtitulo.value;
    flag_almacenar = false;
    console.log("El contenido de la bandera en agregar subtema es: " + flag_almacenar + "");

    if (contenido == "") {
        caja_subtitulo.style.border = "3px solid red";
        alert("Ingrese un subtema");
        return;
    }
    else {
        const nuevo_elemento = document.createElement("li");
        lista_temario_parcial.push(contenido);
        console.log("Se ha presionado el boton del subtema");

        btn_add_subtema.style.display = "flex";
        btn_add_new_tema.style.display = "flex";

        size = lista_temario_parcial.length;

        contenido = "Subtema " + contador_subtemas + ": " + contenido;

        /* Creacion del elemento en la lista */
        nuevo_elemento.innerHTML = contenido;
        nuevo_elemento.setAttribute("id", "s" + size);
        nuevo_elemento.classList.add("label-3", "elemento-subtema");
        nuevo_elemento.setAttribute("onclick", "retornar_subtema('t" + (contador_temas - 1) + "s" + size + "')");
        listado.appendChild(nuevo_elemento);

        caja_subtitulo.value = "";
        contador_subtemas++;
    }
}

function agregar_nuevo_tema() {
    console.log("Se ha presionado el boton de añadir nuevo tema");
    caja_titulo.style.display = "flex";
    caja_subtitulo.style.display = "none";

    btn_add_tema.style.display = "flex";
    btn_add_subtema.style.display = "none";
    btn_add_new_tema.style.display = "none";

    leyenda.innerHTML = "Añadir Tema*";

    console.log("Lista parcial");

    for (let i = 0; i < lista_temario_parcial.length; i++) {
        console.log(lista_temario_parcial[i]);
    }

    lista_temario_completo.push(lista_temario_parcial);
    contador_subtemas = 1;

    console.log("Lista completa");

    /* for(let i = 0; i < lista_temario_completo.length; i++){
        console.log(lista_temario_completo[i]);
    } */

    lista_temario_parcial = [];
    flag_almacenar = false;

    console.log("El contenido de la bandera en agregar tema es: " + flag_almacenar + "");

    for (let i = 0; i < lista_temario_completo.length; i++) {
        console.log(lista_temario_completo[i]);
    }
}

function finalizar_registro_temario() {
    console.log("Se ha presionado el boton de finalizar registro");
    lista_temario_completo.push(lista_temario_parcial);
    console.log("Lista completa");
    leyenda.innerHTML = "Añadir tema*";

    caja_titulo.style.display = "flex";
    caja_subtitulo.style.display = "none";

    btn_add_tema.style.display = "flex";
    btn_add_subtema.style.display = "none";
    btn_add_new_tema.style.display = "none";
    btn_end_proceso.style.display = "none";

    for (let i = 0; i < lista_temario_completo.length; i++) {
        console.log(lista_temario_completo[i]);
    }
    flag_almacenar = true;
}


function enviar() {
    let nombre_curso = document.getElementById("nombre-curso");
    let clave_curso = document.getElementById("clave-curso");
    let duracion_curso = document.getElementById("duración");
    let objetivo = document.getElementById("objetivo");
    console.log("El contenido de nombre_curso es: " + nombre_curso.value + "");
    console.log("El contenido de clave_curso es: " + clave_curso.value + "");
    console.log("El contenido de duracion_curso es: " + duracion_curso.value + "");
    console.log("El contenido de objetivo es: " + objetivo.value + "");
    console.log("El contenido de la bandera en enviar es: " + flag_almacenar + "");

    if (nombre_curso.value == "") {
        nombre_curso.style.border = "3px solid red";
    }
    else if (clave_curso.value == "") {
        clave_curso.style.border = "3px solid red";
    }
    else if (duracion_curso.value == "") {
        duracion_curso.style.border = "3px solid red";
    }
    else if (objetivo.value == "") {
        objetivo.style.border = "3px solid red";
    }
    else {
        console.log("Entramos a enviar los datos")
        if (flag_almacenar == false) {
            let resultado = confirm("¿Desea continuar con el registro? Si es así, el temario se perderá");
            console.log("El contenido de la bandera en enviar es: " + flag_almacenar + "");
            console.log("El contenido de resultado es: " + resultado + "");

            if (resultado == true) {
                console.log("El contenido de la bandera en enviar es: " + flag_almacenar + "");
                var arrayin = [nombre_curso.value, clave_curso.value, duracion_curso.value, objetivo.value];
                var lista = [[]];

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

                const nuevo_elemento = document.createElement("li");

                document.getElementById("nombre-curso").value = "";
                document.getElementById("clave-curso").value = "";
                document.getElementById("duración").value = "";
                document.getElementById("objetivo").value = "";
                document.getElementById("titulo-curso").value = "";
                document.getElementById("subtitulo-curso").value = "";
                document.getElementById("lista").innerHTML = "";

                leyenda.innerHTML = "Añadir tema*";
                caja_titulo.style.display = "flex";
                caja_subtitulo.style.display = "none";

                btn_add_tema.style.display = "flex";
                btn_add_subtema.style.display = "none";
                btn_add_new_tema.style.display = "none";
                btn_end_proceso.style.display = "none";

                lista_temario_completo = [];
                lista_temario_parcial = [];
                contador_temas = 1;
                contador_subtemas = 1;
            }
            else if(resultado == false){
                console.log("El contenido de la bandera en enviar es: " + flag_almacenar + "");
                finalizar_registro_temario()
                var arrayin = [nombre_curso.value, clave_curso.value, duracion_curso.value, objetivo.value];
                var lista = lista_temario_completo;

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

                const nuevo_elemento = document.createElement("li");

                document.getElementById("nombre-curso").value = "";
                document.getElementById("clave-curso").value = "";
                document.getElementById("duración").value = "";
                document.getElementById("objetivo").value = "";
                document.getElementById("titulo-curso").value = "";
                document.getElementById("subtitulo-curso").value = "";
                document.getElementById("lista").innerHTML = "";


                leyenda.innerHTML = "Añadir tema*";
                caja_titulo.style.display = "flex";
                caja_subtitulo.style.display = "none";

                btn_add_tema.style.display = "flex";
                btn_add_subtema.style.display = "none";
                btn_add_new_tema.style.display = "none";
                btn_end_proceso.style.display = "none";
                
                lista_temario_completo = [];
                lista_temario_parcial = [];
                contador_temas = 1;
                contador_subtemas = 1;
            }
        }
        else if (flag_almacenar == true){
            console.log("El contenido de la bandera en enviar es: " + flag_almacenar + "");
            var arrayin = [nombre_curso.value, clave_curso.value, duracion_curso.value, objetivo.value];
            var lista = lista_temario_completo;

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

            const nuevo_elemento = document.createElement("li");

            document.getElementById("nombre-curso").value = "";
            document.getElementById("clave-curso").value = "";
            document.getElementById("duración").value = "";
            document.getElementById("objetivo").value = "";
            document.getElementById("titulo-curso").value = "";
            document.getElementById("subtitulo-curso").value = "";
            document.getElementById("lista").innerHTML = "";

            nuevo_elemento.innerHTML = "Sin temario añadido";
            nuevo_elemento.setAttribute("id", "inicial");
            nuevo_elemento.classList.add("label-3");
            listado.appendChild(nuevo_elemento);

            leyenda.innerHTML = "Añadir tema*";
            caja_titulo.style.display = "flex";
            caja_subtitulo.style.display = "none";

            btn_add_tema.style.display = "flex";
            btn_add_subtema.style.display = "none";
            btn_add_new_tema.style.display = "none";
            btn_end_proceso.style.display = "none";
            
            lista_temario_completo = [];
            lista_temario_parcial = [];
            contador_temas = 1;
            contador_subtemas = 1;
        }
    }
}