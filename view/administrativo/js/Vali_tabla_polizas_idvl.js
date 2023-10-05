function addColumn() {
    var table = document.getElementById("body_tabla");
    var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
   
    cell1.innerHTML = "<tr><td><p>hola</p><td><tr>";
    cell2.innerHTML = "<tr><td><p>hola</p><td><tr>";
   
    
    //cell.innerHTML = "<input type='file' accept='.pdf' onchange='addPdf(this.files[0])'>";
    //cell.innerHTML = "<input type='text' >";
    
}
function removeColumn() {
    var table = document.getElementById("tabla");
    if (table.rows.length > 1) {
        table.deleteRow(-1);
        pdfList.pop();
    }
}