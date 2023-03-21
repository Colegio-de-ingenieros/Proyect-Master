<?php
include_once('../../model/Eliminar_Trabajadores.php');
$rfc=$_GET['rfc'];
//$ban=true;
$obj = new EliminarTrabajadores();
$obj->conexion();
$obj->eliminar($rfc);
echo '<script>alert("Eliminado con exito");window.location="../../view/administrativo/Vista_trabajadores.php";</script>';
?>