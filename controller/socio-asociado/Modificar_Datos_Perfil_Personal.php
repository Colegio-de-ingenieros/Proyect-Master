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

    $nomPerso=$_POST["nomPerso"];
    $apeP=$_POST["apePPerso"];
    $apeM=$_POST["apeMPerso"];
    $fechaNac=$_POST["fechaNacPerso"];
    $telFPerso=$_POST["telFPerso"];
    $telMPerso=$_POST["telMPerso"];
    $correoPerso=$_POST["correoPerso"];
    $ceduPerso=$_POST["opcion5"];
    if($ceduPerso=='opcion1'){
        $ceduPersona=1;
        if(isset($_POST["cedulaPerso"])){
            $cedula=$_POST["cedulaPerso"];
    }}else{
        $ceduPersona=0;
        $cedula="NULL";
    }

    

    $u=$base->datosPerso($idPerso, $nomPerso, $apeP, $apeM, $correoPerso, $cedula, $telFPerso, $telMPerso, $fechaNac, $ceduPersona);
    
    if($u==true){
        echo json_encode('exito');
        
    }else{
        echo json_encode('no exito');
        
    }
    
}
?>