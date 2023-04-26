<?php
include_once('../../model/administrativo/Eliminar_Participante.php');

$participante = $_GET["participante"];

$obj = new EliminarParticipante();
$obj->instanciar();
$obj->eliminar_GasIngre($participante);

?>