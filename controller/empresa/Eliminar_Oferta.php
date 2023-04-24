<?php
include_once('../../model/empresa/Eliminar_Oferta.php');
$id=$_GET['id'];
$id=str_pad($id, 6, "0", STR_PAD_LEFT);
$obj = new EliminarOferta();
$obj->conexion();
$obj->eliminar($id);
echo '<script>window.location="../../view/empresa/Vista_Ofertas.html";</script>';
?>