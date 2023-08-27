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
    $ide=$resultado1[0]['IdEmpPerso'];
    $idEmpPerso=$ide;
    $idFunc=$base->id_funcion($idPerso);
    $check=$_POST['checkboxlaboraloculto'];
    echo $check;
    $nomEmp=$_POST["nomEmpPerso"];
    $puestoEmp=$_POST["puestoEmpPerso"];
    $correoEmp=$_POST["correoEmpPerso"];
    $telFEmp=$_POST["telFEmpPerso"];
    $ExtTelFEmp=$_POST["ExtTelFEmp"];
    $funcion=$_POST["funcionEmpPerso"];

    if ($funcion==''){
        $u=$base->datos_laborales($idEmpPerso, $nomEmp, $puestoEmp, $correoEmp, $telFEmp, $ExtTelFEmp);
        if($u==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
    }else{
        $uu=$base->funciones($idEmpPerso, $idFunc, $funcion, $nomEmp, $puestoEmp, $correoEmp, $telFEmp, $ExtTelFEmp);
        if($uu==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
    }

    
    
    
    
}
?>