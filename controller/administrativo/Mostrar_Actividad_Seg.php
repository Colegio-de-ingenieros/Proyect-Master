<?php

require_once('../../model/administrativo/Mostrar_Actividad_Seg.php');
$objeto=new Actividad_Seguimiento();
$data =[];

$oculto=$_POST["valueHidden"];

if ($oculto==1){
    $tipo=$_POST["tipoAct"];
    $id=$_POST["idAct"];
    $data = $objeto->buscar_datos($tipo, $id);  
} else if ($oculto==2){
    $data=["Boton Dos"];
}

echo json_encode($data)

?>