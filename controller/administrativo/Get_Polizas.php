<?php
require_once('../../model/administrativo/Reg_General_Polizas.php');
$obj=new NuevaPoliza();
$obj->conexion();
$data =[];

$tipo = $_POST["idOperacion"];
$aux = $_POST["aux"];

if ($aux =='usuario'){
    if ($tipo=='1'){
        $data=$obj->buscarSocios();
    }
    else if ($tipo=='2'){
        $data=$obj->buscarAsociados();

    }
    else{
        $data=$obj->buscarEmpresas();
    }
}

if ($aux =='servicio'){
    if ($tipo=='4'){
        $data=$obj->buscarCursos();
    }
    else if ($tipo=='5'){
        $data=$obj->buscarCertificaciones();
    }
    else if ($tipo=='3'){
        $data=[["Consultoría", "Consultoría"]];
    }
    else if ($tipo=='1'){
        $data=[["Membresía", "Membresía"]];
    }
    else {
        $data=[["Headhunter", "Headhunter"]];
    }
    
}

echo json_encode($data)

?>