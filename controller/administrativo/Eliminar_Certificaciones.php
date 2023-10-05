<?php
include_once('../../model/administrativo/Eliminar_Certificaciones.php');
$idc = $_GET["idc"];

$obj = new EliminarCert();
$obj->instanciar();

//verifica si hay seguimientos de la certificacion
$seg = $obj->buscarSeg($idc);

if($seg == true){
    //echo '  relacion con seguimiento';
    echo json_encode('seguimiento');
}

else{
    //verifica si hay relacion con instructore
    $ins = $obj->buscarIns($idc);

    if($ins == true){
        //si hay relacion
        echo json_encode('instructores');
    }

    else{
        //verifica si hay relacion con polizas
        $pol = $obj->buscarPol($idc);

        if($pol == true){
            //si hay relacion
            echo json_encode('polizas');
        }

        else{
            //no hay relacion, se elimina la certificacion
            $obj->eliminar($idc);
            echo json_encode('ok');
        }
    }
   
}
?>