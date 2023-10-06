<?php
include_once('../../model/administrativo/Mostrar_Polizas.php');
include_once('../../view/administrativo/Mostrar_Polizaindividual.html');
$base = new Mostrar_Polizas();
$id=$_GET['usuario'];
$tipo=$_GET['tipo'];
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
        $fecha= $resultado[$i]["FechaPolGral"];
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
</script>
<?php
$resultado = $base->RellenoPoliza($id);
if ($resultado==true){
    for ($i = 0; $i < count($resultado); $i++) {
    $descripcion= $resultado[$i]["DesPolInd"];
    $monto= $resultado[$i]["Monto"];
    $doc= $resultado[$i]["DesDocInd"];
    $accion= $resultado[$i]["IdPolAcc"];
    $idpol= $resultado[$i]["IdPolInd"];
?>
    <script>
        var tbody = document.getElementById('body_tabla');
        // Crea una nueva fila
        var newRow = tbody.insertRow();

        var cell1 = newRow.insertCell(0);
        cell1.colSpan = 5; // Establece el colspan deseado para esta celda
        cell1.textContent = "<?php echo $descripcion; ?>";

        var cell2 = newRow.insertCell(1);
        cell2.colSpan = 1; // Establece el colspan deseado para esta celda
        cell2.textContent = "Nuevo dato";

        var cell3 = newRow.insertCell(2);
        cell3.colSpan = 1; // Establece el colspan deseado para esta celda
        cell3.textContent = "Nuevo dato";

        var cell4 = newRow.insertCell(3);
        cell4.colSpan = 1; // Establece el colspan deseado para esta celda
        cell4.textContent = "Nuevo dato";

        var cell5 = newRow.insertCell(4);
        cell5.colSpan = 1; // Establece el colspan deseado para esta celda
        cell5.textContent = "Nuevo dato";
        var link = document.createElement('a');
        link.textContent = "Enlace";
        link.href = "#"; // Establece la URL del enlace según sea necesario
        newRow.cells[4].appendChild(link);
    </script>
<?php
    }
}
?>  