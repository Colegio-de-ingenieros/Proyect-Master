<?php
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idc = $_GET["idc"];

$obj = new EliminarCert();
$obj->instanciar();

//verifica si hay seguimientos de la certificacion
$seg = $obj->buscarSeg($idc);

if($seg == true){
    http_response_code(404);
}

else{
    $obj->eliminar($idc);
}

echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.php';</script>";

?>