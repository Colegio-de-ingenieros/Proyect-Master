<?php

require_once('../../model/administrativo/Mostrar_Actividad_Seg.php');
$objeto=new Actividad_Seguimiento();
$data =[];

$id=$_POST["idAct"];

$data = $objeto->buscar_socios_ingresos($id);  

echo json_encode($data)

?>