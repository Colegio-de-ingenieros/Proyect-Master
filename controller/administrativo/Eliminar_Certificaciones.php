<?php
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idc = $_GET["idc"];

$obj = new EliminarCert();
$obj->instanciar();

//verifica si hay seguimientos de la certificacion, simulamos un error 403
$seg = $obj->buscarSeg($idc);

if($seg == true){
    http_response_code(403);
}

else{
    //verifica si hay relacion con instructores, simulamos un error 405
    $ins = $obj->buscarIns($idc);

    if($ins == true){
        //si hay relacion
        http_response_code(405);
    }

    else{
        //no hay relacion, se elimina la certificacion y el proceso termina sin errores
        $obj->eliminar($idc);
    }
   
}

//echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.html';</script>";

?>