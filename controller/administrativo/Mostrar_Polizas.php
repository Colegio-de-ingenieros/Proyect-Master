<?php
require_once('../../model/administrativo/Mostrar_Polizas.php');
$objeto=new Mostrar_Polizas();
$salida = '';

$valTipo=$_POST["tipo"];
if($valTipo!=""){
    if ($valTipo=="egreso"){
        $resultado = $objeto->Mostrar_Egresos();
    }else if ($valTipo=="ingreso"){
        $resultado = $objeto->Mostrar_Ingresos();
    }
}
echo $valTipo;