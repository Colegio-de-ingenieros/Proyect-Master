<?php
include_once('../../model/Alta_Proyectos.php');

$nombreP = $_POST["nom_proyecto"];
$iniP = $_POST["ini_proyecto"];
$finP = $_POST["fin_proyecto"];
$objP = $_POST["obj_proyecto"];
$montoP = $_POST["monto_proyecto"];

$obj = new NuevoProyecto();
$obj->conexion();
$idP = $obj->generarID();

$obj->insertar($idP, $nombreP, $iniP,$finP, $objP,$montoP);

if($obj->buscarPorId($idP)){
    echo json_encode('Correcto');
}
else{
     echo json_encode('Ha ocurrido un error al conectar con la base de datos');
}

?>