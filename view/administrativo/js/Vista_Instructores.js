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

    function respuesta(json) {
        const tableBody = document.querySelector("table tbody");

        json.forEach(rowData => {
            let row = document.createElement('tr');

            // Nombre
            let nameCell = document.createElement('td');
            let nameText = rowData[1] + " " + rowData[2] + " " + (rowData[3] || "");
            let nameTextNode = document.createTextNode(nameText);
            nameCell.appendChild(nameTextNode);
            row.appendChild(nameCell);

            // Seguimiento
            let seguimientoCell = document.createElement('td');
            let seguimientoText = rowData[4];
            let seguimientoTextNode = document.createTextNode(seguimientoText);
            seguimientoCell.appendChild(seguimientoTextNode);
            row.appendChild(seguimientoCell);

            // Acciones
            let accionesCell = document.createElement('td');
            let verMasLink = document.createElement('a');
            verMasLink.setAttribute('href', '../../view/administrativo/Ver_Instructor.html');
            verMasLink.textContent = "Ver más";
            accionesCell.appendChild(verMasLink);

            let modificarLink = document.createElement('a');
            modificarLink.setAttribute('href', '');
            modificarLink.textContent = "Modificar";
            accionesCell.appendChild(modificarLink);

            let eliminarLink = document.createElement('a');
            eliminarLink.setAttribute('href', '');
            eliminarLink.textContent = "Eliminar";
            accionesCell.appendChild(eliminarLink);

            row.appendChild(accionesCell);

            tableBody.appendChild(row);
        });
    }
};