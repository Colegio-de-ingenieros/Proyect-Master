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

    $calle=$_POST["callePerso"];
    $colonia_actual=$_POST["cpPerso"];
    $resultado1=$base->obtener_colonia($colonia_actual);
    $col=$resultado1[0]['IdColonia'];
    $coloni=$col;

    $u=$base->nueva_colonia($idPerso, $coloni);
    $uu=$base->nueva_calle($idPerso, $calle);
        if($u==true and $uu==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
}
?>