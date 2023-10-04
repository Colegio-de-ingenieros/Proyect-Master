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
    echo json_encode('seguimiento');
}

else{
    //verifica si hay relacion con instructores, simulamos un error 405
    $ins = $obj->buscarIns($idc);

    //echo $ins . '<br>';

    if($ins == true){
        //si hay relacion
        echo json_encode('instructores');
    }

    else{
        
        $pol = $obj->buscarPol($idc);

        if($pol == true){
            echo json_encode('polizas');
        }

        else{
            //no hay relacion, se elimina la certificacion y el proceso termina sin errores
            $obj->eliminar($idc);
            echo json_encode('ok');
        }
    }
   
}

//echo "<script>location.href = '../../view/administrativo/Vista_Certificaciones.html';</script>";

?>