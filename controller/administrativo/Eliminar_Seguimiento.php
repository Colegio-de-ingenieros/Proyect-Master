<?php
include_once('../../model/administrativo/Eliminar_Seguimiento.php');

$idSeg = $_GET["clave"];
$actividad = $_GET["actividad"];
alert($idSeg + $actividad);
$obj = new EliminarSeguimento();
$obj->instanciar();
$obj->eliminarSoc($idSeg);
$obj->eliminarIns($idSeg);
$obj->cerrarCone();


echo "<script>location.href = '../../view/administrativo/Vista_Seguimento.html'</script>";

?>