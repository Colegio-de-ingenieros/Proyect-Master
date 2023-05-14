<?php
include_once('../../model/administrativo/Eliminar_Trabajadores.php');
$rfc=$_GET['rfc'];
//$ban=true;
$obj = new EliminarTrabajadores();
$obj->conexion();
$obj->eliminar($rfc);
echo '<script>window.location="../../view/administrativo/Vista_Trabajadores.html";</script>';
?>