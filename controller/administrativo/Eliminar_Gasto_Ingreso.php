<?php
include_once('../../model/administrativo/Eliminar_Gasto_Ingreso.php');

$idParP = $_GET["participante"];
$idAct = $_GET["actividad"];
$tipo = $_GET["tipo"];
$obj = new EliminarGasIngre();
$obj->instanciar();
if ($tipo=='gasto'){
    $obj->eliminarGasto($idParP, $idAct);
}
else{
    $obj->eliminarIngreso($idParP, $idAct);
}


?>