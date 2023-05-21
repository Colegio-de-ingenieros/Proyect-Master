const btn_especialidades = document.getElementById("btn_agregar_espe");
const cnt_especialidades = document.getElementById("contenedor_espe");
const cmp_especialidades = document.getElementById("especialidad");

const btn_certificacion = document.getElementById("btn_agregar_certi");
const cnt_tabla = document.getElementById("contenedor_tabla");
const tabla = document.getElementById("tabla");
const cuerpo_tabla = document.getElementById("body_tabla");

const nombre_cert = document.getElementById("nombre-cert-externa");
const organizacion_cert = document.getElementById("organizacion-externa");
const fecha_e_cert = document.getElementById("emision-externa");
const fecha_v_cert = document.getElementById("vigencia-externa");

const btn_formulario_actualizar = document.getElementById("boton_actualizar");
const formulario = document.getElementById("formulario");
const cnt_certifiacionesInt = document.getElementById("cert_int");
const id_instructor = (new URLSearchParams(location.search)).get('id');

const nombre = document.getElementById("nombre");
const apellido_p = document.getElementById("paterno");
const apellido_m = document.getElementById("materno");

const abrir_modal = document.getElementById("open");
const cerrar_modal = document.getElementById("close");
const guardar_modal = document.getElementById("guardar_modal");
const modal = document.getElementById("modal-container");
const modalContainer = document.getElementById("modal");

const nombre_cert_modi = document.getElementById("nombre-cert-externa-modi");
const organizacion_cert_modi = document.getElementById("organizacion-externa-modi");
const fecha_e_cert_modi = document.getElementById("emision-externa-modi");
const fecha_v_cert_modi = document.getElementById("vigencia-externa-modi");

const formulario_cert = document.getElementById("formulario_cert");
const formulario_cert_modal = document.getElementById("formulario_cert_modal");
const btn_cancelar_registro_principal = document.getElementById("boton_cancelar");

/* guardaran las certificaciones y especialidades eliminadas y nuevas, para insertar y eliminar respectivamente */
window.certificaciones = [];
window.especialidades = [];

const expre = {
    especialidades: /^[a-zA-ZÁ-Ýá-ý\s]{1,60}$/
}

window.addEventListener("load",async (e)=>{
    let form_data = new FormData();
    form_data.append("id",id_instructor);

    let respuesta_certrificacionesIn = await fetch("../../controller/administrativo/Registro_Instructores.php");
    let datos = await respuesta_certrificacionesIn.json();
    llenarCertificacionesInternas(datos);
    
    let respuesta_instructores = await fetch("../../controller/administrativo/Modificar_Instructores.php",{
        method: 'POST',
        body: form_data
    });
    let datos_instructores = await respuesta_instructores.json();
 
    mostrarDatosBasicos(datos_instructores[0]);
    mostrarEspecialidades(datos_instructores[1]);
    mostrarCertificacionesInternas(datos_instructores[2]);
    mostrarCertificaciones(datos_instructores[3]);

    banderas.nombre = true;
    banderas.paterno = true;



});
btn_cancelar_registro_principal.addEventListener("click",(e)=>{
    let respuesta = confirm("Los cambios realizados no se guardarán, ¿Desea continuar?");
    if(respuesta){
        window.location.href = '../administrativo/Vista_Instructor.html' 
    }
});
btn_formulario_actualizar.addEventListener("click",(e)=>{

    if(!banderas.nombre){
        nombre_campo.style.border = "3px solid red";
    }else if(!banderas.paterno){
        paterno_campo.style.border = "3px solid red";
    }else{
        
        let respuesta =  SeleccionoUnaCertificacionInterna();
        
        extraer_datos_tabla();
        extraer_datos_input();
       
        
        
        let form_data = new FormData(formulario);
        form_data.append("id",id_instructor);
        form_data.append("certificaciones",JSON.stringify(ordenarLista(window.certificaciones)));
        form_data.append("especialidades",JSON.stringify(ordenarLista(window.especialidades)));
        if(respuesta == false){
            form_data.append("cert_int","");
        }  
        
        fetch("../../controller/administrativo/Modificar_Instructores.php",{
            method:"POST",
            body: form_data
        }).then(respuesta => respuesta.json())
        .then(datos =>{
            if(datos == true){
                alert("Actualización exitosa");
                window.especialidades = [];
                window.certificaciones = [];

                window.location.href = '../administrativo/Vista_Instructor.html' ;
            }
                
        });
      
        
    }    

    
});

btn_especialidades.addEventListener("click",(e)=>{

    let texto = cmp_especialidades.value;

    if(banderas.especialidad){

        banderas.especialidad = false;
        cmp_especialidades.value = "";
        agregar_especialidad(texto,false,"");

    }else{
        especialidad_campo.style.border = "3px solid red";
        banderas.especialidad = false;
    }
    
});

formulario_cert.addEventListener("submit",(e)=>{
    e.preventDefault();

    let nombre = nombre_cert.value;
    let org = organizacion_cert.value;
    let fechaE = fecha_e_cert.value;
    let fechaV = fecha_v_cert.value;
    let fecha_inicio = new Date(fechaE);
    let fecha_fin = new Date(fechaV)

    if(nombre == ""){
        alert("Debe colocar el nombre de la certificación");
        nombre_certificacion_campo.style.border = "3px solid red";
        banderas_externas.nombre = false;
    }else if(org == ""){
        alert("Debe colocar el nombre de la organización");
        organizacion_campo.style.border = "3px solid red";
        banderas_externas.organizacion = false;
    }else if(fechaE == ""){
        alert("Debe seleccionar una fecha de emisión");
    }else if(fechaV == ""){
        alert("Debe seleccionar una fecha de vigencia");
    }else if(fecha_inicio > fecha_fin){
        alert("La fecha de emisión no puede ser mayor a la fecha de vigencia");
    }else if(banderas_externas.nombre && banderas_externas.organizacion){

        banderas_externas.nombre = false;
        banderas_externas.organizacion = false;
    
    
        nombre_cert.value = "";
        organizacion_cert.value = "";
        fecha_e_cert.value = "";
        fecha_v_cert.value = "";
        agregar_certificacion(nombre,org,fechaE,fechaV,false,"");
      
        
    } 
    
});

function agregar_especialidad(texto,clase,id) {

    let cnt_input = document.createElement("div");
    let input = document.createElement("input");
    let btn_modificar = document.createElement("button");
    let btn_eliminar = document.createElement("button");
    let icono_modificar = document.createElement("i");
    let icono_eliminar = document.createElement("i");

    let id_input = cnt_especialidades.childNodes.length+Math.floor(Math.random() * 100)+Date.now().toString(5);
    let id_cnt = "contenedor"+ id_input;

    cnt_input.setAttribute("id",id_cnt); 
    cnt_input.classList.add("conte");

    input.setAttribute("id",id_input);
    if(clase){
        input.classList.add("old-"+id);
    }
    input.classList.add("input-format-22");
    input.classList.add("espe-input");
    input.setAttribute("maxlength","60");
    input.setAttribute("placeholder","Ingrese la especialidad");
    input.setAttribute("tittle","La especialidad solo puede contener letras mayúsculas y minúsculas.");
    input.setAttribute("onblur","bloquear_input('"+id_input+"')");
    input.addEventListener("keyup",(e)=>{

        let valorInput = e.target.value;
        e.target.value = valorInput.replace(/[^a-zA-ZÁ-Ýá-ý\s]/g, '');
        let valorInput2 = e.target.value;
        if (!expre.especialidades.test(valorInput2)) {
            input.style.border = "3px solid red";
        }   
        else {
            input.removeAttribute("style");
           
        }
    });
    
    input.value = texto;
    input.disabled = true;

    btn_eliminar.classList.add("btn", "btn-small0", "btn-danger");

    icono_modificar.className = "fa-solid fa-pen-to-square";
    btn_modificar.classList.add("btn", "btn-small1", "btn-danger1")
    
    icono_eliminar.className = "ti ti-backspace-filled" ;

    btn_modificar.appendChild(icono_modificar);
    btn_eliminar.appendChild(icono_eliminar);

    btn_modificar.setAttribute("type","button");
    btn_eliminar.setAttribute("type","button");

    btn_modificar.setAttribute('onclick',"modificar('"+ id_input  +"')");
    btn_eliminar.setAttribute('onclick',"eliminar_elemento('"+id_cnt+"')");

    cnt_input.appendChild(input);
    cnt_input.appendChild(btn_modificar);
    cnt_input.appendChild(btn_eliminar);

    cnt_especialidades.appendChild(cnt_input);
    
}

function agregar_certificacion(nombre,organizacion,fechaE, fechaV, clase,id) {
    cnt_tabla.style.display = 'block';

    var row = document.createElement('tr');
    var nombre_c = document.createElement('td');
    var org_c = document.createElement('td');
    var fecha_e_c = document.createElement('td');
    var fecha_v_c = document.createElement('td');
    var acciones_c = document.createElement('td');

    let btn_eliminar = document.createElement("button");
    let icono_eliminar = document.createElement("i");

    let btn_modificar = document.createElement("button");
    let icono_modificar = document.createElement("i");

    nombre_c.innerText = nombre;
    org_c.innerText = organizacion;
    fecha_e_c.innerText = fechaE;
    fecha_v_c.innerText = fechaV;

    let id_fila = "fila" + cuerpo_tabla.childNodes.length*Math.floor(Math.random() * 100)+Date.now().toString(23);
    row.setAttribute("id",id_fila);

    icono_modificar.className = "fa-solid fa-pen-to-square";
    btn_modificar.classList.add("btn", "btn-small0", "btn-danger1")

    btn_modificar.setAttribute("onclick","mostrar_modal('"+id_fila+"')");
    btn_modificar.appendChild(icono_modificar);
    btn_modificar.setAttribute("type","button");

    icono_eliminar.className = "ti ti-backspace-filled" ;
    btn_eliminar.classList.add("btn", "btn-small", "btn-danger");

    btn_eliminar.setAttribute("type","button");
    btn_eliminar.setAttribute('onclick',"elimina_elementos_tabla('"+id_fila+"')");
    btn_eliminar.appendChild(icono_eliminar);

    acciones_c.appendChild(btn_modificar);
    acciones_c.appendChild(btn_eliminar);

    row.appendChild(nombre_c);
    row.appendChild(org_c);
    row.appendChild(fecha_e_c);
    row.appendChild(fecha_v_c);
    row.appendChild(acciones_c);
    if(clase){
        row.classList.add("old-"+id);
    }

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
    // guarda el id del elemento antiguo eliminado
    let especialidad = document.querySelector("#"+ id_cnt +" input")
    let clasesLista = especialidad.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("old"));


    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        window.especialidades.push(["delete",id]);
    }

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
    let clasesLista = contenedor.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("old"));


    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        window.certificaciones.push(["delete",id]);
    }

    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
    //luego se remueve a si mismo
    if(cuerpo_tabla.childNodes.length == 1){
        cnt_tabla.style.display = 'none';
       
    }
    contenedor.remove(); 
    
}

/* estos metodos extraen datos de la tabla 
    en este caso para no desperdiciar tantos ids en la base de datos,
    cada que se agrega o modifica una cosa, cuando enviamos los datos
    colocamos una etiqueta, que indica si es un nuevo registro para insercion,
    o si ya existe, si si existe, no se hace nada
*/

function extraer_datos_tabla() {
    
    

    for (var i = 1, row; row = tabla.rows[i]; i++) {
        
        let fila = [];

        let clasesLista = row.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("old"));

        if(clase_con_id == undefined){
            fila.push("new"); 
        } else{
            let id = clase_con_id.split("-")[1];
            fila.push("update");
            fila.push(id);
           
        }

        for (var j = 0; j< 4 ; j++) {
            col = row.cells[j];
            fila.push(col.textContent);
        }  
        window.certificaciones.push(fila);
        
     }
    

}

/* Estrae los datos de los input especialidades */

function extraer_datos_input() {

    let especialidades = document.querySelectorAll(".espe-input");
    
    for (let i = 0; i < especialidades.length; i++) {

        let especialidad = especialidades[i];
        let clasesLista = especialidades[i].className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("old"));

        if(clase_con_id == undefined){
            window.especialidades.push(["new",especialidad.value]);
        }else{
            let id = clase_con_id.split("-")[1];
            window.especialidades.push(["update",id,especialidad.value]);
        }
       
    }

    
}

function llenarCertificacionesInternas(datos) {

    if(datos.length == 0){

        let option = document.createElement("option");
        option.value = "";
        option.text = "No hay certificaciones internas disponibles;";
        cnt_certifiacionesInt.appendChild(option);
        cnt_certifiacionesInt.disabled = true;

    }else{
        for (let i = 0; i < datos.length; i++) {
        
            let option = document.createElement("option");
            option.value = datos[i][0];
            option.text = datos[i][1];
    
            cnt_certifiacionesInt.appendChild(option);
    
            
        }
    }
    
    
    
}
function SeleccionoUnaCertificacionInterna() {

    isselected = false;
    
    for (var i=0; i<cnt_certifiacionesInt.options.length; i++) {
        if (cnt_certifiacionesInt.options[i].selected) {
            isselected = true;
        } 
    } 

    return isselected;
    
}


function mostrarEspecialidades(especilidades) {
    
    if(especilidades.length > 0){
        for (let i = 0; i < especilidades.length; i++) {
            
            agregar_especialidad(especilidades[i][1],true,especilidades[i][0]);
        }
        
    }

   
}
function mostrarCertificaciones(Certificaciones) {
    
    if(Certificaciones.length > 0){
        for (let i = 0; i < Certificaciones.length; i++) {
            
            agregar_certificacion(Certificaciones[i][1],Certificaciones[i][2],Certificaciones[i][3],Certificaciones[i][4],true,Certificaciones[i][0]);
        }
        
    }

   
}
function mostrarDatosBasicos(datos) {
    nombre.value = datos[0][0];
    apellido_p.value = datos[0][1];
    apellido_m.value = datos[0][2]  == undefined ?  "": datos[0][2];
}

function mostrarCertificacionesInternas(datos) {
    for (let i = 0; i < datos.length; i++) {
        
        document.querySelector("#cert_int option[value='"+datos[i][0] +"']").selected = true;
        
    }
    
}
/*************************************************************************************** */
function mostrar_modal(id) {
    
    modal.classList.add("show");
    

    let row = document.getElementById(id);
    let cells = row.getElementsByTagName("td");
   
    nombre_cert_modi.value = cells[0].textContent;
    organizacion_cert_modi.value = cells[1].textContent;
    fecha_e_cert_modi.value = cells[2].textContent;
    fecha_v_cert_modi.value = cells[3].textContent; 

    guardar_modal.setAttribute("onclick", "guardar_cambio('"+id+"')");
    cerrar_modal.setAttribute("onclick", "ocultar_modal()");
    
}

function ocultar_modal() {
    let respuesta = confirm("Los cambios realizados no se guardarán, ¿Desea continuar?");
    if(respuesta){
        nombre_cert_modi.removeAttribute("style");
        banderas_modal.nombre_modi = true;
        organizacion_cert_modi.removeAttribute("style");
        banderas_modal.organizacion_modi = true;

        modal.classList.remove("show");
        modal.classList.add("#close");
    }
    
}

function guardar_cambio(id){
    //guarda la modificacion que hicimos en la modal
    //ve si todos los campos del formulario son validos 
    if (!formulario_cert_modal.checkValidity()) {
       //si no lo son desencadena las alertas de html
        formulario_cert_modal.reportValidity();
       
    }else{
        let fechaE = fecha_e_cert_modi.value;
        let fechaV = fecha_v_cert_modi.value;
        let fecha_inicio = new Date(fechaE);
        let fecha_fin = new Date(fechaV)

        if(nombre_cert_modi.value == ""){
            alert("Debe colocar el nombre de la certificación");
        }else if(organizacion_cert_modi.value == ""){
            alert("Debe colocar el nombre de la organización");
        }else if(fechaE == ""){
            alert("Debe seleccionar una fecha de emisión");
        }else if(fechaV == ""){
            alert("Debe seleccionar una fecha de vigencia");
        }else if(fecha_inicio > fecha_fin){
            alert("La fecha de emisión no puede ser mayor a la fecha de vigencia");
        }else if(banderas_modal.nombre_modi && banderas_modal.organizacion_modi){

            nombre_cert_modi.removeAttribute("style");
            banderas_modal.nombre_modi = true;
            organizacion_cert_modi.removeAttribute("style");
            banderas_modal.organizacion_modi = true;

            let row = document.getElementById(id);
            let cells = row.getElementsByTagName("td");
        
            cells[0].textContent = nombre_cert_modi.value;
            cells[1].textContent = organizacion_cert_modi.value;
            cells[2].textContent = fecha_e_cert_modi.value;
            cells[3].textContent = fecha_v_cert_modi.value;


            modal.classList.remove("show");
            modal.classList.add("#close");

            
            
        }

    }
        
}

function ordenarLista(lista) {
    //coloca la lista en este orden eliminar, delete, update, new
    let lista_new = lista.filter(element=>{ return element[0] == "new" });
    let lista_update = lista.filter(element=>{ return element[0] == "update" });
    let lista_delete = lista.filter(element=>{ return element[0] == "delete" });
    let lista_ordenanda = lista_delete.concat(lista_update).concat(lista_new);
    return lista_ordenanda; 
}

