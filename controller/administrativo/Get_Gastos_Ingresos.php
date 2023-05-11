<?php
require_once('../../model/administrativo/Mostrar_Gastos_Ingresos.php');
$objeto=new Actividad_Seg_Tabla_Montos();

$data =[];

$tipo=$_POST["aux"];
$idOperacion=$_POST["idOperacion"];

if ($tipo=='gasto'){
    $data = $objeto->buscar_gasto($idOperacion);
}else{
    $data = $objeto->buscar_ingreso($idOperacion);
}

echo json_encode($data);

?>