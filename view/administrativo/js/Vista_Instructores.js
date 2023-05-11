const caja_busqueda = document.getElementById("buscar");
const caja_mensaje = document.getElementById("mensaje");
const cnt_tabla = document.getElementById("tabla_contenedor");

window.onload = function () {
    let url = "../../controller/administrativo/Mostrar_Instructores.php";
    let datos = new FormData();
    datos.append("id", 1);

    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then((response) => response.json())
        .then((json) => respuesta(json))
        .catch((error) => alert(error));

    
};

caja_busqueda.addEventListener("keyup", extraer_datos);

function extraer_datos() {

    consulta = caja_busqueda.value;
    let form_data = new FormData();
    form_data.append("consulta",consulta);

    fetch("../../controller/administrativo/Mostrar_Instructores_In.php",{
        method:"POST",
        body: form_data
    }).then(respuesta=> respuesta.json())
    .then(datos=>{
        
        document.querySelector("table tbody").innerHTML = "";
        caja_mensaje.innerHTML = "";

        if(datos.length == 0){
            cnt_tabla.style.display = 'none';
            caja_mensaje.innerText = "No se encontraron resultados";
        }else{
            cnt_tabla.style.display = 'block';
            respuesta(datos);
        }   

        
    });
    
}


function respuesta(json) {
    
    const tableBody = document.querySelector("table tbody");

    json.forEach(rowData => {
        let row = document.createElement('tr');

        //* Nombre
        let nameCell = document.createElement('td');
        let nameText = rowData[1] + " " + rowData[2] + " " + (rowData[3] || "");
        let nameTextNode = document.createTextNode(nameText);
        nameCell.appendChild(nameTextNode);
        row.appendChild(nameCell);

        //* Seguimiento
        let seguimientoCell = document.createElement('td');
        let seguimientoText = rowData[4];

        if (seguimientoText == 1) {
            seguimientoText = "No";
        } else {
            seguimientoText = "Si";
        }
        let seguimientoTextNode = document.createTextNode(seguimientoText);
        seguimientoCell.appendChild(seguimientoTextNode);
        row.appendChild(seguimientoCell);

        //* Acciones
        let accionesCell = document.createElement('td');
        let verMasLink = document.createElement('a');
        verMasLink.setAttribute('class', 'link');
        verMasLink.setAttribute('href', '../../view/administrativo/Ver_Instructor.php?id=' + rowData[0] + ' ');
        verMasLink.textContent = "Ver más";
        accionesCell.appendChild(verMasLink);

        let modificarLink = document.createElement('a');
        modificarLink.setAttribute('class', 'link');
        modificarLink.setAttribute('href', '../../view/administrativo/Modi_Instructor.html?id=' + encodeURIComponent(rowData[0]) + ' ');
        modificarLink.textContent = "Modificar";
        accionesCell.appendChild(modificarLink);

        let eliminarLink = document.createElement('a');
        eliminarLink.setAttribute('class', 'link');
        eliminarLink.setAttribute('href', '#');
        eliminarLink.addEventListener('click', function () {
            let respuesta = confirm("Estas seguro que desea eliminar?");
            if (respuesta) {
                let form_data = new FormData();
                form_data.append("id_instructor", rowData[0]);

                fetch('../../controller/administrativo/Eliminar_Instructor.php', {
                    method: "POST",
                    body: form_data
                }).then(respuesta => respuesta.json())
                    .then(datos => {
                        
                        if(datos == "con"){
                            alert("El instructor tiene seguimiento.");
                        }
                        else if(datos == "sin"){
                            alert("Eliminado con éxito");
                            location.reload();
                        }
                    })
                    .catch(error => alert(error));
            }
        });

        eliminarLink.textContent = "Eliminar";
        accionesCell.appendChild(eliminarLink);

        row.appendChild(accionesCell);

        tableBody.appendChild(row);
    });
}



