<?php
include_once('../../model/administrativo/Eliminar_Participante.php');

$idSeg = $_GET["clave"];
$actividad = $_GET["tipo"];
$obj = new EliminarParticipante();
$obj->instanciar();
$obj->eliminar_GasIngre($idPar);

?>