const cuerpo_tabla = document.getElementById("cuerpo");
const caja_busqueda = document.getElementById("busqueda");

const contenedor_tabla = document.getElementById("tablaResultado");
const contenedor_mensaje = document.getElementById("mensaje");

window.addEventListener("load",(e)=>{
    
    extraer_datos();

});
caja_busqueda.addEventListener("keyup", extraer_datos);

function extraer_datos() {

    consulta = caja_busqueda.value;
    let form_data = new FormData();
    form_data.append("consulta",consulta);

    fetch('../../controller/empresa/Mostrar_Cuotas_empresa.php',{
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
            var acciones = document.createElement('td');
            var archivo = document.createElement('td');
            var tipo = document.createElement('td');

            var modificar = document.createElement("a");
            var eliminar = document.createElement("a");
            var pdf = document.createElement("a");

            modificar.textContent = "Modificar";
            eliminar.textContent = "Eliminar";
            pdf.textContent = "Abrir archivo";

            modificar.style.marginLeft = "10px";
            eliminar.style.marginLeft = "10px";

            //modificar.href = "../../view/administrativo/Modi_Cursos.php?id="+encodeURIComponent(datos[i]["ClaveCur"]);
            modificar.href = "#";
            eliminar.href = "#";
            pdf.href = "../../controller/Comprobantes/"+datos[i]["DocCuota"];

            eliminar.setAttribute("class","eliminar_s");
            eliminar.setAttribute("id",datos[i]["ClaveCur"]);
            /* eliminar.setAttribute('onclick',"eliminar_f('"+datos[i]["ClaveCur"]+"')"); */

            acciones.appendChild(modificar);
            acciones.appendChild(eliminar);
            archivo.appendChild(pdf);

            clave.innerText = datos[i]["MontoVigCuo"];
            nombre.innerText = datos[i]["IniVigCuo"];
            duracion.innerText = datos[i]["FinVigCuo"];    
            tipo.innerText = datos[i]["TipoCuota"];    

            row.appendChild(clave);
            row.appendChild(tipo);
            row.appendChild(nombre);
            row.appendChild(duracion);
            row.appendChild(archivo);
            row.appendChild(acciones);

            cuerpo_tabla.appendChild(row);
            
        }

    }
}

/* function eliminar_f(clave) {
   
    var respuesta = confirm("Estas seguro que desea eliminar?");
    if(respuesta){
    
        let form_data = new FormData();
        form_data.append("id",clave);

        fetch('../../controller/administrativo/Eliminar_Cursos.php',{
            method:"POST",
            body: form_data
        }).then(respuesta=> respuesta.json())
        .then(datos=>{

        
           
            if(datos[0] == "Exito"){

                alert("Eliminado con exito");
                location.reload();

            }else{
                alert("El curso tiene seguimiento");
            }
            
        });
    }
    
} */
