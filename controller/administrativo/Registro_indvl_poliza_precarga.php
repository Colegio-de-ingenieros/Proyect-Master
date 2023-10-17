<?php
require_once("../../model/administrativo/Registro_indvl_poliza_precarga.php");

$usuario = $_POST['id'];

$objeto = new Precarga();
$objeto->conexion();

$datos = $objeto->seleccionar_persona($usuario);
$info = [$datos];
$datosp = [];
$datose = [];   
$datosp = $objeto->persona($usuario);
$datose = $objeto->empresa($usuario);
//$datosCur = $objeto->cursos($usuario);
//$datosCert = $objeto->certificaciones($usuario);
$datosTipo = $objeto->tipo($usuario);
$nom=$datosTipo[0]["SerPol"];



if ($datosp != null) {
    if ($nom=="Membresía"){
        $info = array_merge($datos,$datosp,$datosTipo);
    }
    else if ($nom=="Headhunter"){
        $info = array_merge($datos,$datosp,$datosTipo);
    }
    else if ($nom=="Consultoría"){
        $info = array_merge($datos,$datosp,$datosTipo);
    }
    else if ($nom=="Curso"){
        $datosCur = $objeto->cursos($usuario);
        if($datosCur!=null){
            $info = array_merge($datos,$datosp,$datosTipo,$datosCur);
        }
    }
    else if ($nom=="Certificación"){
        $datosCert = $objeto->certificaciones($usuario);
        if($datosCert!=null){
            $info = array_merge($datos,$datosp,$datosTipo,$datosCert);
        }
       
    }
}
else if ($datose != null) {
    if ($nom=="Membresía"){
        $info = array_merge($datos,$datose,$datosTipo);
    }
    else if ($nom=="Headhunter"){
        $info = array_merge($datos,$datose,$datosTipo);
    }
    else if ($nom=="Consultoría"){
        $info = array_merge($datos,$datose,$datosTipo);
    }
    else if ($nom=="Curso"){
        $datosCur = $objeto->cursos($usuario);
        if($datosCur!=null){
            $info = array_merge($datos,$datose,$datosTipo,$datosCur);
        }
    }
    else if ($nom=="Certificación"){
        $datosCert = $objeto->certificaciones($usuario);
        if($datosCert!=null){
            $info = array_merge($datos,$datose,$datosTipo,$datosCert);
        }
       
    }
}



echo json_encode($info);
?>