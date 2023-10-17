<?php
require_once("../../model/administrativo/Registro_indvl_poliza_precarga.php");

$usuario = $_POST['id'];

$objeto = new Precarga();
$objeto->conexion();

$datos = $objeto->seleccionar_persona($usuario);
$info = [$datos];
$datosp = [];
$datose = [];   
$datosp = $objeto->persona($usuario);
$datose = $objeto->empresa($usuario);
if ($datosp != null) {
    $info = array_merge($datos,$datosp);
}
else if ($datose != null) {
    $info = array_merge($datos,$datose);
}


echo json_encode($info);

?>