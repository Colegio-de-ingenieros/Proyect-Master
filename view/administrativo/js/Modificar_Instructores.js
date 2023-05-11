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

const formulario = document.getElementById("formulario");
const cnt_certifiacionesInt = document.getElementById("cert_int");
const id_instructor = (new URLSearchParams(location.search)).get('id');

const nombre = document.getElementById("nombre");
const apellido_p = document.getElementById("paterno");
const apellido_m = document.getElementById("materno");


window.addEventListener("load",(e)=>{
    let form_data = new FormData();
    form_data.append("id",id_instructor);

    fetch("../../controller/administrativo/Registro_Instructores.php")
    .then(respuesta => respuesta.json())
    .then(datos =>{ 
        llenarCertificacionesInternas(datos);
    });
    
    fetch("../../controller/administrativo/Modificar_Instructores.php",{
        method: 'POST',
        body: form_data
    })
    .then(respuesta => respuesta.json())
    .then(datos =>{ 
        console.log(datos);
        mostrarDatosBasicos(datos[0]);
        mostrarEspecialidades(datos[1]);
        mostrarCertificaciones(datos[3]);
    });



});

formulario.addEventListener("submit",(e)=>{
    e.preventDefault();

    let respuesta =  SeleccionoUnaCertificacionInterna();
    
    let datos_tabla = extraer_datos_tabla();
    let datos_espe = extraer_datos_input();
       
    
    let form_data = new FormData(e.target);
    form_data.append("certificaciones",JSON.stringify(datos_tabla));
    form_data.append("especialidades",JSON.stringify(datos_espe));
    if(respuesta == false){
        form_data.append("cert_int","");
    }  
    
    fetch("../../controller/administrativo/Registro_Instructores.php",{
        method:"POST",
        body: form_data
    }).then(respuesta => respuesta.json())
    .then(datos =>{
        if(datos == true){
            alert("Modificacion exitosa");
                
            limpiar();
        }else{
            alert("No se pudo modificar el instructor");
        }
    });
    
   
    
});

btn_especialidades.addEventListener("click",(e)=>{

    let texto = cmp_especialidades.value;

    if(banderas.especialidad){

        banderas.especialidad = false;
        cmp_especialidades.value = "";
        agregar_especialidad(texto,false,"");

    }
    
});

btn_certificacion.addEventListener("click",(e)=>{

    let nombre = nombre_cert.value;
    let org = organizacion_cert.value;
    let fechaE = fecha_e_cert.value;
    let fechaV = fecha_v_cert.value;
    let fecha_inicio = new Date(fechaE);
    let fecha_fin = new Date(fechaV)

    if(nombre != "" || org != ""){
        if(nombre == ""){
            alert("Debe colocar el nombre de la certificación");
        }else if(org == ""){
            alert("Debe colocar el nombre de la organización");
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
        
    } 
    
});

function agregar_especialidad(texto,clase,id) {

    let cnt_input = document.createElement("div");
    let input = document.createElement("input");
    //let btn_modificar = document.createElement("button");
    let btn_eliminar = document.createElement("button");
    //let icono_modificar = document.createElement("i");
    let icono_eliminar = document.createElement("i");

    let id_input = cnt_especialidades.childNodes.length+Math.floor(Math.random() * 100)+Date.now().toString(5);
    let id_cnt = "contenedor"+ id_input;

    cnt_input.setAttribute("id",id_cnt); 
    cnt_input.classList.add("conte");

    input.setAttribute("id",id_input);
    if(clase){
        input.classList.add("old-"+id);
    }
    input.classList.add("input-format-11");
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

/* estos metodos extraen datos de la tabla */
function extraer_datos_tabla() {
    
    let filas = [];
    

    for (var i = 1, row; row = tabla.rows[i]; i++) {
        
        let fila = [];

        for (var j = 0; j< 4 ; j++) {
            col = row.cells[j];
            fila.push(col.textContent);
        }  
        filas.push(fila);
     }

    return filas;
}

/* Estrae los datos de los input especialidades */

function extraer_datos_input() {

    let especialidades = document.querySelectorAll(".espe-input");
    let lista = [];
    
    for (let i = 0; i < especialidades.length; i++) {
        
        let especialidad = especialidades[i];
        lista.push(especialidad.value);
       
    }

    return lista;
    
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
function limpiar() {
    formulario.reset();
    cuerpo_tabla.innerHTML = "";
    while (cuerpo_tabla.firstChild) {
        cuerpo_tabla.removeChild(cuerpo_tabla.firstChild);
    }
    cnt_tabla.style.display = 'none';
    while (cnt_especialidades.firstChild) {
        cnt_especialidades.removeChild(cnt_especialidades.firstChild);
    }
   
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