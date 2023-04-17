<?php
include_once('../../model/administrativo/Eliminar_Proyectos.php');
$idp = $_GET["idp"];

$obj = new EliminarProyecto();
$obj->instanciar();
$obj->eliminar($idp);

echo "<script>location.href = '../../view/administrativo/Vista_Proyectos.php'</script>";

?>
