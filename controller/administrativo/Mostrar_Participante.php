<?php

require_once('../../model/administrativo/Mostrar_Gastos_Ingresos.php');
$objeto=new Actividad_Seg_Tabla_Montos();

$data =[];

$idPar=$_POST["participante"];

if (strpos($idPar, 'P') !== false) {
    $data = $objeto->buscar_perso($idPar);  
} else if(strpos($idPar, 'E') !== false) {
    $data = $objeto->buscar_empresa($idPar);
} else {    
    $data = $objeto->buscar_instr($idPar);
}

echo json_encode($data);

?>