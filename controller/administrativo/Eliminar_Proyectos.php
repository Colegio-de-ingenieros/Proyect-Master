<?php
include_once('../../model/administrativo/Eliminar_Proyectos.php');
$idp = $_GET["idp"];

$obj = new EliminarProyecto();
$obj->instanciar();

$seg = $obj->estatusPro($idp);

if($seg == true){
    http_response_code(404);
}
else{
    $obj->eliminar($idp);
}

echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.php';</script>";

?>

