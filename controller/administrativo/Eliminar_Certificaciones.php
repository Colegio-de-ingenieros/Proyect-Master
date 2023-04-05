<?php
//echo ("Hola ☺");
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idc = $_GET["idc"];
//echo 'se elimina el elemento con  el id '. $idc;
//echo '<script>alert("se elimina el elemento con el id '. $idc. '")</script>';

$obj = new EliminarCert();
$obj->instanciar();
$obj->cambiaeEtatus($idc);


?>