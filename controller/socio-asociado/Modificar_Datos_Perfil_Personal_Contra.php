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

    $resultado1=$base->obtener_contraseña($usuario);
    $contra_actual=$resultado1[0]['ContraPerso'];
    $contraAct=$contra_actual;
    $contra_antigua=$_POST["password_old"];
    $desencriptar=password_verify($contra_antigua, $contraAct);
    if ($desencriptar==1){
        $contra=$_POST["password"];
        $password = password_hash($contra, PASSWORD_DEFAULT);
        $u=$base->nueva_contraseña($idPerso, $password);
        if($u==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
    }
}
?>