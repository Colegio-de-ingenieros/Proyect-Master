<?php
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idp = $_GET["idp"];
//echo 'se elimina el elemento con  el id '. $idc;
//echo '<script>alert("se elimina el elemento con el id '. $idc. '")</script>';

$obj = new EliminarProyecto();
$obj->instanciar();

//verifica si hay seguimientos de la certificacion
$seg = $obj->buscarSeg($idc);

if($seg == true){
    $obj->cambiarEtatus($idc);
    //echo 'estatus cambiado';
}

else{
    $obj->eliminar($idc);
}

//echo 'llega hasta el final'
echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.php';</script>";

?>