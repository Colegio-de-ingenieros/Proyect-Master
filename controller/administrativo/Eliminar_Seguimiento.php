<?php
include_once('../../model/administrativo/Eliminar_Seguimiento.php');

$idSeg = $_GET["clave"];
$actividad = $_GET["tipo"];
$obj = new EliminarSeguimento();
$obj->instanciar();
$obj->eliminarSoc($idSeg);
$obj->eliminarEmp($idSeg);
$obj->eliminarIns($idSeg);
$obj->estatus($idSeg,$actividad);
//$obj->cerrarCone();


//echo "<script>location.href = '../../view/administrativo/Vista_Seguimento.html'</script>";

?>