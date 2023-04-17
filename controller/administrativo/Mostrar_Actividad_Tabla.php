<?php

require_once('../../model/administrativo/Mostrar_Actividad_Seg.php');
$objeto=new Actividad_Seguimiento();
$data =[];

$data = $objeto->buscar_tipos_gastos();  

echo json_encode($data)

?>