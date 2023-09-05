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
    $check=$_POST["checkboxlaboraloculto"];

    if ($check=="activado"){
        $idFunc=$base->id_funcion();
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
            $uu=$base->funciones($idEmpPerso, $idFunc, $funcion);
            if($uu==true){
                echo json_encode('exito');
                
            }else{
                echo json_encode('no exito');
                
            }
            
        }
    }else{
        $idemp=$base->id_empresa();
        $idFun=$base->id_funcion();
        $empresaLab=$_POST["nomEmpPerso"];
        $puestoEmp=$_POST["puestoEmpPerso"];
        $correoEmp=$_POST["correoEmpPerso"];
        $extTelFEmp=$_POST["ExtTelFEmp"];
        $telFEmp=$_POST["telFEmpPerso"];
        $funcionEmp=$_POST["funcionEmpPerso"];
        $u=$base->inserta_empresa($idPerso, $idemp, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $idFun, $funcionEmp);
        if($u==true){
            echo json_encode('exito');
            
        }else{
            echo json_encode('no exito');
            
        }
    }
}
?>