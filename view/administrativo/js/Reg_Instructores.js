const btn_especialidades = document.getElementById("btn_agregar_espe");
const cnt_especialidades = document.getElementById("contenedor_espe");
const cmp_especialidades = document.getElementById("especialidad");

const btn_certificacion = document.getElementById("btn_agregar_certi");
const cnt_tabla = document.getElementById("contenedor_tabla");
const cuerpo_tabla = document.getElementById("body_tabla");

const nombre_cert = document.getElementById("nombre-cert-externa");
const organizacion_cert = document.getElementById("organizacion-externa");
const fecha_e_cert = document.getElementById("emision-externa");
const fecha_v_cert = document.getElementById("vigencia-externa");

btn_especialidades.addEventListener("click",(e)=>{
    let texto = cmp_especialidades.value;
    agregar_especialidad(texto);
});

btn_certificacion.addEventListener("click",(e)=>{
    let nombre = nombre_cert.value;
    let org = organizacion_cert.value;
    let fechaE = fecha_e_cert.value;
    let fechaV = fecha_v_cert.value;
    agregar_certificacion(nombre,org,fechaE,fechaV);
    
});

function agregar_especialidad(texto) {

    let cnt_input = document.createElement("div");
    let input = document.createElement("input");
    //let btn_modificar = document.createElement("button");
    let btn_eliminar = document.createElement("button");
    //let icono_modificar = document.createElement("i");
    let icono_eliminar = document.createElement("i");

    let id_input = cnt_especialidades.childNodes.length+Math.floor(Math.random() * 100)+Date.now().toString(5);
    let id_cnt = "contenedor"+ id_input;

    cnt_input.setAttribute("id",id_cnt);

    input.setAttribute("id",id_input);
    input.classList.add("input-format-2");
    input.classList.add("espe-input");
    input.setAttribute("maxlength","40");
    input.setAttribute("placeholder","Ingrese la especialidad");
    input.setAttribute("tittle","La especialidad solo puede contener letras mayúsculas y minúsculas.");
    input.setAttribute("onblur","bloquear_input('"+id_input+"')");

    input.value = texto;
    input.disabled = true;

    //icono_modificar.className = "fa-solid fa-pen-to-square";
    icono_eliminar.className = "fa-solid fa-delete-left" ;

    //icono_modificar.style.cssText ="color: #273544";
    icono_eliminar.style.cssText ="color: #273544";

    cnt_input.classList.add("especialidades");

    //btn_modificar.appendChild(icono_modificar);
    btn_eliminar.appendChild(icono_eliminar);

    //btn_modificar.setAttribute("type","button");
    btn_eliminar.setAttribute("type","button");

    //btn_modificar.setAttribute('onclick',"modificar('"+ id_input  +"')");
    btn_eliminar.setAttribute('onclick',"eliminar_elemento('"+id_cnt+"')");

    cnt_input.appendChild(input);
    //cnt_input.appendChild(btn_modificar);
    cnt_input.appendChild(btn_eliminar);

    cnt_especialidades.appendChild(cnt_input);
    
}

function agregar_certificacion(nombre,organizacion,fechaE, fechaV) {
    cnt_tabla.style.display = 'block';

    var row = document.createElement('tr');
    var nombre_c = document.createElement('td');
    var org_c = document.createElement('td');
    var fecha_e_c = document.createElement('td');
    var fecha_v_c = document.createElement('td');
    var acciones_c = document.createElement('td');
    let btn_eliminar = document.createElement("button");
    let icono_eliminar = document.createElement("i");

    nombre_c.innerText = nombre;
    org_c.innerText = organizacion;
    fecha_e_c.innerText = fechaE;
    fecha_v_c.innerText = fechaV;

    let id_fila = "fila" + cuerpo_tabla.childNodes.length*Math.floor(Math.random() * 100)+Date.now().toString(23);
    row.setAttribute("id",id_fila);

    icono_eliminar.className = "fa-solid fa-delete-left" ;
    icono_eliminar.style.cssText ="color: #273544";

    btn_eliminar.setAttribute("type","button");
    btn_eliminar.setAttribute('onclick',"elimina_elementos_tabla('"+id_fila+"')");
    btn_eliminar.appendChild(icono_eliminar);

    acciones_c.appendChild(btn_eliminar);

    row.appendChild(nombre_c);
    row.appendChild(org_c);
    row.appendChild(fecha_e_c);
    row.appendChild(fecha_v_c);
    row.appendChild(acciones_c);

    cuerpo_tabla.appendChild(row);
    
}

function modificar(id) {
    let cmp = document.getElementById(id);
    cmp.disabled = false;
}
function bloquear_input(id_input) {
    let cmp = document.getElementById(id_input);
    cmp.disabled = true;
}
function eliminar_elemento(id_cnt) {
    //elimina los elementos de especializacion
    let contenedor = document.getElementById(id_cnt);
    //elimina a todos sus hijos primero
    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
    //luego se remueve a si mismo
    contenedor.remove(); 
}
function elimina_elementos_tabla(id_fila) {
    let contenedor = document.getElementById(id_fila);
    //elimina a todos sus hijos primero
    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
    //luego se remueve a si mismo
    if(cuerpo_tabla.childNodes.length == 1){
        cnt_tabla.style.display = 'none';
       
    }
    contenedor.remove(); 
    
}



