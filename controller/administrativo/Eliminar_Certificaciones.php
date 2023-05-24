<?php
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idc = $_GET["idc"];

$obj = new EliminarCert();
$obj->instanciar();

//verifica si hay seguimientos de la certificacion, simulamos un error 403
$seg = $obj->buscarSeg($idc);

//echo $seg . '<br>';

if($seg == true){
    //echo '  relacion con seguimiento';
    //http_response_code(403);
    echo json_encode('Error, la certificación no puede ser eliminada porque tiene un seguimiento');
}

else{
    //verifica si hay relacion con instructores, simulamos un error 405
    $ins = $obj->buscarIns($idc);

    //echo $ins . '<br>';

    if($ins == true){
        //si hay relacion
        //echo '  relacion con instructores';
        //http_response_code(405);
        echo json_encode('Error, la certificación no puede ser eliminada porque está relacionada con uno o más instructores');
    }

    else{
        //echo '  no hay relacion';
        //no hay relacion, se elimina la certificacion y el proceso termina sin errores
        $obj->eliminar($idc);
        echo json_encode('ok');
    }
   
}

//echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.html';</script>";

?>