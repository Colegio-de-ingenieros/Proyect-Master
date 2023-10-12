<?php
require_once('../../model/administrativo/Mostrar_Polizas_Gral.php');
$objeto=new Mostrar_Pol_Gral();

$data =[];

$idOperacion=$_POST["idOperacion"];
$aux=$_POST["aux"];
if ($aux=="usuario"){
    if ($idOperacion=="1"){
        $data = $objeto->buscar_asocios();
    } else if ($idOperacion=="2"){
        $data = $objeto->buscar_socios();
    } else{
        $data = $objeto->buscar_empresa();
    }
} else if ($aux=="servicio"){
    if ($idOperacion=="4"){
        $data = $objeto->buscar_curso();
    } else if ($idOperacion=="5"){
        $data = $objeto->buscar_certificaciones();
    } else{
        $data = $objeto->buscar_otro_servicio($idOperacion);
    }
} else if ($aux =="datos"){
    $data = $objeto->buscar_datos($idOperacion);
}

echo json_encode($data);

?>