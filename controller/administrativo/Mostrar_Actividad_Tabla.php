<?php

require_once('../../model/administrativo/Mostrar_Actividad_Tabla.php');
$objeto=new Actividad_Seg_Tabla();
$data =[];

$id=$_POST["idAct"];

$data = $objeto->consul_datos_tabla($id);  

echo json_encode($data)

?>