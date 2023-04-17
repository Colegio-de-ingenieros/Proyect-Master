<?php
include_once('../../model/empresa/Eliminar_Oferta.php');
$id=$_GET['id'];
//$ban=true;
$obj = new EliminarOferta();
$obj->conexion();
$obj->eliminar($id);
echo '<script>alert("Eliminado con éxito");window.location="../../view/empresa/Vista_Ofertas.html";</script>';
?>