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
$tipoPoliza=$objeto->tipo_poliza($usuario);



if ($datosp != null) {
    if ($nom=="Membresía"){
        $info = array_merge($datos,$datosp,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Headhunter"){
        $info = array_merge($datos,$datosp,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Consultoría"){
        $info = array_merge($datos,$datosp,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Curso"){
        $datosCur = $objeto->cursos($usuario);
        if($datosCur!=null){
            $info = array_merge($datos,$datosp,$tipoPoliza,$datosTipo,$datosCur);
        }
    }
    else if ($nom=="Certificación"){
        $datosCert = $objeto->certificaciones($usuario);
        if($datosCert!=null){
            $info = array_merge($datos,$datosp,$tipoPoliza,$datosTipo,$datosCert);
        }
       
    }
}
else if ($datose != null) {
    if ($nom=="Membresía"){
        $info = array_merge($datos,$datose,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Headhunter"){
        $info = array_merge($datos,$datose,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Consultoría"){
        $info = array_merge($datos,$datose,$tipoPoliza,$datosTipo);
    }
    else if ($nom=="Curso"){
        $datosCur = $objeto->cursos($usuario);
        if($datosCur!=null){
            $info = array_merge($datos,$datose,$tipoPoliza,$datosTipo,$datosCur);
        }
    }
    else if ($nom=="Certificación"){
        $datosCert = $objeto->certificaciones($usuario);
        if($datosCert!=null){
            $info = array_merge($datos,$datose,$tipoPoliza,$datosTipo,$datosCert);
        }
       
    }
}



echo json_encode($info);
?>