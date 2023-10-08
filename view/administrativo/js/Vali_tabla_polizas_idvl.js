/*Detecta cuando el boton fue presionado*/
function addColumn() {
    var table = document.getElementById("tabla");
var tbody = document.getElementById("body_tabla");

// Crea una nueva fila y agrega celdas a ella
var row = tbody.insertRow();
//var cell = tbody.rows[0].cells[0];

// Establece el valor de colspan o rowspan

v
var cell1 = row.insertCell();
cell1.setAttribute("colspan", "5"); // Combina dos columnas
var cell6 = row.insertCell();
var cell7 = row.insertCell();
var cell8 = row.insertCell();
var cell9 = row.insertCell();
var cell10 = row.insertCell();

// Agrega contenido a las celdas
cell1.innerHTML = "Contenido de la celda 1";
cell6.innerHTML = "Contenido de la celda 6";
cell7.innerHTML = "Contenido de la celda 7";
cell8.innerHTML = "Contenido de la celda 8";
cell9.innerHTML = "Contenido de la celda 9";
cell10.innerHTML = "<button class='btn btn-small btn-danger ti ti-backspace-filled' id='boton_registro' onclick = 'eliminar(this)' type='button'></button>";
    
}
function removeColumn() {
    var table = document.getElementById("tabla");
    if (table.rows.length > 1) {
        table.deleteRow(-1);
         /* pdfList.pop(); */
    }
}
