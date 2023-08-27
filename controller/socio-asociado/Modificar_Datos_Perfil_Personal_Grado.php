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

    $gradoEst=$_POST["tipoGradoPerso"];
    $pasantia=$_POST["opcion1"];
    if($pasantia=='opcion1'){
        $pasan=1;
    }else{
        $pasan=0;
    }

    $u=$base->pasantia($idPerso, $pasan);
    $uu=$base->grado_estudios($idPerso, $gradoEst);
    if($u==true and $uu==true){
        echo json_encode('exito');
        
    }else{
        echo json_encode('no exito');
    }
            
}
?>