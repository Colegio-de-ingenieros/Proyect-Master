<?php
require_once("../../controller/administrativo/Mostrar_Trabajadores.php");
$criterio = $_POST['criterio'];

$query = "SELECT * FROM trabajadores 
WHERE NombreT LIKE '%$criterio%' OR ApePT LIKE '%$criterio%' OR ApeMT LIKE '%$criterio%' OR RFCT LIKE '%$criterio%' OR CorreoT LIKE '%$criterio%' OR TelT LIKE '%$criterio%'";
 
$trabajadores=[];
$errores=['data'=>false];

$result =$db->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $trabajadores[] = $row;
    }
    echo json_encode($trabajadores);
} else {
    echo json_encode($errores);
}