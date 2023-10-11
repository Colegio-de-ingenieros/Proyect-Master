<?php
require_once("../../model/administrativo/Registro_indvl_poliza_precarga.php");

$usuario = $_POST['id'];

$objeto = new Precarga();
$objeto->conexion();

$datos = $objeto->seleccionar_persona($usuario);

echo json_encode($datos);

?>