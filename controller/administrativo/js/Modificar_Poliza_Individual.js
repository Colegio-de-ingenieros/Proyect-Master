
const id_poliza = (new URLSearchParams(location.search)).get('id');
const tipo_servicio = (new URLSearchParams(location.search)).get('tipo');

const cerrar_modal = document.getElementById("close");
const guardar_modal = document.getElementById("guardar_modal");
const modal = document.getElementById("modal-container");
const modalContainer = document.getElementById("modal");

const descripcion_modal = document.getElementById("descripcionMod1");
const tipo_modal = document.getElementById("tipoMod");
const monto_modal = document.getElementById("montoMod");
const evidencia_des_modal = document.getElementById("descripcionMod2");
const evidencia_cnt_archivo = document.getElementById("archivo_modal");


const formulario = document.getElementById("formulario");
const formulario_modal = document.getElementById("formulario2");
const btn_agregar = document.getElementById("btn_agregar");
const btn_registro = document.getElementById("boton_registro");
const btn_cancelar = document.getElementById("cancelar_g");


// formulario
const inp_descripcion = document.getElementById("descripcion1");
const inp_tipo = document.getElementById("tipoCargo");
const inp_monto = document.getElementById("monto");
const inp_descripcion2 = document.getElementById("descripcion2");
// const inp_comprobante = document.getElementById("archivo");

const table = document.getElementById('tabla');
// tabla datos generales
const fecha = document.getElementById("fecha");
const folio = document.getElementById("folio");
const concepto_general = document.getElementById("concepto_ge");
const suma_debe = document.getElementById("suma_debe");
const suma_haber = document.getElementById("suma_haber");
const nombre_realizo = document.getElementById("nombre_realizo");
const propietario = document.getElementById("propietario");
const servicio = document.getElementById("servicio");

// formulario tabla
const formulario_tabla = document.getElementById("formulario_tabla");


window.poliza_individual = []
formulario_tabla.addEventListener("submit",(e)=>{
    // es porque el formulario se envia automaticamente cuando presiono el boton
    // y como lo utilizo para validar los inputs, entonces solo blloqueo el evento y ya jala bien la modal
    e.preventDefault();
});
window.addEventListener("load",async (e)=>{
    let form_data = new FormData();
    form_data.append("id_info",id_poliza);
    form_data.append("servicio_tipo",tipo_servicio);
    
    let respuesta = await fetch("../../controller/administrativo/Modificar_Poliza_Individual.php",{
        method: 'POST',
        body: form_data
    }).catch(error => console.log(error));
    let datos = await respuesta.json();
    
    propietario.textContent = datos["propietario"][0][0];
    servicio.textContent= datos["servicio"][0];
 
    mostrarDatosBasicos(datos["datos_generales"][0]);
    mostrarPolizasIndiviuales(datos["polizas_individuales"]);
});

btn_cancelar.addEventListener("click",()=>{
    let respuesta = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(respuesta){
        window.location.href = '../administrativo/Vista_Polizas.html' ;
    }
});
btn_agregar.addEventListener("click", ()=>{
    
    if(!banderas.descripcion1){
        formulario.reportValidity();
        formulario.descripcion1.style.border = "3px solid red";
    }else if(!banderas.monto){
        formulario.reportValidity();
        formulario.monto.style.border = "3px solid red";
    }else if(!banderas.descripcion2){
        formulario.reportValidity();
        formulario.descripcion2.style.border = "3px solid red";
    }else if(!formulario.checkValidity()){
        formulario.reportValidity();
    }else{
       
       
        agregar_fila_tabla(inp_tipo.value, inp_descripcion.value, inp_monto.value, inp_descripcion2.value, false,"");
        sumas_iguales()
        //limpia los campos
        inp_descripcion.value = "";
        inp_tipo.value = "1";
        inp_monto.value = "";
        inp_descripcion2.value = "";
        //banderas
        banderas.descripcion1 = false;
        banderas.monto = false;
        banderas.descripcion2 = false;

        alert("Agregado exitosamente");

    }

});


btn_registro.addEventListener("click",(e)=>{
   
    let debe = parseFloat(suma_debe.textContent.replace(/[^0-9.-]+/g,""));
    let haber = parseFloat(suma_haber.textContent.replace(/[^0-9.-]+/g,""));
    if (debe == haber) {

        if(!formulario_tabla.checkValidity()){
            
            //ponemos todos los que no tiene archivo y que es obligatorio, en color rojo
            poner_files_rojos();
            alert("Favor de subir los comprobantes faltantes");

        }else{

            let archivos = extraer_datos_tabla() 
            let archivos_ordenados = ordenarLista(archivos);
           
            let form_data = new FormData(formulario);
            form_data.append("id",id_poliza);
            form_data.append("polizas_in",JSON.stringify(ordenarLista(window.poliza_individual)));
            if(archivos_ordenados.length > 0){
                archivos_ordenados.forEach(archivo => {
                    form_data.append("archivos[]",archivo[1]);
                });
            }
            
        
            fetch("../../controller/administrativo/Modificar_Poliza_Individual.php",{
                method:"POST",
                body: form_data
            }).then(res => res.json())
            .then(datos =>{
                if(datos == true){
                    alert("Actualización exitosa");
                    window.poliza_individual = [];
                    window.location.href = '../administrativo/Vista_Polizas.html' ;
                }   
            }).catch(error => console.log(error));


        }

        
    }else{
        alert("Los  totales de los campos debe y haber no coinciden");
    }
});
function agregar_fila_tabla(debe_haber, concepto_p,monto_p, descripcion_p,  clase, id) {
    // agregamos un debe y haber a la tabla
    
    var newRowIdx = table.rows.length - 2;
    var newRow = table.insertRow(newRowIdx);

    var concepto = newRow.insertCell(0);
    var debe = newRow.insertCell(1);
    var haber = newRow.insertCell(2);
    var descripcion = newRow.insertCell(3);
    var comprobante = newRow.insertCell(4);
    var accion = newRow.insertCell(5);


    // estilos de la tabla ----------------------
    concepto.colSpan = 5 ;
    concepto.classList.add("justify-text");
    debe.classList.add("right-text");
    haber.classList.add("right-text");
    descripcion.classList.add("justify-text");
    // ------------------------------------------

    concepto.innerHTML = concepto_p;
    descripcion.innerHTML = descripcion_p;
    

    if(debe_haber == 1){
        debe.innerHTML = parseFloat(monto_p).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });

    }else{
        haber.innerHTML =  parseFloat(monto_p).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
    }
    

    let id_fila = "fila" + table.childNodes.length*Math.floor(Math.random() * 100)+Date.now().toString(23);
    newRow.setAttribute("id",id_fila);

    //crea el input type file
    let input_file = document.createElement('input');
    input_file.type="file";
    input_file.accept="application/pdf";
    comprobante.appendChild(input_file);
    // input_file.setCustomValidity("Seleccione un archivo PDF");
    
    input_file.addEventListener("change", (e)=>{validarArchivo(input_file,id_fila)});
    let div_nombre_archivo = document.createElement("div");
    comprobante.appendChild(div_nombre_archivo);

    if(clase){
        newRow.classList.add("old-"+id);

        

        let link  = document.createElement("a");
        link.href = "../../controller/comprobantes/administrativo/polizas/"+id+".pdf";
        link.target = "_blank";
        link.textContent = "Ver comprobante actual";
        comprobante.appendChild(link);

    }else{
        input_file.required = true;
    }

    let btn_eliminar = document.createElement("button");
    let btn_modificar = document.createElement("button");

    btn_eliminar.type = "button";
    btn_modificar.type = "button";    
    btn_modificar.classList.add("btn","btn-small","btn-danger1","fa-solid","fa-pen-to-square");
    btn_eliminar.classList.add("btn","btn-small","btn-danger","ti","ti-backspace-filled");

    btn_eliminar.setAttribute("onclick", "elimina_elementos_tabla('"+id_fila+"')");
    btn_modificar.setAttribute("onclick", "mostrar_modal('"+id_fila+"')");


    accion.appendChild(btn_modificar);
    accion.appendChild(btn_eliminar);

    
    

    
}


function mostrar_modal(id) {
    
    modal.classList.add("show");

    banderasModal.descripcionMod1 = true;
    banderasModal.descripcionMod2 = true;
    banderasModal.montoMod = true;

    let row = document.getElementById(id);
    let cells = row.getElementsByTagName("td");
   
    descripcion_modal.value = cells[0].textContent;
  
    if(cells[1].textContent != ""){
        tipo_modal.value = 1;
        monto_modal.value = parseFloat(cells[1].textContent.replace(/[^0-9.-]+/g,""));
      
    }else{
        tipo_modal.value = 2;
        monto_modal.value = parseFloat(cells[2].textContent.replace(/[^0-9.-]+/g,""));;
        
    }
    
    evidencia_des_modal.value = cells[3].textContent;
  
   
    guardar_modal.setAttribute("onclick", "guardar_cambio('"+id+"')");
    cerrar_modal.setAttribute("onclick", "ocultar_modal()");
    
}


function ocultar_modal() {
    let respuesta = confirm("Los cambios realizados no se guardarán, ¿desea continuar?");
    if(respuesta){

        banderasModal.descripcionMod1 = true;
        banderasModal.descripcionMod2 = true;
        banderasModal.montoMod = true;

        descripcion_modal.removeAttribute("style");
        monto_modal.removeAttribute("style");
        evidencia_des_modal.removeAttribute("style");


        modal.classList.remove("show");
        modal.classList.add("#close");
    }
    
}

function elimina_elementos_tabla(id_fila) {
    let contenedor = document.getElementById(id_fila);
    //elimina a todos sus hijos primero
    let clasesLista = contenedor.className.split(" ");
    let clase_con_id = clasesLista.find(texto => texto.includes("old"));


    if(clase_con_id != undefined){
        let id = clase_con_id.split("-")[1];
        window.poliza_individual.push(["delete",id]);
    }

    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
   
    contenedor.remove(); 
    sumas_iguales()
    
}


function guardar_cambio(id){
    //guarda la modificacion que hicimos en la modal
    //ve si todos los campos del formulario son validos 
    if(!banderasModal.descripcionMod1){
        formulario_modal.reportValidity();
        formulario_modal.descripcionMod1.style.border = "3px solid red";
    }else if(!banderasModal.montoMod){
        formulario_modal.reportValidity();
        formulario_modal.montoMod.style.border = "3px solid red";
    }else if(!banderasModal.descripcionMod1){
        formulario_modal.reportValidity();
        formulario_modal.descripcionMod2.style.border = "3px solid red";
    }else if(!formulario_modal.checkValidity()){
        formulario_modal.reportValidity();
    }else{
        
        let row = document.getElementById(id);
        let cells = row.getElementsByTagName("td");
        
        cells[0].textContent = descripcion_modal.value;
        if(tipo_modal.value == 1){
            cells[1].textContent = parseFloat(monto_modal.value).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
            cells[2].textContent = "";
         
        }else{
            cells[1].textContent = "";
            cells[2].textContent = parseFloat(monto_modal.value).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
            
        }
            
        cells[3].textContent = evidencia_des_modal.value;
        // cells[4].textContent = evidencia_cnt_archivo.getElementsByTagName("input")[0].value;


        modal.classList.remove("show");
        modal.classList.add("#close");

        sumas_iguales()

            

    }
        
}

function mostrarDatosBasicos(datos){
    
    folio.textContent = id_poliza;
    nombre_realizo.textContent = datos[0];
    concepto_general.textContent = datos[1];
    fecha.textContent = datos[2];
   

}

function mostrarPolizasIndiviuales(filas) {
    
    if(filas.length > 0){
        
        for (let i = 0; i < filas.length; i++) {

            agregar_fila_tabla(filas[i][0],filas[i][2],filas[i][3],filas[i][4],true,filas[i][1]);
            
        }
        sumas_iguales()
        
    }

   
}

function sumas_iguales() {
    var table = document.getElementById('tabla');


    let cantidad_filas = table.rows.length - 2;
    let debe = 0;
    let haber = 0;
    for (let i = 4; i < cantidad_filas; i++) {
        
        let contenido1 = table.rows[i].cells[1].textContent;
        let contenido2 = table.rows[i].cells[2].textContent;
        let value1 = parseFloat(contenido1.replace(/[^0-9.-]+/g,""));
        var value2 = parseFloat(contenido2.replace(/[^0-9.-]+/g,""));
        

        if(contenido1 != ""){
        
            debe += value1;

        }
        if (contenido2 != "") {
            
            haber += value2;
            
        }
        
    }

    suma_debe.textContent = parseFloat(debe).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
    suma_haber.textContent = parseFloat(haber).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });

    if(debe != haber){
        
        suma_debe.classList.add("error");
        suma_haber.classList.add("error");

    }else{
        suma_debe.classList.remove("error");
        suma_haber.classList.remove("error");
        
    }
    
}

function extraer_datos_tabla() {


    window.poliza_individual = window.poliza_individual.filter((i) => i[0] !== "update" && i[0] !== "new");
    
    let cantidad_filas = table.rows.length - 2;

    let archivos = [];
    for (let i = 4; i < cantidad_filas; i++) {

        let fila_tabla =  table.rows[i]
        let fila = [];
        
        let clasesLista = fila_tabla.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("old"));

        // tomar archivos
        let input_file = table.rows[i].cells[4].getElementsByTagName("input")[0];
        
        
     

        if(clase_con_id == undefined){
            fila.push("new"); 
           
        } else{
            let id = clase_con_id.split("-")[1];
            fila.push("update");
            fila.push(id);
           
        }


        let contenido1 = table.rows[i].cells[1].textContent;
        let contenido2 = table.rows[i].cells[2].textContent;
        
        if(contenido1 != ""){
            fila.push(1);
            fila.push(parseFloat(contenido1.replace(/[^0-9.-]+/g,"")));
        }
        if (contenido2 != "") {
            fila.push(2);
            fila.push(parseFloat(contenido2.replace(/[^0-9.-]+/g,"")));
        }
        // el concepto 
        fila.push(table.rows[i].cells[0].textContent);
        // la descripcion
        fila.push(table.rows[i].cells[3].textContent);

        file = input_file.files[0];

        if(clase_con_id == undefined){
            archivos.push(["new",file]);
            
        } else{
            if(file != undefined){
                archivos.push(["update",file]);
                fila.push("si");
            }else{
                fila.push("no");
            }
            
           
        }

        
        // rellenamos el arreglo con los datos de la fila
        window.poliza_individual.push(fila);

        
    }
    return archivos;
    

}



function ordenarLista(lista) {
    //coloca la lista en este orden eliminar, delete, update, new
    let lista_new = lista.filter(element=>{ return element[0] == "new" });
    let lista_update = lista.filter(element=>{ return element[0] == "update" });
    let lista_delete = lista.filter(element=>{ return element[0] == "delete" });
    let lista_ordenanda = lista_delete.concat(lista_update).concat(lista_new);
    return lista_ordenanda; 
}
function validarArchivo(input, id_fila) {
   
    var archivo = input.files[0];
    var maxSize = 3 * 1024 * 1024; // 3MB
    var ext = input.value.split('.').pop().toLowerCase();
    console.log(archivo);
    let div = document.getElementById(id_fila).cells[4].getElementsByTagName("div")[0];
    if (archivo && archivo.size > maxSize) {
        alert("El archivo seleccionado supera el tamaño máximo permitido de 3MB");
        input.value = ""; // Limpia el valor del campo de archivo
        div.textContent = "";
    }else if (archivo != undefined && ext != "pdf") {
        alert("Extensión no permitida: " + ext);
        input.value = ""; // Limpia el valor del campo de archivo
        div.textContent = "";

    }else if(archivo && archivo.size <= maxSize){
        div.textContent = archivo.name;
        input.removeAttribute("style");

    }else{

        div.textContent = "";
        

    }
}




function poner_files_rojos() {
    let cantidad_filas = table.rows.length - 2;
    for (let i = 4; i < cantidad_filas; i++) {

        let fila_tabla =  table.rows[i]
        
        let clasesLista = fila_tabla.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("old"));

        // tomar archivos
        let input_file = table.rows[i].cells[4].getElementsByTagName("input")[0];

        if(clase_con_id == undefined && input_file.value == ""){
            
            input_file.style = "background-color: rgb(235, 71, 71);";
           
        } 
    }
}