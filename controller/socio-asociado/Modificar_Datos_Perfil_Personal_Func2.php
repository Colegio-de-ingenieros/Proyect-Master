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
    $resultado1=$base->obtener_empresa($idPerso);
    
    if ($resultado1==true){
        $ide=$resultado1[0]['IdEmpPerso'];
        $idEmpPerso=$ide;
        $idFunc=$base->id_funcion();
        $funcion=$_POST["funcionEmpPerso"];
        $uu=$base->funciones($idEmpPerso, $idFunc, $funcion);
            if($uu==true){
                echo json_encode('exito');
                
            }else{
                echo json_encode('no exito');
                
            }
}
}

?>