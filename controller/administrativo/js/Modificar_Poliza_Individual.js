
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
const btn_agregar_modal = document.getElementById("guardar_modal");


// formulario
const inp_descripcion = document.getElementById("descripcion1");
const inp_tipo = document.getElementById("tipoCargo");
const inp_monto = document.getElementById("monto");
const inp_descripcion2 = document.getElementById("descripcion2");
const inp_comprobante = document.getElementById("archivo");


const cuerpo_tabla = document.getElementById("body_tabla");

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
       
       
        agregar_fila_tabla(inp_descripcion.value, inp_tipo.value, inp_monto.value, inp_descripcion2.value, inp_comprobante.value,"","");
       
    }

});

btn_agregar_modal.addEventListener("click", ()=>{

    

});







function agregar_fila_tabla(co, de,mo, des, com, clase, id) {
    // agregamos un debe y haber a la tabla
    var table = document.getElementById('tabla');
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

    concepto.innerHTML = co;
    descripcion.innerHTML = des;
    comprobante.innerHTML = com;

    if(de == 1){
        debe.innerHTML = mo;
    }else{
        haber.innerHTML = mo;
    }
    

    let id_fila = "fila" + table.childNodes.length*Math.floor(Math.random() * 100)+Date.now().toString(23);
    newRow.setAttribute("id",id_fila);

    if(clase){
        row.classList.add("old-"+id);
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
        monto_modal.value = cells[1].textContent;
      
    }else{
        tipo_modal.value = 2;
        monto_modal.value = cells[2].textContent;
        
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
        window.certificaciones.push(["delete",id]);
    }

    while (contenedor.firstChild) {
        contenedor.removeChild(contenedor.firstChild);
    }
   
    contenedor.remove(); 
    
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
            if(tipo_modal == 1){
                cells[1].textContent = monto_modal.value;
            }else{
                cells[2].textContent = monto_modal.value;
            }
            
            cells[3].textContent = evidencia_des_modal.value;
            cells[4].textContent = evidencia_cnt_archivo.getElementsByTagName("input")[0].value;


            modal.classList.remove("show");
            modal.classList.add("#close");

            

    }
        
}