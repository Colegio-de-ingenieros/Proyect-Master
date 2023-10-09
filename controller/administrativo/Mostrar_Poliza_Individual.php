<?php
include_once('../../model/administrativo/Mostrar_Polizas.php');
include_once('../../view/administrativo/Mostrar_Polizaindividual.html');
$base = new Mostrar_Polizas();
$id=$_GET['usuario'];
$tipo=$_GET['tipo'];
$tipoPoliza='Poliza de '.$_GET['poliza'];
$salida ="";
$banEmpresa=false;
$banSocio=false;
$resultado = $base->mostrarIndividualEmp($id);
if ($resultado==true){
    for ($i = 0; $i < count($resultado); $i++) {
    $folio= $resultado[$i]["RFCUsuaEmp"];
    $banEmpresa=true;
}
}else{
    $resultado = $base->mostrarIndividualSoc($id);
    if ($resultado==true){
        for ($i = 0; $i < count($resultado); $i++) {
        $folio= $resultado[$i]["IdPerso"];
        $banSocio=true;
        }
    }
    $resultado = $base->Poliza_Empresa($id);
    if ($resultado==true){
        for ($i = 0; $i < count($resultado); $i++) {
        $concepto= $resultado[$i]["CoceptoGral"];
        $elaboro = $resultado[$i]["NomElaPol"].' '.$resultado[$i]["ApePElaPol"].' '.$resultado[$i]["ApeMElaPol"];
        $fecha= $resultado[$i]["FechaPolGral"];
        }
    }
}
if ($banEmpresa){
    $resultado = $base->getEmpresa($folio);
    if ($resultado==true){
        for ($i = 0; $i < count($resultado); $i++) {
        $nombre= "Empresa ".$resultado[$i]["NomUsuaEmp"];
        }
    }
    $resultado = $base->Poliza_Empresa($id);
    if ($resultado==true){
        for ($i = 0; $i < count($resultado); $i++) {
        $concepto= $resultado[$i]["CoceptoGral"];
        $elaboro = $resultado[$i]["NomElaPol"].' '.$resultado[$i]["ApePElaPol"].' '.$resultado[$i]["ApeMElaPol"];
        $fecha= $resultado[$i]["FechaPolGral"];
        echo $concepto;
        }
    }
    
}
if ($banSocio){
    $resultado = $base->getSocio($folio);
    if ($resultado==true){
        for ($i = 0; $i < count($resultado); $i++) {
        $nombre= $resultado[$i]["TipoU"].' '.$resultado[$i]["NomPerso"].' '.$resultado[$i]["ApePPerso"].' '.$resultado[$i]["ApeMPerso"];
        }
    }
}
?>
<script>
</script>
<script>
    var parrafo = document.getElementById("usuapoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nombre; ?>"; // modificamos su contenid
  var parrafo = document.getElementById("serviciopoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $tipo; ?>";
  var parrafo = document.getElementById("fechapoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $fecha; ?>";
  var parrafo = document.getElementById("numerofoliopoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $id; ?>";
  var parrafo = document.getElementById("conepgenerapoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $concepto; ?>";
  var parrafo = document.getElementById("nompoliza"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $tipoPoliza; ?>";
  var tbody = document.getElementById('body_tabla');
</script>
<?php
$resultado = $base->RellenoPoliza($id);
$montoHaber=0;
$montoDebe=0;
if ($resultado==true){
    for ($i = 0; $i < count($resultado); $i++) {
    $descripcion= $resultado[$i]["DesPolInd"];
    $monto= $resultado[$i]["Monto"];
    $doc= $resultado[$i]["DesDocInd"];
    $accion= $resultado[$i]["IdPolAcc"];
    $idpol= $resultado[$i]["IdPolInd"];
    if ($accion=="1"){
        $montoDebe+=$monto;
    }else if ($accion=="2"){
        $montoHaber+=$monto;
    }
    $montoDebe=number_format($montoDebe, 2, '.', '');
    $montoHaber=number_format($montoHaber, 2, '.', '');
?>
    <script>
        
        // Crea una nueva fila
        var newRow = tbody.insertRow();
        var cell1 = newRow.insertCell(0);
        var descripcion = <?php echo json_encode($descripcion); ?>;
        var descripcion2 = <?php echo json_encode($doc); ?>;
        var accion = <?php echo json_encode($accion); ?>;
        var monto = <?php echo json_encode($monto); ?>;
        cell1.colSpan = 5; // Establece el colspan deseado para esta celda
        cell1.textContent = descripcion;
        if (accion=="1"){
            var cell2 = newRow.insertCell(1);
            cell2.colSpan = 1; 
            cell2.textContent = monto;
            cell2.style.textAlign = "right";

            var cell3 = newRow.insertCell(2);
            cell3.colSpan = 1; // Establece el colspan deseado para esta celda
            cell3.textContent = "";
            cell3.style.textAlign = "right";
        }else if(accion=="2"){
            var cell2 = newRow.insertCell(1);
            cell2.colSpan = 1; // Establece el colspan deseado para esta celda
            cell2.textContent = "";
            cell2.style.textAlign = "right";

            var cell3 = newRow.insertCell(2);
            cell3.colSpan = 1; // Establece el colspan deseado para esta celda
            cell3.textContent = monto;
            cell3.style.textAlign = "right";
        }

        var cell4 = newRow.insertCell(3);
        cell4.colSpan = 1; // Establece el colspan deseado para esta celda
        cell4.textContent = descripcion2;

        var cell5 = newRow.insertCell(4);
        cell5.colSpan = 1; // Establece el colspan deseado para esta celda
        var link = document.createElement('a');
        link.textContent = "Enlace";
        link.href = "#"; // Establece la URL del enlace según sea necesario
        newRow.cells[4].appendChild(link);
    </script>
<?php
    }
}
?>  
<script>
    var montoDebe = <?php echo json_encode($montoDebe); ?>;
    var montoHaber = <?php echo json_encode($montoHaber); ?>;
    var elaboro = <?php echo json_encode($elaboro); ?>;
    var newRow = tbody.insertRow();
    var cell1 = newRow.insertCell(0);
    cell1.colSpan = 5; // Establece el colspan deseado para esta celda
    cell1.textContent = "Sumas iguales";
    cell1.style.fontWeight = "bold";
    cell1.style.backgroundColor = "#dfe3e7"
    var cell2 = newRow.insertCell(1);
    cell2.colSpan = 1; // Establece el colspan deseado para esta celda
    cell2.textContent = montoDebe;
    cell2.style.textAlign = "right";
    var cell3 = newRow.insertCell(2);
    cell3.colSpan = 1; // Establece el colspan deseado para esta celda
    cell3.textContent = montoHaber;
    cell3.style.textAlign = "right";
    var cell4 = newRow.insertCell(3);
    cell4.colSpan = 1; // Establece el colspan deseado para esta celda
    cell4.textContent ="";
    cell4.style.textAlign = "right";
    cell4.style.backgroundColor = "#dfe3e7"
    var cell5 = newRow.insertCell(4);
    cell5.colSpan = 1; // Establece el colspan deseado para esta celda
    cell5.style.backgroundColor = "#dfe3e7"
    var newRow = tbody.insertRow();
    var cell1 = newRow.insertCell(0);
    cell1.colSpan = 5; // Establece el colspan deseado para esta celda
    cell1.textContent = "Realizó";
    cell1.style.backgroundColor = "#dfe3e7"
    cell1.style.fontWeight = "bold";
    var cell2 = newRow.insertCell(1);
    cell2.colSpan = 6; // Establece el colspan deseado para esta celda
    cell2.textContent = elaboro;
    cell2.style.textAlign = "left";
    </script>