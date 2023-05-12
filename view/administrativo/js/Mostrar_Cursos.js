const cuerpo_tabla = document.getElementById("cuerpo");
const caja_busqueda = document.getElementById("busqueda");
const btn_excel = document.getElementById("btn_excel");

const contenedor_tabla = document.getElementById("tablaResultado");
const contenedor_mensaje = document.getElementById("mensaje");
/** Genera el excel */
btn_excel.addEventListener("click",(e)=>{
    location.href = '../../controller/administrativo/Excel_Cursos.php';
});
window.addEventListener("load",(e)=>{
    
    extraer_datos();

});
caja_busqueda.addEventListener("keyup", extraer_datos);

function extraer_datos() {

    consulta = caja_busqueda.value;
    let form_data = new FormData();
    form_data.append("consulta",consulta);

    fetch('../../controller/administrativo/Mostrar_Cursos.php',{
        method:"POST",
        body: form_data
    }).then(respuesta=> respuesta.json())
    .then(datos=>{
        crear_tabla(datos);
    });
    
}

function crear_tabla(datos) {

    cuerpo_tabla.innerHTML = "";

    if(contenedor_mensaje.hasChildNodes()){
        contenedor_mensaje.removeChild(contenedor_mensaje.firstChild);
    }

    if(datos.length == 0){
        contenedor_tabla.style.display = 'none';
        var mensaje = document.createElement('p');
        mensaje.innerText = "No se encontraron resultados";
        contenedor_mensaje.appendChild(mensaje);

    }else{
        contenedor_tabla.style.display = 'block';
    

        for (let i = 0; i < datos.length; i++) {
        
            var row = document.createElement('tr');
            var clave = document.createElement('td');
            var nombre = document.createElement('td');
            var duracion = document.createElement('td');
            var seguimiento = document.createElement('td');
            var acciones = document.createElement('td');

            var ver_mas = document.createElement("a");
            var modificar = document.createElement("a");
            var eliminar = document.createElement("a");

            ver_mas.textContent = "Ver más";
            modificar.textContent = "Modificar";
            eliminar.textContent = "Eliminar";

            ver_mas.href = "../../controller/administrativo/Ver_Cursos.php?id="+encodeURIComponent(datos[i]["ClaveCur"]);
            modificar.href = "../../view/administrativo/Modi_Cursos.php?id="+encodeURIComponent(datos[i]["ClaveCur"]);
            eliminar.href = "#";
            eliminar.setAttribute("class","eliminar_s");
            eliminar.setAttribute("id",datos[i]["ClaveCur"]);
            eliminar.setAttribute('onclick',"eliminar_f('"+datos[i]["ClaveCur"]+"')");

            eliminar.setAttribute("class", "espaciado");
            modificar.setAttribute("class", "espaciado");
            ver_mas.setAttribute("class", "espaciado");

            acciones.appendChild(ver_mas);
            acciones.appendChild(modificar);
            acciones.appendChild(eliminar);

            clave.innerText = datos[i]["ClaveCur"];
            nombre.innerText = datos[i]["NomCur"];
            duracion.innerText = datos[i]["DuracionCur"]; 
            if (datos[i]["EstatusCur"] == 1){
                seguimiento.innerText = "No";   

                row.appendChild(clave);
                row.appendChild(nombre);
                row.appendChild(duracion);
                row.appendChild(seguimiento);
                row.appendChild(acciones);

                cuerpo_tabla.appendChild(row);
            }else{
                seguimiento.innerText = "Si";   

                row.appendChild(clave);
                row.appendChild(nombre);
                row.appendChild(duracion);
                row.appendChild(seguimiento);
                row.appendChild(acciones);

                cuerpo_tabla.appendChild(row);
            }   

            
            
        }

    }
}

function eliminar_f(clave) {
   
    var respuesta = confirm("¿Está seguro que desea eliminar este curso?");
    if(respuesta){
    
        let form_data = new FormData();
        form_data.append("id",clave);

        fetch('../../controller/administrativo/Eliminar_Cursos.php',{
            method:"POST",
            body: form_data
        }).then(respuesta=> respuesta.json())
        .then(datos=>{

        
           
            if(datos[0] == "Exito"){

                alert("Eliminado con éxito");
                location.reload();

            }else{
                alert("Error, el curso no puede ser eliminado porque tiene un seguimiento");
            }
            
        });
    }
    
}



