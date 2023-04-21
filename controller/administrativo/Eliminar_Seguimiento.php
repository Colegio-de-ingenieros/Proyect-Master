<?php
include_once('../../model/administrativo/Eliminar_Seguimiento.php');

$idSeg = $_GET["actividad"];

$obj = new EliminarSeguimento();
$obj->instanciar();
$obj->eliminar($idSeg);

echo "Estoy Entrando";

echo "<script>location.href = '../../view/administrativo/Vista_Seguimento.html'</script>";

?>