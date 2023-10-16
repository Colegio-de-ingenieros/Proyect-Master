
const id_poliza = (new URLSearchParams(location.search)).get('id');

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


window.poliza_individual = []

window.addEventListener("load",async (e)=>{
    let form_data = new FormData();
    form_data.append("id_info",id_poliza);
    
    let respuesta = await fetch("../../controller/administrativo/Modificar_Poliza_Individual.php",{
        method: 'POST',
        body: form_data
    }).catch(error => console.log(error));
    let datos = await respuesta.json();

    console.log(datos);
    propietario.textContent = datos["propietario"][0][0];
 
    mostrarDatosBasicos(datos["datos_generales"][0]);
    mostrarPolizasIndiviuales(datos["polizas_individuales"]);
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
        inp_tipo.value = "";
        inp_monto.value = "";
        inp_descripcion2.value = "";
        //banderas
        banderas.descripcion1 = false;
        banderas.monto = false;
        banderas.descripcion2 = false;

    }

});


btn_registro.addEventListener("click",(e)=>{
   
    let debe = parseFloat(suma_debe.textContent.replace(/[^0-9.-]+/g,""));
    let haber = parseFloat(suma_haber.textContent.replace(/[^0-9.-]+/g,""));
    if (debe == haber) {
        extraer_datos_tabla() 
        console.log(window.poliza_individual);
    }else{
        alert("Las sumas iguales son diferentes");
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
    comprobante.appendChild(input_file);

    if(clase){
        newRow.classList.add("old-"+id);
        let link  = document.createElement("a");
        link.href = "../../controller/comprobantes/administrativo/polizas/"+id+".pdf";
        link.textContent = "Ver comprobante";
        comprobante.appendChild(link);
    }

    let btn_eliminar = document.createElement("button");
    let btn_modificar = document.createElement("button");
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
    nombre_realizo.textContent = datos[0] + " " + datos[1] + " " + datos[2];
    concepto_general.textContent = datos[3];
    fecha.textContent = datos[4];
   

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
        
        suma_debe.style.color = "red";
        suma_haber.style.color = "red";

    }else{
        suma_debe.style.color = "black";
        suma_haber.style.color = "black";
        
    }
    
}

function extraer_datos_tabla() {
    
    
    let cantidad_filas = table.rows.length - 2;

    for (let i = 4; i < cantidad_filas; i++) {

        let fila_tabla =  table.rows[i]
        let fila = [];

        let clasesLista = fila_tabla.className.split(" ");
        let clase_con_id = clasesLista.find(texto => texto.includes("old"));

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
            fila.push(contenido1);
        }
        if (contenido2 != "") {
            fila.push(2);
            fila.push(contenido2);
        }
        // el concepto 
        fila.push(table.rows[i].cells[0].textContent);
        // la descripcion
        fila.push(table.rows[i].cells[3].textContent);

        window.poliza_individual.push(fila);
        
     }
    

}

