<?php

require_once('../../model/socio-asociado/Modificar_Datos_Perfil_Personal.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $base = new modificarDatosPerfilPersonal();
    $resultado=$base->id($usuario);
    $idp=$resultado[0]['IdPerso'];
    $idPerso=$idp;

    $idCert=$base->id_certificaciones();
    $check=$_POST['checkboxcertificacionoculto'];
    echo $check;
    if($check == 'activado'){  
        $certifi=$_POST["nomCert"];
        $orgCert=$_POST["orgCert"];
        $fechaICert=$_POST["fechaICert"];
        $fechaFCert=$_POST["fechaFCert"];
        $u=$base->certificaciones($idPerso, $idCert, $certifi, $orgCert, $fechaICert, $fechaFCert);
        if($u==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
    }
    
}
?>